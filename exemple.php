<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bibliothèque</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>

<?php

// Connexion au serveur

try {
  $dns = 'mysql:host=localhost;dbname=bibliodrive'; // dbname : nom de la base
  $utilisateur = 'root'; // root sur vos postes
  $motDePasse = ''; // pas de mot de passe sur vos postes
  $connexion = new PDO( $dns, $utilisateur, $motDePasse );
} catch (Exception $e) {
  echo "Connexion à MySQL impossible : ", $e->getMessage();
  die();
}

?>

  
                <!-- Barre de navigation -->
<body>
    <div class="container text-center">
    <?php
    require_once("recherche.php");
    ?>
    <div class="row">
            <div class="col-sm-9">
                <!--page principale-->
            </div>

            <!-- Formulaire d'enregistrement -->
            <div class="col-sm-3" style="background-color:lavenderblush">
                <h2 class="text-center">Formulaire d'enregistrement</h2>
                <?php
                require_once("authentification.php");             ?>
            </div>
        </div>
    </div>
</body>
</html>

                    
