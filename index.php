<?php

$accio = $_GET['accio'] ?? NULL;
session_start();
switch($accio) {
    case 'categories':
        include __DIR__.'/controller/category-list.php';
        break;
    case 'productes':
        include __DIR__ . '/controller/product-list.php';
        break;
    case 'detallproducte':
        include __DIR__ . '/controller/product-detail.php';
        break;
    case 'registre':
        include __DIR__ . '/controller/registre.php';
        break;
    case 'login':
        include __DIR__ . '/controller/login.php';
        break;
    case 'logout':
        include __DIR__ . '/controller/logout.php';
        break;
    case 'actualizarCarrito':
        include __DIR__ . '/controller/cart-details.php';
        break;
    case 'edit-profile':
        include __DIR__ . '/controller/edit-profile.php';
        break;
    case 'confirmarCompra':
        include __DIR__ . '/controller/confirmation.php';
        break;
    case 'resumenCarrito':
        include __DIR__. '/controller/cart-summary.php';
        break;
    case 'anadirCarrito':
        include __DIR__. '/controller/addToCart.php';
        break;
    default:
        include __DIR__. '/controller/home.php';
        break;
}
?>