<?php
// Démarrage de la session
session_start();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Inclusion de Bootstrap pour les styles -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
<div class="container text-center">

    <!-- Inclusion de la barre de recherche -->
    <?php
        include 'recherche.php';
    ?>

    <div class="row">
        <div class="col-sm-9" style="background-color:lavender;">
        <br><br>
        <?php
        // Connexion à la base de données et récupération des détails du livre
        require_once('connexion.php');
        $stmt = $connexion->prepare("SELECT nom, prenom, dateretour, detail, isbn13, anneeparution, photo, titre FROM livre INNER JOIN auteur ON (livre.noauteur = auteur.noauteur) LEFT OUTER JOIN emprunter ON (livre.nolivre = emprunter.nolivre) where livre.nolivre=:nolivre");
        $nolivre = $_GET["nolivre"];
        $stmt->bindValue(":nolivre", $nolivre); // Paramétrage de la requête
        $stmt->setFetchMode(PDO::FETCH_OBJ); // Traitement en mode objet
        $stmt->execute(); // Exécution de la requête
        $enregistrement = $stmt->fetch(); // Récupération des résultats
        ?>

        <!-- Affichage des informations du livre -->
        <div class="row">
            <div class="col-sm-9">
                <?php
                    // Affichage des informations sur l'auteur, ISBN, titre et résumé
                    echo "Auteur : ".$enregistrement->prenom." ".$enregistrement->nom;
                    echo "<br>";
                    echo "ISBN13 : ".$enregistrement->isbn13; 
                    echo "<br>";
                    echo "Titre : ".$enregistrement->titre." ".$enregistrement->anneeparution;
                    echo "<br><br>";
                    echo "Résumé du livre :";
                    echo "<br>";
                    echo $enregistrement->detail;
                    $titre = $enregistrement->titre;
                    $_SESSION["titre"] = $enregistrement->titre; // Stocke le titre dans la session
                ?>
            </div>

            <!-- Affichage de l'image du livre -->
            <div class="col-sm-3">
                <img src=".\covers\<?php echo $enregistrement->photo?>" class="d-block w-100">
            </div>

            <!-- Section pour ajouter au panier si connecté -->
            <?php
                if (isset($_SESSION["prenom"])) { // Vérifie si l'utilisateur est connecté
                    echo '<h5>Disponible</h5>';
                    echo '<form method="POST">';
                    echo '<input type="submit" name="btn-ajoutpanier" value="Ajouter au panier">'; // Bouton pour ajouter au panier
                    echo '</form>';
                } else {
                    echo 'Pour pouvoir réserver ce livre connectez-vous !'; // Message si non connecté
                }

                // Initialisation du panier si non défini
                if(!isset($_SESSION['panier'])) {
                    $_SESSION['panier'] = array();
                }

                // Ajout du livre au panier
                if(isset($_POST['btn-ajoutpanier'])) {
                    array_push($_SESSION['panier'], $nolivre); // Ajoute le livre au panier
                    echo "Livre ajouté à votre panier";
                }
            ?>
        </div>
    </div>

    <!-- Inclusion de la section d'identification -->
    <?php
        include 'identification.php';
    ?>

</body>
</html>
