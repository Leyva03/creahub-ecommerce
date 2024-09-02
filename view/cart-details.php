
<?php
$totalCompra = 0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/cart-details.css">
    <title>Detalles del Carrito</title>
</head>
<body>
    <div id="productDetail">
        <h1>Detalles del Carrito</h1>

        <?php if (isset($cartDetails) && $cartDetails !== null): ?>
            <?php foreach ($cartDetails as $productDetails): ?>

                <h3><?php echo $productDetails['product']; ?></h3>
                <p>Cantidad: <?php echo $productDetails['quantity']; ?></p>
                <p>Precio por unidad: <?php echo number_format($productDetails['unit_price'], 2, ',', '.').' €'; ?></p>
                <p>Subtotal: <?php echo number_format($productDetails['subtotal'], 2, ',', '.').' €'; ?></p>
                <img src="../img/<?php echo $productDetails['img']; ?>" alt="Error cargando imagen">

                <?php
                $totalCompra += $productDetails['subtotal'];
                ?>

                <form action="../index.php?accio=actualizarCarrito" method="post">
                    <input type="hidden" name="accio" value="eliminarProducto">
                    <input type="hidden" name="productoId" value="<?php echo $productDetails['id']; ?>">
                    <button type="submit">Eliminar</button>
                </form>


                <!-- Formulario para restar la cantidad -->
                <form action="../index.php?accio=actualizarCarrito" method="post">
                    <input type="hidden" name="accio" value="actualizarCantidad">
                    <input type="hidden" name="productoId" value="<?php echo $productDetails['id']; ?>">
                    <input type="hidden" name="operacion" value="restar">
                    <button type="submit">-</button>
                </form>

                <!-- Cantidad actual del producto -->
                <p><?php echo $productDetails['quantity']; ?></p>

                <!-- Formulario para sumar la cantidad -->
                <form action="../index.php?accio=actualizarCarrito" method="post">
                    <input type="hidden" name="accio" value="actualizarCantidad">
                    <input type="hidden" name="productoId" value="<?php echo $productDetails['id']; ?>">
                    <input type="hidden" name="operacion" value="sumar">
                    <button type="submit">+</button>
                </form>

            <?php endforeach; ?>


            <h2>Total de la compra: <?php echo number_format($totalCompra, 2, ',', '.').' €'; ?></h2>


            <form action="../index.php?accio=actualizarCarrito" method="post">
                <input type="hidden" name="accio" value="vaciarCarrito">
                <input type="submit" value="Vaciar Carrito">
            </form>



            <form action="../index.php?accio=actualizarCarrito" method="post">
                <input type="hidden" name="accio" value="confirmarCompra">
                <input type="submit" value="Confirmar Compra">
            </form>

        <?php else: ?>

            <div class="empty-cart-message">
                <p>¡Tu carrito está vacío! ¿Por qué no agregas algunos productos?</p>
                <a href="../index.php?accio=categories">Comprar</a>
            </div>

        <?php endif; ?>

    </div>

</body>
</html>
