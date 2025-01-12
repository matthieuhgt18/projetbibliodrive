<?php
// Démarrage de la session, instruction a placer en tête de script
session_start();
?>


<!DOCTYPE html>

<html lang="fr">

<head>

  <title>Accueil</title>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</head>
<body>
<div class="container text-center">

    <?php
        include 'recherche.php';
    ?>

    <div class="row">
        <div class="col-sm-9" style="background-color:grey;"><h5>Dernières aquisitions</h5><br>



        <!-- CAROUSSEL -->
        <?php
            // prend toutes les collones dans la table livre pour les 3 derniers livres
            require_once('connexion.php');
            $livres = $connexion->prepare("SELECT * FROM livre ORDER BY dateajout desc limit 3");
            $livres->setFetchMode(PDO::FETCH_OBJ);
            $livres->execute();

            //3variable couvertures pour afficher les images
            $couverture1 = $livres->fetch();
            $couverture2 = $livres->fetch();
            $couverture3 = $livres->fetch();
        ?>

    <div id="demo" class="carousel slide " data-bs-ride="carousel">
    <div class="carousel-indicators">  <!-- Indicateurs du carrousel -->
        <button type="button" data-bs-target="#demo" data-bs-slide-to="0" class="active"></button>
        <button type="button" data-bs-target="#demo" data-bs-slide-to="1"></button>
        <button type="button" data-bs-target="#demo" data-bs-slide-to="2"></button>
    </div>

        <div class="carousel-inner"> <!-- Contenu du carrousel -->
        <!-- Premier élément du carrousel -->
        <div class="carousel-item active">
            <img src=".\covers\<?php echo $couverture1->photo ?>" alt="<?php echo $couverture1->titre ?>" class="d-block mx-auto w-50">
            <!-- Afficher le titre sous l'image -->
            <div class="text-center mt-2">
                <h5><?php echo ($couverture1->titre); ?></h5>
            </div>
        </div>

        <!-- Deuxième élément du carrousel -->
        <div class="carousel-item">
            <img src=".\covers\<?php echo $couverture2->photo ?>" alt="<?php echo $couverture2->titre ?>" class="d-block mx-auto w-50">
            <div class="text-center mt-2">
                <h5><?php echo ($couverture2->titre); ?></h5>
            </div>
        </div>

        <!-- Troisième élément du carrousel -->
        <div class="carousel-item">
            <img src=".\covers\<?php echo $couverture3->photo ?>" alt="<?php echo $couverture3->titre ?>" class="d-block mx-auto w-50">
            <div class="text-center mt-2">
                <h5><?php echo ($couverture3->titre); ?></h5>
            </div>
        </div>
    </div>

    <!-- Boutons de navigation -->
    <button class="carousel-control-prev" type="button" data-bs-target="#demo" data-bs-slide="prev">
        <span class="carousel-control-prev-icon"></span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#demo" data-bs-slide="next">
        <span class="carousel-control-next-icon"></span>
    </button>
</div>



        </div>


        <?php
            include 'identification.php';
        ?>

        </div>
    </div>
</body>

</html> 
