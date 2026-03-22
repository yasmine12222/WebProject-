<?php
include '../../Controllers/BookController.php';
$bookController = new BookController();
$bookController->deleteBook($_GET['id']);
header('Location: bookList.php?success=1');
exit;