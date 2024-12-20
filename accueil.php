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

require_once("connexion.php");

?>

                <!-- Barre de navigation -->
<body>
    <div class="container text-center">
        <div class="row">
            <div class="col-sm-9" style="background-color:lavender">
                <h5>Bonjour cher Paysan, nous sommes fermés dorénavanant. <br>
                    Mais il vous est possible de réserver et retirer des livres.</h5>
                <form class="d-flex">
                        <input class="form-control me-2" type="text" placeholder="Recherchez votre livre ici..." style="width: 300px;">
                        <button class="btn btn-primary" type="button">Recherche</button>
                </form>
            </div>   
            <div class="col-sm-3" style="background-color:lavenderblush">
                    <img src="moulinsart.webp" alt="Image Moulinsart" class="rounded" style="max-height: 100px;">
            </div>
        </div>
        <div class="row">
            <div class="col-sm-9">

                 <!-- Carrousel des livres -->
                  
 <div class="row">
    <div class="col-sm-9">
        <h2 class="text-center mb-4">Dernières acquisitions</h2>
        <div id="carouselBooks" class="carousel slide" data-bs-ride="carousel">
            <!-- Indicateurs -->
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselBooks" data-bs-slide-to="0" class="active"></button>
                <button type="button" data-bs-target="#carouselBooks" data-bs-slide-to="1"></button>
                <button type="button" data-bs-target="#carouselBooks" data-bs-slide-to="2"></button>
            </div>

            <!-- Images du carrousel -->
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="livre1.jpg" alt="Livre 1" class="d-block w-100" style="width:15%">
                </div>
                <div class="carousel-item">
                    <img src="livre2.jpg" alt="Livre 2" class="d-block w-100" style="width:15%">
                </div>
                <div class="carousel-item">
                    <img src="livre3.jpg" alt="Livre 3" class="d-block w-100" style="width:15%">
                </div>
            </div>

            <!-- Contrôles du carrousel -->
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselBooks" data-bs-slide="prev">
                <span class="carousel-control-prev-icon"></span>
                <span class="visually-hidden">Précédent</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselBooks" data-bs-slide="next">
                <span class="carousel-control-next-icon"></span>
                <span class="visually-hidden">Suivant</span>
            </button>
        </div>
    </div>
</div>
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

                    
