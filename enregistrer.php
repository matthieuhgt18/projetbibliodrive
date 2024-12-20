<?php
                                    $servername = "localhost";
                                    $dbname = "bibliodrive";
                                    $username = "";
                                    $password = "";
                                    $adresse = ""; 
                                    $conn = "";
                                    $conn = new mysqli($servername,$dbname, $username, $password, $adresse);
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
