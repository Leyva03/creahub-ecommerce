<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="../css/category-list.css">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
</head>
<body>

    <ul class="category-list">
        <?php foreach ($categories as $categoria): ?>
            <li>
                <div class="prod categoria">
                    <a id="<?php echo $categoria['id'] ?>">
                        <div id="categoria_nom"><h3><?php echo $categoria['nom'] ?> </h3></div>
                        <img src="../img/<?php echo $categoria['imatge'] ?>" alt="Logo creatine">
                    </a>
                </div>
            </li>
        <?php endforeach; ?>
    </ul>


<div id="paginaProductos">

</div>

<script src="../js/funcions.js"></script>
</body>
</html>


