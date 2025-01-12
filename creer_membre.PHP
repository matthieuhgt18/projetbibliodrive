<?php
// Connexion à la base de données
$conn = new PDO("mysql:host=localhost;dbname=bibliodrive", "root", "");

// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        // Récupération des informations du formulaire
        $email = $_POST['email'];
        $mot_de_passe = password_hash($_POST['mot_de_passe'], PASSWORD_DEFAULT);
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $adresse = $_POST['adresse'];
        $ville = $_POST['ville'];
        $code_postal = $_POST['code_postal'];

        // Attribuer un profil par défaut si nécessaire
        $profil = 'utilisateur'; // Ou 'membre', selon vos préférences

        // Insertion dans la table utilisateur
        $stmt = $conn->prepare("
            INSERT INTO utilisateur (mel, motdepasse, nom, prenom, adresse, ville, codepostal, profil) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)
        ");
        $stmt->execute([$email, $mot_de_passe, $nom, $prenom, $adresse, $ville, $code_postal, $profil]);

        // Vérification de l'insertion
        $message = "Utilisateur créé avec succès !";
    } catch (PDOException $e) {
        $message = "Erreur lors de la création de l'utilisateur : " . $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Créer un Utilisateur</title>
</head>
<body>
    <h1>Créer un Utilisateur</h1>
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
