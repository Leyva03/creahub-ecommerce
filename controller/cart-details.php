<?php
require_once __DIR__.'/../model/cart.php';

if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
    include __DIR__.'/../view/cart-details.php';
    exit();
}

// Obtener los detalles del carrito
$cartDetails = getCartDetails();

$mensaje = '';

$conn = connectaBD();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (isset($_POST['accio']) && $_POST['accio'] === 'confirmarCompra') {

        if (!isset($_SESSION['user_id'])) {
            $emptyCartMessage = 'No puedes comprar porque no has iniciado sesión';
            $loginLink = '../index.php?accio=login';
            include __DIR__.'/../view/empty-cart-message.php';
            exit();
        }

        // Llama a la función para confirmar la compra en el modelo
        confirmarCompra();

        vaciarCarrito();

        // Redirige a la página de confirmación
        header('Location: ../index.php?accio=confirmarCompra');



        exit();
    }

    // Verifica si se ha enviado la acción para vaciar el carrito
    if (isset($_POST['accio']) && $_POST['accio'] === 'vaciarCarrito') {
        // Llama a una función para vaciar el carrito
        vaciarCarrito();
        header('Location: ../index.php?accio=actualizarCarrito');
        exit();
    }

    // Verifica si se ha enviado la acción para eliminar un producto
    if (isset($_POST['accio']) && $_POST['accio'] === 'eliminarProducto') {
        if (isset($_POST['productoId'])) {
            $userId = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : 'guest';
            $productId = $_POST['productoId'];

            unset($_SESSION['cart'][$userId][$productId]);

            // Si no hay más productos para el usuario, elimina la entrada del usuario del carrito
            if (empty($_SESSION['cart'][$userId])) {
                unset($_SESSION['cart'][$userId]);
            }
            header('Location: ../index.php?accio=actualizarCarrito');
            exit();
        }
    }

    // Verifica si se ha enviado la acción para actualizar la cantidad de un producto
    if (isset($_POST['accio']) && $_POST['accio'] === 'actualizarCantidad') {
        if (isset($_POST['productoId'], $_POST['operacion'])) {
            $productoId = $_POST['productoId'];
            $operacion = $_POST['operacion'];

            foreach ($_SESSION['cart'] as $userId => $productos) {
                if (isset($productos[$productoId])) {
                    if ($operacion === 'restar') {
                        $_SESSION['cart'][$userId][$productoId] -= 1;
                    } elseif ($operacion === 'sumar') {
                        $_SESSION['cart'][$userId][$productoId] += 1;
                    }

                    // Verifica si la cantidad llega a cero y elimina el producto en ese caso
                    if ($_SESSION['cart'][$userId][$productoId] <= 0) {
                        unset($_SESSION['cart'][$userId][$productoId]);

                        // Si no hay más productos para el usuario, elimina la entrada del usuario del carrito
                        if (empty($_SESSION['cart'][$userId])) {
                            unset($_SESSION['cart'][$userId]);
                        }

                        $mensaje = 'El producto se ha eliminado del carrito.';
                    } else {
                        $mensaje = 'La cantidad del producto se ha actualizado en el carrito.';
                    }
                    header('Location: ../index.php?accio=actualizarCarrito');
                    exit();
                }
            }
        }
    }
}

function vaciarCarrito() {
    if (isset($_SESSION['cart'])) {
        unset($_SESSION['cart']);
    }
}

function getCartDetails() {
    $userId = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : 'guest';

    if (!isset($_SESSION['cart'][$userId])) {
        return null;
    }

    $cartDetails = array();

    foreach ($_SESSION['cart'][$userId] as $productId => $quantity) {
        $productInfo = getProductInfoFromDatabase($productId);

        if ($productInfo) {
            $quantity = is_numeric($quantity) ? $quantity : 0;
            $unitPrice = str_replace(',', '.', $productInfo['preu']);
            $unitPrice = floatval($unitPrice);

            $productDetails = array(
                'product' => $productInfo['descripcio'],
                'quantity' => $quantity,
                'unit_price' => $unitPrice,
                'subtotal' => $quantity * $unitPrice,
                'img' => $productInfo['imatge'],
            );

            $productDetails['id'] = $productId;
            $cartDetails[] = $productDetails;
        }
    }

    return $cartDetails;
}

include __DIR__.'/../view/header.php';
include __DIR__.'/../view/cart-details.php';
?>
