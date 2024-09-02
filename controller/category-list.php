<?php
require_once __DIR__.'/../model/connectaBD.php';
require_once __DIR__.'/../model/categories.php';

$conn = connectaBD();
$categories = getCategories($conn);

foreach ($categories as $key => $value) {
    $categories[$key]['nom'] = htmlentities($value['nom'], ENT_QUOTES | ENT_HTML5, 'UTF-8');
}

include __DIR__.'/../view/header.php';
include __DIR__.'/../view/category-list.php';
?>



