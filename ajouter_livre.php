<?php
// Connexion à la base de données
try {
    $conn = new PDO("mysql:host=localhost;dbname=bibliodrive", "root", "");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion à la base de données : " . $e->getMessage());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        // Récupération des données du formulaire
        $auteur_id = $_POST['auteur'];
        $titre = $_POST['titre'];
        $isbn13 = $_POST['isbn'];  // ISBN13
        $anneeparution = $_POST['annee_parution'];
        $detail = $_POST['resume'];  // Resume -> detail

        // Vérifier si un fichier a été téléchargé et qu'il n'y a pas d'erreur
        if (!empty($_FILES['image']['name']) && $_FILES['image']['error'] == 0) {
            // Définir le chemin où l'image sera enregistrée
            $image_directory = "images/"; // Dossier où l'image sera enregistrée
            $image_name = basename($_FILES['image']['name']); // Nom de l'image
            $image_path = $image_directory . $image_name;  // Chemin complet vers l'image

            // Vérifier si le dossier existe, sinon le créer
            if (!file_exists($image_directory)) {
                mkdir($image_directory, 0777, true);  // Créer le dossier avec des permissions en lecture/écriture
            }

            // Déplacer l'image du répertoire temporaire vers le dossier cible
            move_uploaded_file($_FILES['image']['tmp_name'], $image_path);
        } else {
            // Si aucun fichier n'est téléchargé, définir l'image comme null
            $image_path = null;
        }

        // Insertion des données dans la table livre
        $stmt = $conn->prepare("
            INSERT INTO livre (noauteur, titre, isbn13, anneeparution, detail, photo, dateajout)
            VALUES (?, ?, ?, ?, ?, ?, NOW())
        ");
        $stmt->execute([$auteur_id, $titre, $isbn13, $anneeparution, $detail, $image_path]);

        $message = "Livre ajouté avec succès !";
    } catch (PDOException $e) {
        $message = "Erreur lors de l'ajout du livre : " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un Livre</title>
</head>
<body>
    <h1>Ajouter un Livre</h1>
    
    <?php if (isset($message)) { echo "<p>$message</p>"; } ?>

    <form method="POST" enctype="multipart/form-data">
        <!-- Liste déroulante des auteurs -->
        <label for="auteur">Auteur :</label>
        <select name="auteur" id="auteur" required>
            <?php
            try {
                // Requête pour récupérer les auteurs
                $query = "SELECT noauteur, prenom, nom FROM auteur";
                $result = $conn->query($query);

                if ($result && $result->rowCount() > 0) {
                    // Remplir la liste déroulante avec les résultats
                    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                        $id = ($row['noauteur']);
                        $prenom = ($row['prenom']);
                        $nom = ($row['nom']);
                        echo "<option value='$id'>$prenom $nom</option>";
                    }
                } else {
                    // Si aucun auteur n'est trouvé
                    echo "<option disabled>Aucun auteur trouvé</option>";
                }
            } catch (PDOException $e) {
                echo "<option disabled>Erreur : " . $e->getMessage() . "</option>";
            }
            ?>
        </select><br>

        <!-- Autres champs du formulaire -->
        <label for="titre">Titre :</label>
        <input type="text" name="titre" id="titre" required><br>

        <label for="isbn">ISBN13 :</label>
        <input type="text" name="isbn" id="isbn" required><br>

        <label for="annee_parution">Année de parution :</label>
        <input type="number" name="annee_parution" id="annee_parution" required><br>

        <label for="resume">Résumé :</label>
        <textarea name="resume" id="resume" required></textarea><br>

        <label for="image">Image :</label>
        <input type="file" name="image" id="image" required><br>

        <!-- Bouton de soumission -->
        <button type="submit">Ajouter</button>
    </form>

    <a href="http://localhost/projetbibliodrive2/accueil.php">Retour à l'Accueil</a>
</body>
</html>
