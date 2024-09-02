<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/register.css">
    <title>Login</title>
</head>
<body>
<header>
    <a href="index.php?accio=default"><img src="/img/creahublogo.png" alt="Nombre de la marca"></a>
</header>
<div class="tituloregistro">
    <h1>Inicia sesión</h1>
</div>
<form method="post" action="index.php?accio=login">
    Dirección de correo electrónico: <input type="email" name="email" required/><br/>
    Contraseña: <input type="password" name="password" required/><br/>
    <input type="submit" value="Iniciar sesión"/>
</form>
<div class="sincuenta">
    <p>No tienes una cuenta?</p>
    <a href="index.php?accio=registre">Regístrate aquí</a>
</div>
</body>
</html>
