<<<<<<< HEAD
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Accueil</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
<div class="container text-center">
    <div class="row">
        <div class="col-sm-9" style="background-color:lavender">
            <h5>Bonjour cher Paysan, nous sommes fermés dorénavanant. <br>
                Mais il vous est possible de réserver et retirer des livres.</h5>

            <!-- Barre de recherche -->
            <div class="row">
                <div class="col-sm-9">
                    <form class="d-flex">
                        <input class="form-control me-2" type="text" placeholder="Recherchez votre livre ici..." style="width: 300px;">
                        <button class="btn btn-primary" type="button">Recherche</button>
                    </form>
                </div>
                <div class="col-sm-3" style="background-color:lavenderblush">
                    <img src="moulinsart.webp" alt="Image Moulinsart" class="rounded" style="max-height: 100px;">
                </div>
            </div>

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
            <form action="enregistrer.php" method="POST">
                <div class="mb-3">
                    <label for="nom" class="form-label">Nom:</label>
                    <input type="text" id="nom" name="nom" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="prenom" class="form-label">Prénom:</label>
                    <input type="text" id="prenom" name="prenom" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="adresse" class="form-label">Adresse:</label>
                    <input type="text" id="adresse" name="adresse" class="form-control"></text>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary">Envoyer</button>
                </div>
            </form>
</body>

</html>
=======
<<<<<<< HEAD
<!DOCTYPE html>

<html lang="fr">

<head>

  <title>Accueil</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
                    
	<body>
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-9">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mynavbar"> 
                        </button>
                        <div class="collapse navbar-collapse" id="mynavbar"></div>
                        <form class="d-flex">
                                <input class="form-control me-2" type="text" placeholder="Recherchez votre livre ici..." style="width: 300px;">
                                <button class="btn btn-primary" type="button" style="width: 100px;">Recherche</button>
                            </form>


			</div>
			<div class="col-sm-3">
            <img src="" alt="Image Moulinsart" class="rounded">
			</div>


                            </div class="row">
                            <div class="col-sm-9">
                                        <!-- Carousel -->
                                        <div id="demo" class="carousel slide" data-bs-ride="carousel">

                    <!-- Indicators/dots -->
                    <div class="carousel-indicators">
                    <button type="button" data-bs-target="#demo" data-bs-slide-to="0" class="active"></button>
                    <button type="button" data-bs-target="#demo" data-bs-slide-to="1"></button>
                    <button type="button" data-bs-target="#demo" data-bs-slide-to="2"></button>
                    </div>

                    <!-- The slideshow/carousel -->
                    <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="livre1.jpg" alt="Thomas" class="d-block w-100">
                    </div>
                    <div class="carousel-item">
                        <img src="livre2.jpg" alt="Vannes Rugby Club" class="d-block w-100">
                    </div>
                    <div class="carousel-item">
                        <img src="livre3.jpg" alt="Tintin au Congo" class="d-block w-100">
                    </div>
                    </div>

                    <!-- Left and right controls/icons -->
                    <button class="carousel-control-prev" type="button" data-bs-target="#demo" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon"></span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#demo" data-bs-slide="next">
                    <span class="carousel-control-next-icon"></span>
                    </button>
                    </div>/ résultat de la recherche / pages d'admin (ajout d'un livre)


			<div class="col-sm-3">
            <head>
                                                <meta charset="UTF-8">
                                                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                                                <title>Formulaire d'enregistrement</title>
                                                </head>
                                            <body>

                                                <h2>Formulaire d'enregistrement</h2>
                                                <form action="enregistrer.php" method="POST">
                                                    <label for="nom">Nom:</label>
                                                    <input type="text" id="nom" name="nom" required><br><br>

                                                    <label for="prenom">Prénom:</label>
                                                    <input type="text" id="prenom" name="prenom" required><br><br>

                                                    <label for="adresse">Adresse:</label>
                                                    <textarea id="adresse" name="adresse" required></textarea><br><br>

                                                    <input type="submit" value="Envoyer">
                                                </form>
                                                <div class="col-sm-3"> / profil connecté (include)
	</body>
</html>
=======
<!DOCTYPE html>

<html lang="fr">

<head>

  <title>Accueil</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
                    
	<body>
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-9">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mynavbar"> 
                        </button>
                        <div class="collapse navbar-collapse" id="mynavbar"></div>
                        <form class="d-flex">
                                <input class="form-control me-2" type="text" placeholder="Recherchez votre livre ici..." style="width: 300px;">
                                <button class="btn btn-primary" type="button" style="width: 100px;">Recherche</button>
                            </form>


			</div>
			<div class="col-sm-3">
            <img src="" alt="Image Moulinsart" class="rounded">
			</div>


                            </div class="row">
                            <div class="col-sm-9">
                                        <!-- Carousel -->
                                        <div id="demo" class="carousel slide" data-bs-ride="carousel">

                    <!-- Indicators/dots -->
                    <div class="carousel-indicators">
                    <button type="button" data-bs-target="#demo" data-bs-slide-to="0" class="active"></button>
                    <button type="button" data-bs-target="#demo" data-bs-slide-to="1"></button>
                    <button type="button" data-bs-target="#demo" data-bs-slide-to="2"></button>
                    </div>

                    <!-- The slideshow/carousel -->
                    <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="livre1.jpg" alt="Thomas" class="d-block w-100">
                    </div>
                    <div class="carousel-item">
                        <img src="livre2.jpg" alt="Vannes Rugby Club" class="d-block w-100">
                    </div>
                    <div class="carousel-item">
                        <img src="livre3.jpg" alt="Tintin au Congo" class="d-block w-100">
                    </div>
                    </div>

                    <!-- Left and right controls/icons -->
                    <button class="carousel-control-prev" type="button" data-bs-target="#demo" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon"></span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#demo" data-bs-slide="next">
                    <span class="carousel-control-next-icon"></span>
                    </button>
                    </div>/ résultat de la recherche / pages d'admin (ajout d'un livre)


			<div class="col-sm-3">
            <head>
                                                <meta charset="UTF-8">
                                                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                                                <title>Formulaire d'enregistrement</title>
                                                </head>
                                            <body>

                                                <h2>Formulaire d'enregistrement</h2>
                                                <form action="enregistrer.php" method="POST">
                                                    <label for="nom">Nom:</label>
                                                    <input type="text" id="nom" name="nom" required><br><br>

                                                    <label for="prenom">Prénom:</label>
                                                    <input type="text" id="prenom" name="prenom" required><br><br>

                                                    <label for="adresse">Adresse:</label>
                                                    <textarea id="adresse" name="adresse" required></textarea><br><br>

                                                    <input type="submit" value="Envoyer">
                                                </form>
                                                <div class="col-sm-3"> / profil connecté (include)
	</body>
</html>
>>>>>>> ab2eb803487120b3b96e5f5e5a150e16e34034c1
	
>>>>>>> c85c03331bd689311edb1e5c21554f175d34b421
