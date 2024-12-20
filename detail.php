<?php
include 'config.php';

$nolivre = $_GET['nolivre'] ?? null;
if ($nolivre) {
    $stmt = $pdo->prepare("SELECT titre, resume, image FROM livre WHERE nolivre = :nolivre");
    $stmt->execute(['nolivre' => $nolivre]);
    $livre = $stmt->fetch(PDO::FETCH_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détail du livre</title>
    <!-- Liens Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <?php if ($livre): ?>
            <h1><?= htmlspecialchars($livre['titre']) ?></h1>
            <img src="livres/<?= htmlspecialchars($livre['image']) ?>" class="img-fluid" alt="<?= htmlspecialchars($livre['titre']) ?>">
            <p><?= htmlspecialchars($livre['resume']) ?></p>
        <?php else: ?>
            <p>Livre introuvable.</p>
        <?php endif; ?>
    </div>
</body>
</html>
