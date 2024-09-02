<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="../css/product-list.css">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
</head>
<body>

    <ul class="product-list">
        <?php foreach ($resultat_productes as $producte): ?>
        <li class="product">
            <div class="prod2 productes">
            <a id="<?php echo $producte['id']?>">
                <div id="producte_nom"><h3><?php echo $producte['nom'] ?> </h3></div>
                <h3><?php echo $producte['preu'] ?> </h3>
                <img src="../img/<?php echo $producte['imatge'] ?>" alt="<?php echo $producte['nom'] ?>">
            </a>
            </div>
        </li>
        <?php endforeach; ?>
    </ul>
</div>

<div id="paginaProductosDetall">

</div>


</body>
</html>

<script src="../js/funcions.js"></script>


