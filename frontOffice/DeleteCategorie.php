<?php
include '../../Controllers/CategoryController.php';
$categoryC = new CategoryController();
$categoryC->deleteCategory($_GET["id"]);
header('Location: categoryList.php');