<?php

$id = 1;
if (isset($_GET['categoria_id'])) {
    $id = $_GET['categoria_id'];
}

require_once __DIR__.'/../model/connectaBD.php';
require_once __DIR__.'/../model/productes.php';

$conn = connectaBD();
$resultat_productes = consultaProducte($conn, $id);

include __DIR__.'/../view/product-list.php';
?>