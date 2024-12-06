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
	