<?php
$conn = new PDO("mysql:host=localhost;dbname=bibliodrive", "root", "");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        $email = $_POST['email'];
        $mot_de_passe = password_hash($_POST['mot_de_passe'], PASSWORD_DEFAULT);
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $adresse = $_POST['adresse'];
        $ville = $_POST['ville'];
        $code_postal = $_POST['code_postal'];

        // Insertion dans la table membre
        $stmt = $conn->prepare("
            INSERT INTO membre (email, mot_de_passe, nom, prenom, adresse, ville, code_postal, date_inscription) 
            VALUES (?, ?, ?, ?, ?, ?, ?, NOW())
        ");
        $stmt->execute([$email, $mot_de_passe, $nom, $prenom, $adresse, $ville, $code_postal]);

        $message = "Membre créé avec succès !";
    } catch (PDOException $e) {
        $message = "Erreur lors de la création du membre : " . $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Créer un Membre</title>
</head>
<body>
    <h1>Créer un Membre</h1>
    <?php if (isset($message)) { echo "<p>$message</p>"; } ?>
    <form method="POST">
        <label for="email">Email :</label>
        <input type="email" name="email" id="email" required><br>

        <label for="mot_de_passe">Mot de passe :</label>
        <input type="password" name="mot_de_passe" id="mot_de_passe" required><br>

        <label for="nom">Nom :</label>
        <input type="text" name="nom" id="nom" required><br>

        <label for="prenom">Prénom :</label>
        <input type="text" name="prenom" id="prenom" required><br>

        <label for="adresse">Adresse :</label>
        <input type="text" name="adresse" id="adresse" required><br>

        <label for="ville">Ville :</label>
        <input type="text" name="ville" id="ville" required><br>

        <label for="code_postal">Code postal :</label>
        <input type="text" name="code_postal" id="code_postal" required><br>

        <button type="submit">Créer</button>
    </form>
    <a href="ajouter_livre.php">Aller à la page Ajouter un Livre</a><br>
    <a href="accueil.php">Aller à l'Accueil</a>
</body>
</html>

