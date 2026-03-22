<?php
include '../../Controllers/BookController.php';
$bookController = new BookController();
$book = null;

if (isset($_GET['id'])) {
    $book = $bookController->getBookById($_GET['id']);
}

if (!$book) {
    echo "<p class='text-center mt-5'>Livre introuvable. <a href='bookList.php'>Retour au catalogue</a></p>";
    exit;
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($book->getTitle()) ?> - Détail</title>
    <link rel="stylesheet" type="text/css" href="/Views/assets/vendor/bootstrap-icons/bootstrap-icons.css">
    <link rel="stylesheet" type="text/css" href="/Views/assets/css/style.css">
</head>
<body>

<header class="bg-dark py-3 mb-4">
    <div class="container d-flex align-items-center">
        <a href="bookList.php" class="btn btn-outline-light btn-sm me-3">
            <i class="bi bi-arrow-left me-1"></i>Catalogue
        </a>
        <h2 class="text-white mb-0"><i class="bi bi-book me-2"></i>Détail du livre</h2>
    </div>
</header>

<main>
    <section>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="card shadow border-0">

                        <!-- Bannière -->
                        <div class="card-img-top bg-primary bg-opacity-10 d-flex align-items-center justify-content-center"
                             style="height:200px;">
                            <i class="bi bi-book-half text-primary" style="font-size:6rem;"></i>
                        </div>

                        <div class="card-body p-4">

                            <!-- Catégorie badge -->
                            <span class="badge bg-secondary mb-3"><?= htmlspecialchars($book->getCategoryTitle()) ?></span>

                            <!-- Titre -->
                            <h2 class="card-title mb-1"><?= htmlspecialchars($book->getTitle()) ?></h2>

                            <!-- Disponibilité -->
                            <?php if ($book->getStatus()): ?>
                                <span class="badge bg-success mb-3">Disponible</span>
                            <?php else: ?>
                                <span class="badge bg-danger mb-3">Indisponible</span>
                            <?php endif; ?>

                            <hr>

                            <!-- Détails -->
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <p class="mb-1 text-muted small">Auteur</p>
                                    <p class="fw-semibold"><i class="bi bi-person me-1"></i><?= htmlspecialchars($book->getAuthor()) ?></p>
                                </div>

                                <div class="col-md-6">
                                    <p class="mb-1 text-muted small">Langue</p>
                                    <p class="fw-semibold">
                                        <i class="bi bi-translate me-1"></i>
                                        <?= htmlspecialchars($book->getLanguage() ?: '—') ?>
                                    </p>
                                </div>

                                <div class="col-md-6">
                                    <p class="mb-1 text-muted small">Date de publication</p>
                                    <p class="fw-semibold">
                                        <i class="bi bi-calendar3 me-1"></i>
                                        <?= htmlspecialchars($book->getPublicationDate() ?? '—') ?>
                                    </p>
                                </div>

                                <div class="col-md-6">
                                    <p class="mb-1 text-muted small">Exemplaires disponibles</p>
                                    <p class="fw-semibold">
                                        <i class="bi bi-files me-1"></i>
                                        <?= (int)$book->getNumberOfCopies() ?>
                                    </p>
                                </div>

                                <div class="col-md-6">
                                    <p class="mb-1 text-muted small">Catégorie</p>
                                    <p class="fw-semibold">
                                        <i class="bi bi-tag me-1"></i>
                                        <?= htmlspecialchars($book->getCategoryTitle()) ?>
                                    </p>
                                </div>
                            </div>

                            <hr>

                            <a href="bookList.php" class="btn btn-outline-secondary">
                                <i class="bi bi-arrow-left me-1"></i>Retour au catalogue
                            </a>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<script src="/Views/assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>