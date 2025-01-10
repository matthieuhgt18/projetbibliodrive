<div class="container mt-5">
    <div class="row">
        <!-- RECHERCHE -->
        <div class="col-sm-9">
            <form class="d-flex align-items-center" action="" method="post">
                <?php
                // Connexion à la base de données
                require_once('connexion.php');

                echo '
                    <div class="input-group">
                        <input name="nomauteur" type="text" class="form-control" placeholder="Rechercher un auteur..." value="' . (isset($_POST['nomauteur']) ? htmlspecialchars($_POST['nomauteur']) : '') . '">
                        <button type="submit" name="chercher" class="btn btn-primary">Rechercher</button>
                    </div>';
                ?>
            </form>
            <div id="resultats" class="mt-4">
                <?php
                if (isset($_POST['chercher'])) {
                    try {
                        $stmt = $connexion->prepare("
                            SELECT nolivre, titre, anneeparution 
                            FROM livre 
                            INNER JOIN auteur ON livre.noauteur = auteur.noauteur 
                            WHERE auteur.nom LIKE :nomauteur 
                            ORDER BY anneeparution
                        ");

                        $nomauteur = $_POST["nomauteur"];
                        $stmt->bindValue(":nomauteur", "%" . $nomauteur . "%");
                        $stmt->setFetchMode(PDO::FETCH_OBJ);
                        $stmt->execute();

                        echo '<h3>Résultats de la recherche :</h3>';
                        $resultFound = false;

                        while ($enregistrement = $stmt->fetch()) {
                            $resultFound = true;
                            echo '<div class="mt-2">',
                                '<a href="detail.php?nolivre=' . $enregistrement->nolivre . '">' . htmlspecialchars($enregistrement->titre),
                                ' (', $enregistrement->anneeparution, ')</a>',
                                '</div>';
                        }

                        if (!$resultFound) {
                            echo '<p class="text-danger">Aucun livre trouvé pour cet auteur.</p>';
                        }
                    } catch (PDOException $e) {
                        echo '<p class="text-danger">Erreur : ' . $e->getMessage() . '</p>';
                    }
                }
                ?>
            </div>
        </div>

        <!-- IMAGE OU CONTENU STATIQUE + BOUTON PANIER -->
        <div class="col-sm-3 text-center">
            <div style="background-color:lavenderblush; padding: 15px; border-radius: 8px;">
                <a href="http://localhost/projetbibliodrive2/accueil.php">
                    <img id="photo" src="moulinsart.jpg" alt="Photo château de Moulinsart de Tintin" class="rounded mb-3" style="width:100%; height:auto;">
                </a>
                <a href="panier.php" class="btn btn-outline-primary btn-block">Accéder au Panier</a>
            </div>
        </div>
    </div>
</div>


