<?php
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
    <h1 class="text-center">Votre Panier</h1>

    <div class="row mt-4 justify-content-center">
        <div class="col-md-10">
            <?php
            if (!isset($_SESSION['panier'])) {
                $_SESSION['panier'] = array();
            }

            $nb_livresempruntes = count($_SESSION['panier']);
            $nb_emprunts_restants = 5 - $nb_livresempruntes;

            echo "<h5 class='text-center mb-4'>Vous pouvez encore emprunter <strong>$nb_emprunts_restants</strong> livres.</h5>";

            if (empty($_SESSION['panier'])) {
                echo "<div class='alert alert-warning text-center' role='alert'>Votre panier est vide.</div>";
            } else {
                echo "<table class='table table-bordered table-striped'>";
                echo "<thead class='table-dark'>";
                echo "<tr>
                        <th>#</th>
                        <th>Titre</th>
                        <th>Action</th>
                      </tr>";
                echo "</thead>";
                echo "<tbody>";

                require_once('connexion.php');
                foreach ($_SESSION['panier'] as $index => $nolivre) {
                    $stmt = $connexion->prepare("SELECT titre FROM livre WHERE nolivre = :nolivre");
                    $stmt->bindValue(':nolivre', $nolivre, PDO::PARAM_INT);
                    $stmt->execute();
                    $livre = $stmt->fetch(PDO::FETCH_OBJ);

                    if ($livre) {
                        echo "<tr>";
                        echo "<td>" . ($index + 1) . "</td>";
                        echo "<td>" . htmlspecialchars($livre->titre) . "</td>";
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

                echo "<form method='POST' class='text-center mt-3'>";
                echo "<button type='submit' name='valider' class='btn btn-success'>Valider le Panier</button>";
                echo "</form>";
            }

            // Gestion des actions (Supprimer un livre ou valider le panier)
            if (isset($_POST['annuler'])) {
                $nolivre = $_POST['nolivre'];
                if (($key = array_search($nolivre, $_SESSION['panier'])) !== false) {
                    unset($_SESSION['panier'][$key]);
                }
                $_SESSION['panier'] = array_values($_SESSION['panier']); // Ré-indexer le tableau
                header("Refresh:0");
            }

            if (isset($_POST['valider'])) {
                $mel = $_SESSION['mel'] ?? 'inconnu@example.com'; // À remplacer par une vraie session utilisateur
                $dateemprunt = date("Y-m-d");

                try {
                    foreach ($_SESSION['panier'] as $nolivre) {
                        $stmt = $connexion->prepare("INSERT INTO emprunter(mel, nolivre, dateemprunt) VALUES (:mel, :nolivre, :dateemprunt)");
                        $stmt->bindValue(':mel', $mel, PDO::PARAM_STR);
                        $stmt->bindValue(':nolivre', $nolivre, PDO::PARAM_INT);
                        $stmt->bindValue(':dateemprunt', $dateemprunt, PDO::PARAM_STR);
                        $stmt->execute();
                    }
                    $_SESSION['panier'] = array(); // Vider le panier après validation
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
