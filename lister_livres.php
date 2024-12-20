<?php
include 'config.php';

// Vérifier si un auteur est recherché
$nomAuteur = $_GET['author'] ?? '';
$livres = [];
if (!empty($nomAuteur)) {
    $stmt = $pdo->prepare("SELECT l.nolivre, l.titre 
                           FROM livre l
                           JOIN auteur a ON l.noauteur = a.noauteur
                           WHERE a.nom LIKE :nomAuteur");
    $stmt->execute(['nomAuteur' => '%' . $nomAuteur . '%']);
    $livres = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des livres</title>
    <!-- Liens Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <!-- Barre de navigation -->
    <nav class="navbar navbar-light bg-light">
        <a class="navbar-brand" href="accueil.php">Biblio-Drive</a>
        <form class="form-inline" action="lister_livres.php" method="get">
            <input class="form-control mr-sm-2" type="search" name="author" placeholder="Rechercher un auteur" value="<?= htmlspecialchars($nomAuteur) ?>">
            <button class="btn btn-outline-success" type="submit">Rechercher</button>
        </form>
    </nav>

    <!-- Liste des livres -->
    <div class="container mt-4">
        <h2>Résultats de recherche</h2>
        <?php if (empty($livres)): ?>
            <p>Aucun livre trouvé pour cet auteur.</p>
        <?php else: ?>
            <ul class="list-group">
                <?php foreach ($livres as $livre): ?>
                    <li class="list-group-item">
                        <a href="detail.php?nolivre=<?= $livre['nolivre'] ?>">
                            <?= htmlspecialchars($livre['titre']) ?>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
    </div>
</body>
</html>
