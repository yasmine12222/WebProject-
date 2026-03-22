<?php
include '../../Controllers/BookController.php';
include '../../Controllers/CategoryController.php';
require_once __DIR__ . '/../../Models/Book.php';

$bookController     = new BookController();
$categoryController = new CategoryController();
$categories         = $categoryController->listCategories();
$error              = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title            = trim($_POST['title'] ?? '');
    $author           = trim($_POST['author'] ?? '');
    $publication_date = $_POST['publication_date'] ?? null;
    $language         = trim($_POST['language'] ?? '');
    $status           = isset($_POST['status']) ? 1 : 0;
    $number_of_copies = (int)($_POST['number_of_copies'] ?? 1);
    $category_id      = !empty($_POST['category_id']) ? (int)$_POST['category_id'] : null;

    if (empty($title)) {
        $error = "Le titre est obligatoire.";
    } elseif (empty($author)) {
        $error = "L'auteur est obligatoire.";
    } else {
        $book = new Book($title, $author, $publication_date, $language, $status, $number_of_copies, $category_id);
        $bookController->addBook($book);
        header('Location: bookList.php?success=1');
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un livre</title>
    <link rel="stylesheet" type="text/css" href="/Views/assets/vendor/bootstrap-icons/bootstrap-icons.css">
    <link rel="stylesheet" type="text/css" href="/Views/assets/css/style.css">
</head>
<body>
<main>
    <section class="pt-4">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">

                    <div class="d-flex align-items-center mb-4">
                        <h1 class="fs-4 mb-0"><i class="bi bi-book fa-fw me-2"></i>Ajouter un livre</h1>
                        <a href="bookList.php" class="btn btn-outline-secondary btn-sm ms-auto">
                            <i class="bi bi-list me-1"></i>Liste des livres
                        </a>
                    </div>

                    <?php if (!empty($error)): ?>
                        <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
                    <?php endif; ?>

                    <div class="card border">
                        <div class="card-body p-4">
                            <form action="" method="POST" id="bookForm">

                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label for="title" class="form-label">Titre <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="title" name="title"
                                               value="<?= htmlspecialchars($_POST['title'] ?? '') ?>"
                                               placeholder="Titre du livre">
                                    </div>

                                    <div class="col-md-6">
                                        <label for="author" class="form-label">Auteur <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="author" name="author"
                                               value="<?= htmlspecialchars($_POST['author'] ?? '') ?>"
                                               placeholder="Nom de l'auteur">
                                    </div>

                                    <div class="col-md-6">
                                        <label for="publication_date" class="form-label">Date de publication</label>
                                        <input type="date" class="form-control" id="publication_date" name="publication_date"
                                               value="<?= htmlspecialchars($_POST['publication_date'] ?? '') ?>">
                                    </div>

                                    <div class="col-md-6">
                                        <label for="language" class="form-label">Langue</label>
                                        <input type="text" class="form-control" id="language" name="language"
                                               value="<?= htmlspecialchars($_POST['language'] ?? '') ?>"
                                               placeholder="ex: Français, English…">
                                    </div>

                                    <div class="col-md-6">
                                        <label for="number_of_copies" class="form-label">Nombre d'exemplaires</label>
                                        <input type="number" class="form-control" id="number_of_copies" name="number_of_copies"
                                               min="0" value="<?= (int)($_POST['number_of_copies'] ?? 1) ?>">
                                    </div>

                                    <div class="col-md-6">
                                        <label for="category_id" class="form-label">Catégorie</label>
                                        <select class="form-select" id="category_id" name="category_id">
                                            <option value="">-- Choisir une catégorie --</option>
                                            <?php foreach ($categories as $cat): ?>
                                                <option value="<?= $cat->getId() ?>"
                                                    <?= (isset($_POST['category_id']) && $_POST['category_id'] == $cat->getId()) ? 'selected' : '' ?>>
                                                    <?= htmlspecialchars($cat->getTitle()) ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>

                                    <div class="col-12">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" id="status" name="status"
                                                   <?= (!isset($_POST['status']) || $_POST['status']) ? 'checked' : '' ?>>
                                            <label class="form-check-label" for="status">Disponible</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="text-center mt-4">
                                    <button type="submit" class="btn btn-primary px-4">
                                        <i class="bi bi-plus-circle me-1"></i>Ajouter
                                    </button>
                                    <a href="bookList.php" class="btn btn-secondary px-4 ms-2">Annuler</a>
                                </div>

                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
</main>

<script src="/Views/assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<script>
document.getElementById('bookForm').addEventListener('submit', function(e) {
    const title  = document.getElementById('title').value.trim();
    const author = document.getElementById('author').value.trim();
    if (!title) { e.preventDefault(); alert(' Le titre est obligatoire.'); return; }
    if (title.length < 2) { e.preventDefault(); alert(' Le titre doit contenir au moins 2 caractères.'); return; }
    if (!author) { e.preventDefault(); alert(' L\'auteur est obligatoire.'); return; }
});
</script>
</body>
</html>