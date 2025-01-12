<?php
// Démarre la session pour pouvoir accéder aux variables de session
session_start();
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <title>Panier de Livres</title>
</head>

<body>
<div class="container mt-5">
    <!-- Titre du panier -->
    <h1 class="text-center">Votre Panier</h1>

    <div class="row mt-4 justify-content-center">
        <div class="col-md-10">
            <?php
            // Si le panier n'existe pas, on l'initialise en tant que tableau vide
            if (!isset($_SESSION['panier'])) {
                $_SESSION['panier'] = array();
            }

            // Calcul du nombre de livres empruntés et du nombre restant à emprunter
            $nb_livresempruntes = count($_SESSION['panier']);
            $nb_emprunts_restants = 5 - $nb_livresempruntes;

            // Affichage du nombre de livres restants à emprunter
            echo "<h5 class='text-center mb-4'>Vous pouvez encore emprunter <strong>$nb_emprunts_restants</strong> livres.</h5>";

            // Si le panier est vide, on affiche un message d'alerte
            if (empty($_SESSION['panier'])) {
                echo "<div class='alert alert-warning text-center' role='alert'>Votre panier est vide.</div>";
            } else {
                // Si le panier n'est pas vide, on affiche les livres ajoutés
                echo "<table class='table table-bordered table-striped'>";
                echo "<thead class='table-dark'>";
                echo "<tr>
                        <th>#</th>
                        <th>Titre</th>
                        <th>Action</th>
                      </tr>";
                echo "</thead>";
                echo "<tbody>";

                // Connexion à la base de données pour récupérer les informations des livres
                require_once('connexion.php');
                foreach ($_SESSION['panier'] as $index => $nolivre) {
                    // Préparation de la requête pour récupérer le titre du livre
                    $stmt = $connexion->prepare("SELECT titre FROM livre WHERE nolivre = :nolivre");
                    $stmt->bindValue(':nolivre', $nolivre, PDO::PARAM_INT);
                    $stmt->execute();
                    $livre = $stmt->fetch(PDO::FETCH_OBJ);

                    // Si le livre existe, on affiche ses informations dans la table
                    if ($livre) {
                        echo "<tr>";
                        echo "<td>" . ($index + 1) . "</td>";  // Affichage de l'index du livre
                        echo "<td>" . htmlspecialchars($livre->titre) . "</td>";  // Affichage du titre du livre
                        echo "<td>
                                <form method='POST' class='d-inline'>
                                    <input type='hidden' name='nolivre' value='$nolivre'>
                                    <button type='submit' name='annuler' class='btn btn-danger btn-sm'>Supprimer</button>
                                </form>
                              </td>";
                        echo "</tr>";
                    }
                }

                echo "</tbody>";
                echo "</table>";

                // Formulaire pour valider le panier
                echo "<form method='POST' class='text-center mt-3'>";
                echo "<button type='submit' name='valider' class='btn btn-success'>Valider le Panier</button>";
                echo "</form>";
            }

            // Gestion des actions pour supprimer un livre ou valider le panier
            if (isset($_POST['annuler'])) {
                $nolivre = $_POST['nolivre'];
                // Suppression du livre du panier
                if (($key = array_search($nolivre, $_SESSION['panier'])) !== false) {
                    unset($_SESSION['panier'][$key]);
                }
                $_SESSION['panier'] = array_values($_SESSION['panier']); // Ré-indexer le tableau
                header("Refresh:0"); // Recharger la page pour mettre à jour l'affichage
            }

            if (isset($_POST['valider'])) {
                // Récupération de l'email de l'utilisateur et de la date d'emprunt
                $mel = $_SESSION['mel'] ?? 'inconnu@example.com'; // Utilisateur par défaut si non défini
                $dateemprunt = date("Y-m-d");

                try {
                    // Insertion des livres dans la table emprunter
                    foreach ($_SESSION['panier'] as $nolivre) {
                        $stmt = $connexion->prepare("INSERT INTO emprunter(mel, nolivre, dateemprunt) VALUES (:mel, :nolivre, :dateemprunt)");
                        $stmt->bindValue(':mel', $mel, PDO::PARAM_STR);
                        $stmt->bindValue(':nolivre', $nolivre, PDO::PARAM_INT);
                        $stmt->bindValue(':dateemprunt', $dateemprunt, PDO::PARAM_STR);
                        $stmt->execute();
                    }
                    // Vider le panier après validation
                    $_SESSION['panier'] = array();
                    echo "<div class='alert alert-success text-center' role='alert'>Votre panier a été validé avec succès !</div>";
                } catch (PDOException $e) {
                    echo "<div class='alert alert-danger' role='alert'>Erreur lors de la validation : " . $e->getMessage() . "</div>";
                }
            }
            ?>
        </div>
    </div>
</div>
</body>
</html>
