<?php
// Démarrage de la session, instruction à placer en tête de script
session_start();
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Inclusion de Bootstrap pour les styles et la mise en page -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
<div class="container text-center">

    <!-- Inclusion de la barre de recherche -->
    <?php
        include "recherche.php";
    ?>

    <div class='row'>
        <div class="col-sm-9" style="background-color:lavender;">

            <!-- Titre de la section panier -->
            <h3> Votre panier </h3>

            <?php
            // Vérifie si le panier est initialisé, sinon l'initialise
            if (!isset($_SESSION['panier'])) {
                $_SESSION['panier'] = array(); // Initialisation du panier
            }

            // Affichage du nombre de livres empruntés et du nombre de réservations possibles
            $nb_livresempruntés = count($_SESSION['panier']);
            $nb_emprunts = (5 - $nb_livresempruntés);
            echo '<h5>(Il vous reste ', $nb_emprunts, ' réservations possibles.)</h5>';

            // Boucle pour afficher tous les livres dans le panier
            foreach ($_SESSION['panier'] as $nolivre) {
                echo '<form method="POST">';
                require_once('connexion.php');

                // Requête pour obtenir le titre du livre à partir de son ID (nolivre)
                $stmt = $connexion->prepare("SELECT titre FROM livre WHERE nolivre = :nolivre");
                $stmt->bindValue(":nolivre", $nolivre, PDO::PARAM_INT); // Bind de l'ID du livre
                $stmt->setFetchMode(PDO::FETCH_OBJ); // Mode objet pour récupérer les données
                $stmt->execute();

                // Affichage du titre du livre
                while ($enregistrement = $stmt->fetch()) {
                    echo ($enregistrement->titre) . "<br>";
                }

                // Ajout du livre à la soumission pour suppression du panier
                echo '<input type="hidden" name="nolivre" value="' . ($nolivre) . '">';
                echo '<input type="submit" name="annuler" value="Supprimer du panier" class="btn btn-danger">';
                echo '</form>';
            }

            // Affichage du message si le panier est vide
            if (empty($_SESSION['panier'])) {
                echo 'Votre panier est vide';
            } else {
                echo 'Votre panier se remplit';
                echo '<form method="POST">';
                // Ajouter tous les livres au formulaire pour validation
                foreach ($_SESSION['panier'] as $nolivre) {
                    echo '<input type="hidden" name="nolivre[]" value="' . ($nolivre) . '">';
                }
                echo '<input type="submit" name="valider" value="Valider le panier" class="btn btn-success">';
                echo '</form>';
            }

            // Suppression d'un livre du panier
            if (isset($_POST['annuler'])) {
                $nolivre = $_POST['nolivre'];
                // Recherche et suppression du livre du panier
                if (($key = array_search($nolivre, $_SESSION['panier'])) !== false) {
                    unset($_SESSION['panier'][$key]);
                    sort($_SESSION['panier']); // Réindexation du tableau après suppression
                }
                header("refresh: 0"); // Rechargement de la page après suppression
                exit;
            }

            // Validation du panier et ajout des livres dans la table "emprunter"
            if (isset($_POST['valider'])) {
                require_once('connexion.php');
                $mel = $_SESSION['mel']; // Récupère l'email de l'utilisateur depuis la session
                $dateemprunt = date("Y-m-d"); // Date actuelle

                // Boucle sur chaque livre du panier pour l'ajouter à la table "emprunter"
                foreach ($_POST['nolivre'] as $nolivre) {
                    // Essai d'insertion dans la table "emprunter"
                    try {
                        $stmt = $connexion->prepare("INSERT INTO emprunter (mel, nolivre, dateemprunt) VALUES (:mel, :nolivre, :dateemprunt)");
                        $stmt->bindValue(':mel', $mel, PDO::PARAM_STR);
                        $stmt->bindValue(':nolivre', $nolivre, PDO::PARAM_INT);
                        $stmt->bindValue(':dateemprunt', $dateemprunt, PDO::PARAM_STR);
                        $stmt->execute(); // Exécution de la requête

                        // Confirmation du succès de l'ajout
                        echo '<p class="text-success">Livre n°' . ($nolivre) . ' ajouté à vos emprunts.</p>';
                    } catch (PDOException $e) {
                        // Affichage de l'erreur si l'ajout échoue
                        echo '<p class="text-danger">Erreur lors de l\'ajout du livre n°' . ($nolivre) . ': ' . $e->getMessage() . '</p>';
                    }
                }

                // Vider le panier après validation
                $_SESSION['panier'] = array();
                header("refresh: 0"); // Rechargement de la page après validation
                exit;
            }
            ?>
        </div>

        <?php
            include 'identification.php'; // Inclusion du fichier pour l'authentification
        ?>

    </div>

</div>
</body>
</html>
