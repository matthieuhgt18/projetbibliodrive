<?php

require_once("connexion.php");
if (!isset($_POST['btnSeConnecter'])) { /* L'entrée btnSeConnecter est vide = le formulaire n'a pas été submit=posté, on affiche le formulaire */
    echo '
    <form action="" method = "post" ">
        Mel: <input name="mel" type="text" size ="30"">
        Mot de passe: <input name="mot_de_passe" type="text" size ="30"">
        <input type="submit" name="btnSeConnecter"  value="Se connecter">
    </form>';


} 
?>