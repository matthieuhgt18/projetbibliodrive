<div class="container mt-5">
    <div class="row">
        <!-- RECHERCHE -->
        <div class="col-sm-9">
            <form class="d-flex align-items-center" action="" method="post">
                <?php
                // Connexion à la base de données
                require_once('connexion.php');

                // Formulaire de recherche d'auteur
                echo '
                <div class="input-group">
                    <input name="nomauteur" type="text" class="form-control" placeholder="Rechercher un auteur..." value="' . (isset($_POST['nomauteur']) ? htmlspecialchars($_POST['nomauteur']) : '') . '">
                    <button type="submit" name="chercher" class="btn btn-primary">Rechercher</button>
                </div>';
            
                ?>
            </form>

            <!-- Section pour afficher les résultats de la recherche -->
            <div id="resultats" class="mt-4">
                <?php
                // Lorsque le bouton "Rechercher" est cliqué
                if (isset($_POST['chercher'])) {
                    try {
                        // Requête pour chercher les livres par auteur
                        $stmt = $connexion->prepare("
                            SELECT nolivre, titre, anneeparution 
                            FROM livre 
                            INNER JOIN auteur ON livre.noauteur = auteur.noauteur 
                            WHERE auteur.nom LIKE :nomauteur 
                            ORDER BY anneeparution
                        ");

                        // Récupération du nom de l'auteur et préparation de la recherche
                        $nomauteur = $_POST["nomauteur"];
                        $stmt->bindValue(":nomauteur", "%" . $nomauteur . "%"); // Recherche de l'auteur avec LIKE
                        $stmt->setFetchMode(PDO::FETCH_OBJ); // Mode d'extraction des résultats en tant qu'objet
                        $stmt->execute(); // Exécution de la requête

                        // Affichage du titre des résultats de la recherche
                        echo '<h3>Résultats de la recherche :</h3>';
                        $resultFound = false; // Variable pour vérifier s'il y a des résultats

                        // Affichage des livres trouvés
                        while ($enregistrement = $stmt->fetch()) {
                            $resultFound = true;
                            echo '<div class="mt-2">',
                                '<a href="detail.php?nolivre=' . $enregistrement->nolivre . '">' . ($enregistrement->titre),
                                ' (', $enregistrement->anneeparution, ')</a>', // Lien vers la page de détail du livre
                                '</div>';
                        }

                        // Message si aucun livre n'est trouvé pour l'auteur recherché
                        if (!$resultFound) {
                            echo '<p class="text-danger">Aucun livre trouvé pour cet auteur.</p>';
                        }
                    } catch (PDOException $e) {
                        // Gestion des erreurs lors de la requête
                        echo '<p class="text-danger">Erreur : ' . $e->getMessage() . '</p>';
                    }
                }
                ?>
            </div>
        </div>

        <!-- IMAGE OU CONTENU STATIQUE + BOUTON PANIER -->
        <div class="col-sm-3 text-center">
            <div style="background-color:lavenderblush; padding: 15px; border-radius: 8px;">
                <!-- Image du château de Moulinsart avec lien -->
                <a href="http://localhost/projetbibliodrive2/accueil.php">
                    <img id="photo" src="moulinsart.jpg" alt="Photo château de Moulinsart de Tintin" class="rounded mb-3" style="width:100%; height:auto;">
                </a>
                <!-- Lien vers le panier -->
                <a href="panier.php" class="btn btn-outline-primary btn-block">Accéder au Panier</a>
            </div>
        </div>
    </div>
</div>
