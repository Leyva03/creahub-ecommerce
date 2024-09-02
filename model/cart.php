<?php

require_once __DIR__.'/connectaBD.php';
function getCartItems() {
    $userId = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : 'guest';
    return isset($_SESSION['cart'][$userId]) ? $_SESSION['cart'][$userId] : array();
}
function getProductInfoFromDatabase($productId) {
    $conn = connectaBD();

    $productId = pg_escape_string($conn, $productId);

    $query = 'SELECT * FROM "public"."Productos" WHERE "id" = \'' . $productId . '\'';
    $result = pg_query($conn, $query);

    if ($result) {
        $productInfo = pg_fetch_assoc($result);
        return $productInfo;
    } else {
        return false;
    }
}

function confirmarCompra() {
    $userId = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : 'guest';
    $cartItems = getCartItems();

    if (!empty($cartItems)) {
        // Insertar en la tabla 'Comandes'
        $conn = connectaBD();
        $queryComandes = "INSERT INTO \"public\".\"Comandes\" (hora, usuari) VALUES (NOW(), $1) RETURNING id";
        $resultComandes = pg_query_params($conn, $queryComandes, array($userId));

        if ($resultComandes) {
            // Obtener el ID de la comanda recién insertada
            $comandaId = pg_fetch_result($resultComandes, 0);

            // Insertar en la tabla 'Lista Comandas' para cada producto en el carrito
            foreach ($cartItems as $productId => $quantity) {
                $productInfo = getProductInfoFromDatabase($productId);

                if ($productInfo) {
                    $queryListaComandas = "INSERT INTO \"public\".\"Lista Comandas\" (id_comanda, id_producto, cantidad, precio) VALUES ($1, $2, $3, $4)";
                    $resultListaComandas = pg_query_params($conn, $queryListaComandas, array($comandaId, $productId, $quantity, $quantity*$productInfo['preu']));

                    if (!$resultListaComandas) {
                        echo "Error al insertar en Lista Comandas";
                    }
                }
            }
            pg_close($conn);
        } else {
            echo "Error al insertar en Comandes";
        }
    }
}










?>
