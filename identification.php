<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
<div class="col-sm-3" style="background-color:lavenderblush;">
<?php

require_once 'connexion.php';


if (isset($_SESSION['prenom'])) { // Vérifier si l'utilisateur est connecté
    echo '<h4>Connexion réussie ! Bienvenue ' . $_SESSION['prenom'] . '</h4>';
    
    // Affichage du menu admin uniquement si l'utilisateur est admin
    if ($_SESSION['mel'] === 'admin@admin.fr') {
        echo '<h5>Vous êtes connecté en tant qu\'administrateur.</h5>';
        echo '<form action="ajouter_livre.php" method="get">';
        echo '<input type="submit" value="Ajouter un livre" class="btn btn-primary">';
        echo '</form>';
        echo '<form action="creer_membre.php" method="get">';
        echo '<input type="submit" value="Créer un membre" class="btn btn-secondary">';
        echo '</form>';
    }

    // Formulaire de déconnexion
    echo '<form action="" method="post">';
    echo '<input type="submit" name="btnSeDeconnecter" value="Se déconnecter" class="btn btn-danger">';
    echo '</form>';

    // Traitement de la déconnexion
    if (isset($_POST['btnSeDeconnecter'])) {
        session_unset(); // Supprimer toutes les variables de session
        session_destroy(); // Détruire la session
    }

} else {
    /* DEBUT FORMULAIRE DE CONNEXION */
    if (!isset($_POST['btnSeConnecter']) or (isset($_SESSION['prenom']))) {
        // Affichage du formulaire si l'utilisateur n'est pas connecté
        echo '
            <form action="" method="post">
            <br><br>
            Mel: <input name="mel" type="text" size="30">
            <br><br>
            Mot de passe: <input name="motdepasse" type="password" size="30">
            <br><br>
            <input type="submit" name="btnSeConnecter" value="Se connecter" class="btn btn-success">
            </form>';
    } else {
        // Traitement lors de la soumission du formulaire de connexion
        require_once 'connexion.php';
        $mel = $_POST['mel'];
        $motdepasse = $_POST['motdepasse'];

        // Variable de session pour l'email
        $_SESSION["mel"] = $mel;

        $stmt = $connexion->prepare("SELECT * FROM utilisateur WHERE mel=:mel AND motdepasse=:motdepasse");
        $stmt->bindValue(":mel", $mel);
        $stmt->bindValue(":motdepasse", $motdepasse);
        $stmt->setFetchMode(PDO::FETCH_OBJ);

        $stmt->execute();
        $enregistrement = $stmt->fetch(); // Récupération des informations de l'utilisateur

        if ($enregistrement) {
            echo '<h4>Connexion réussie ! Bienvenue ' . $enregistrement->prenom . '</h4>';

            // Variables de session avec les informations de l'utilisateur
            $prenom = $enregistrement->prenom;
            $nom = $enregistrement->nom;
            $_SESSION["prenom"] = $enregistrement->prenom;
            $_SESSION["nom"] = $enregistrement->nom;

            // Affichage du message pour l'admin
            if ($mel === 'admin@admin.fr') {
                echo '<h5>Vous êtes connecté en tant qu\'administrateur.</h5>';
                echo '<form action="ajouter_livre.php" method="get">';
                echo '<input type="submit" value="Ajouter un livre" class="btn btn-primary">';
                echo '</form>';
                echo '<form action="creer_membre.php" method="get">';
                echo '<input type="submit" value="Créer un membre" class="btn btn-secondary">';
                echo '</form>';
            }

        } else {
            echo "Echec de la connexion. Identifiants incorrects.";
        }
    }
    /* FIN FORMULAIRE DE CONNEXION */
}

?>
</div>
</body>
</html>
