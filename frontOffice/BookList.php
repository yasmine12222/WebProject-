<?php
include '../../Controllers/BookController.php';
include '../../Controllers/CategoryController.php';
$bookController = new BookController();
$books = $bookController->listBooks();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des livres - Back Office</title>
    <link rel="stylesheet" type="text/css" href="/Views/assets/vendor/font-awesome/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="/Views/assets/vendor/bootstrap-icons/bootstrap-icons.css">
    <link rel="stylesheet" type="text/css" href="/Views/assets/css/style.css">
</head>
<body>
<main>
    <section class="pt-4">
        <div class="container vstack gap-4">

            <div class="row align-items-center">
                <div class="col">
                    <h1 class="fs-4 mb-0"><i class="bi bi-book fa-fw me-1"></i>Gestion des Livres</h1>
                </div>
                <div class="col-auto">
                    <a href="add-book.php" class="btn btn-primary btn-sm">
                        <i class="bi bi-plus-lg me-1"></i>Ajouter un livre
                    </a>
                </div>
            </div>

            <?php if (isset($_GET['success'])): ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    Opération effectuée avec succès !
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            <?php endif; ?>

            <div class="card border">
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>#</th>
                                    <th>Titre</th>
                                    <th>Auteur</th>
                                    <th>Date publication</th>
                                    <th>Langue</th>
                                    <th>Statut</th>
                                    <th>Exemplaires</th>
                                    <th>Catégorie</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (empty($books)): ?>
                                    <tr>
                                        <td colspan="9" class="text-center text-muted py-4">Aucun livre trouvé.</td>
                                    </tr>
                                <?php else: ?>
                                    <?php foreach ($books as $book): ?>
                                        <tr>
                                            <td><?= $book->getId() ?></td>
                                            <td class="fw-semibold"><?= htmlspecialchars($book->getTitle()) ?></td>
                                            <td><?= htmlspecialchars($book->getAuthor()) ?></td>
                                            <td><?= htmlspecialchars($book->getPublicationDate() ?? '—') ?></td>
                                            <td><?= htmlspecialchars($book->getLanguage()) ?></td>
                                            <td>
                                                <?php if ($book->getStatus()): ?>
                                                    <span class="badge bg-success">Disponible</span>
                                                <?php else: ?>
                                                    <span class="badge bg-secondary">Indisponible</span>
                                                <?php endif; ?>
                                            </td>
                                            <td><?= (int)$book->getNumberOfCopies() ?></td>
                                            <td><?= htmlspecialchars($book->getCategoryTitle()) ?></td>
                                            <td class="text-center">
                                                <a href="editBook.php?id=<?= $book->getId() ?>" class="btn btn-sm btn-outline-primary me-1">
                                                    <i class="bi bi-pencil"></i>
                                                </a>
                                                <button type="button" class="btn btn-sm btn-outline-danger"
                                                    onclick="if(confirm('Supprimer ce livre ?')) window.location.href='deleteBook.php?id=<?= $book->getId() ?>'">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </section>
</main>
<script src="/Views/assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>