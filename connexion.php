<<<<<<< HEAD
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

=======
<?php
// Connexion au serveur
try {
  $dns = 'mysql:host=localhost;dbname=exotablo'; // dbname : nom de la base
  $utilisateur = 'root'; // root sur vos postes
  $motDePasse = ''; // pas de mot de passe sur vos postes
  $connexion = new PDO( $dns, $utilisateur, $motDePasse );
} catch (Exception $e) {
  echo "Connexion à MySQL impossible : ", $e->getMessage();
  die();
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "utilisateur_db"; 
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("La connexion a échoué: " . $conn->connect_error);
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $adresse = $_POST['adresse'];
    $sql = "INSERT INTO utilisateurs (nom, prenom, adresse) VALUES ('$nom', '$prenom', '$adresse')";
    if ($conn->query($sql) === TRUE) {
        echo "Les données ont été enregistrées avec succès.";
    } else {
        echo "Erreur: " . $sql . "<br>" . $conn->error;
    }
    $conn->close();
}

>>>>>>> c85c03331bd689311edb1e5c21554f175d34b421
?>