<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="../css/product-detail.css">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
</head>
<body>
<?php foreach ($resultat_productes_detall as $producte_detall): ?>
    <h3><?php echo $producte_detall['nom'] ?></h3>
    <h3><?php echo $producte_detall['descripcio'] ?></h3>
    <h3><?php echo $producte_detall['preu'] ?> </h3>
    <img src="../img/<?php echo $producte_detall['imatge'] ?>" alt="<?php   echo $producte_detall['nom'] ?>">

    <form id="addToCartForm">
        <input type="hidden" id="productId" value="<?php echo $producte_detall['id']; ?>">
        <label for="quantity">Cantidad:</label>
        <input type="number" id="quantity" name="quantity" value="1" min="1">
        <button type="button" id="addToCartBtn">Añadir al carrito</button>
    </form>
<?php endforeach; ?>

<script src="../js/funcions.js"></script>
<script src="../js/jquery.js"></script>
</body>
</html>
