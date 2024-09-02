<?php

$id = 1;
if (isset($_GET['productes_id'])) {
    $id = $_GET['productes_id'];
}

require_once __DIR__.'/../model/connectaBD.php';
require_once __DIR__.'/../model/productesDetall.php';

$conn = connectaBD();
$resultat_productes_detall = consultaProducteDetall($conn, $id);

include __DIR__.'/../view/product-detail.php';
?>