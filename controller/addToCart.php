<?php
require_once __DIR__.'/../model/cart.php';

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $productId = $_POST['productId'];
    $quantity = $_POST['quantity'];

    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = array();
    }

    $userId = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : 'guest';

    if (!isset($_SESSION['cart'][$userId])) {
        $_SESSION['cart'][$userId] = array();
    }

    $_SESSION['cart'][$userId][$productId] = isset($_SESSION['cart'][$userId][$productId])
        ? $_SESSION['cart'][$userId][$productId] + $quantity
        : $quantity;

    if ($_SESSION['cart'][$userId][$productId] > 0) {
        echo "Producto agregado al carrito correctamente. Cantidad: " . $quantity;
    } else {
        echo "Error al agregar el producto al carrito.";
    }
}
?>
