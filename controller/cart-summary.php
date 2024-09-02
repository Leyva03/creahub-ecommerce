<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__.'/../model/cart.php';

$cartSummary = getCartSummary();

// Verificar si hay algo en el carrito antes de imprimir el resumen
if ($cartSummary['totalProducts'] > 0) {
    echo "Productos en el carrito: " . $cartSummary['totalProducts'] . ", Importe total: " . number_format($cartSummary['totalAmount'], 2);
    echo '<br><a href="../index.php?accio=actualizarCarrito"><button>Ver Resumen Detallado</button></a>';
}

function getCartSummary() {
    $userId = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : 'guest';
    $totalProducts = 0;
    $totalAmount = 0;

    if (isset($_SESSION['cart'][$userId])) {
        foreach ($_SESSION['cart'][$userId] as $productId => $quantity) {
            $productInfo = getProductInfoFromDatabase($productId);

            if ($productInfo) {
                $unitPrice = floatval(str_replace(',', '.', $productInfo['preu']));
                $totalProducts += $quantity;
                $totalAmount += $quantity * $unitPrice;
            }
        }
    }

    return array('totalProducts' => $totalProducts, 'totalAmount' => $totalAmount);
}
?>
