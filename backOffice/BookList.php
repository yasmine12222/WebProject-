<?php
include '../../Controllers/BookController.php';
$bookController = new BookController();
$books = $bookController->listBooks();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catalogue des Livres</title>
    <link rel="stylesheet" type="text/css" href="/Views/assets/vendor/font-awesome/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="/Views/assets/vendor/bootstrap-icons/bootstrap-icons.css">
    <link rel="stylesheet" type="text/css" href="/Views/assets/css/style.css">
</head>
<body>

<!-- Header simple -->
<header class="bg-dark py-3 mb-4">
    <div class="container">
        <h2 class="text-white mb-0"><i class="bi bi-book me-2"></i>Catalogue des Livres</h2>
    </div>
</header>

<main>
    <section>
        <div class="container">

            <?php if (empty($books)): ?>
                <div class="text-center text-muted py-5">
                    <i class="bi bi-book fs-1"></i>
                    <p class="mt-2">Aucun livre disponible pour le moment.</p>
                </div>
            <?php else: ?>
                <div class="row g-4">
                    <?php foreach ($books as $book): ?>
                        <?php if (!$book->getStatus()) continue; // n'afficher que les livres disponibles ?>
                        <div class="col-sm-6 col-lg-4 col-xl-3">
                            <div class="card h-100 shadow-sm border">
                                <!-- icône décorative -->
                                <div class="card-img-top bg-primary bg-opacity-10 d-flex align-items-center justify-content-center"
                                     style="height:140px;">
                                    <i class="bi bi-book-half text-primary" style="font-size:4rem;"></i>
                                </div>
                                <div class="card-body d-flex flex-column">
                                    <span class="badge bg-secondary mb-2 align-self-start">
                                        <?= htmlspecialchars($book->getCategoryTitle()) ?>
                                    </span>
                                    <h5 class="card-title mb-1"><?= htmlspecialchars($book->getTitle()) ?></h5>
                                    <p class="text-muted small mb-0">
                                        <i class="bi bi-person me-1"></i><?= htmlspecialchars($book->getAuthor()) ?>
                                    </p>
                                    <?php if ($book->getPublicationDate()): ?>
                                        <p class="text-muted small mb-0">
                                            <i class="bi bi-calendar3 me-1"></i><?= htmlspecialchars($book->getPublicationDate()) ?>
                                        </p>
                                    <?php endif; ?>
                                    <p class="text-muted small mb-2">
                                        <i class="bi bi-translate me-1"></i><?= htmlspecialchars($book->getLanguage() ?: '—') ?>
                                    </p>
                                    <div class="mt-auto">
                                        <p class="mb-2 small">
                                            <i class="bi bi-files me-1"></i>
                                            <strong><?= (int)$book->getNumberOfCopies() ?></strong> exemplaire(s) disponible(s)
                                        </p>
                                        <a href="bookDetail.php?id=<?= $book->getId() ?>" class="btn btn-outline-primary btn-sm w-100">
                                            <i class="bi bi-eye me-1"></i>Voir les détails
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

        </div>
    </section>
</main>

<script src="/Views/assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>