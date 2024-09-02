<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/header.css">
    <title>CreaHub</title>
    <script src="../js/jquery.js"></script>
    <script src="../js/menureg.js"></script>
</head>
<body>
<section class="nav2">
    <div class="logo">
        <img src="/img/creahublogo.png" alt="Logo creatine">
    </div>
    <a href="../index.php">
        <div class="company-name">
            <h1>CREAHUB</h1>
            <h2>Supplement house</h2>
        </div>
        <nav>
            <ul>
                <?php if (!isset($_SESSION['user_id'])) { ?>
                    <li><img id="moñeco" src="/img/usericonwhite.png" alt="Icono de usuario">
                        <div id="menureg">
                            <a href="index.php?accio=registre"><p>Regístrate</p></a>
                            <a href="index.php?accio=login"><p>Inicia sesión</p></a>
                        </div>
                    </li>
                <?php }else{ ?>
                    <li><img id="moñeco" src="/img/usericonwhite.png" alt="Icono de usuario">
                        <div id="menureg">
                            <a href="index.php?accio=logout"<p>Cerrar sesión</p></a>
                            <a href="index.php?accio=edit-profile">Mi Perfil</a>
                        </div>
                    </li>
                <?php } ?>
                <li>
                    <a href="index.php?accio=actualizarCarrito"><img id="shopping" src="/img/shopping.png" alt="Icono de compra"></a>
                </li>
                <li><a href="index.php?accio=categories">Categorías</a></li>
            </ul>
        </nav>
</section>

<div class="nav3">
    <nav>
        <span id="cartSummary"></span>
    </nav>
</div>


</body>
</html>

</body>
</html>