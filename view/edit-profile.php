<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/register.css">
    <title>Editar Perfil</title>
    <script>
        function validarFormulario() {
            var nom = document.getElementById('nom').value;
            var email = document.getElementById('e').value;
            var password = document.getElementById('p').value;
            var address = document.getElementById('a').value;
            var poblacio = document.getElementById('po').value;
            var cp = document.getElementById('cp').value;

            if (nom.trim() === '' || email.trim() === '' || password.trim() === '' || address.trim() === '' || poblacio.trim() === '' || cp.trim() === '') {
                alert('Por favor rellene todos los campos');
                return false;
            }

            var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(email)) {
                alert('Por favor introduzca su dirección email siguiendo el formato: tunombre@ejemplo.com');
                return false;
            }

            if (address.length > 30) {
                alert('Porfavor introduzca su dirección usando menos de 30 caracteres');
                return false;
            }

            if (poblacio.length > 30) {
                alert('Porfavor introduzca su población usando menos de 30 caracteres');
                return false;
            }

            var cpRegex = /^\d{5}$/;
            if (cp.length !== 5 || !cpRegex.test(cp)) {
                alert('Porfavor introduzca un código postal de 5 dígitos');
                return false;
            }

            return true;
        }
    </script>
</head>
<body>
<header>
    <a href="index.php?accio=default"><img src="/img/creahublogo.png" alt="Nombre de la marca"></a>
</header>
<div class="tituloregistro">
    <h1>Editar Perfil</h1>
</div>
<div class="fotoperfil">
    <img src="<?php echo !empty($user['profile_image']) ? $user['profile_image'] : '/img/blank_profile.jpg'; ?>" alt="Foto de perfil">
</div>
<form method="post" action="index.php?accio=edit-profile" onsubmit="validarFormulario()" enctype="multipart/form-data">
    Nombre completo: <input type="text" name="nom" id="nom" value="<?php echo htmlspecialchars($user['nom']); ?>" required>
    Dirección de correo electrónico: <input type="email" id="e" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>
    Dirección: <input type="text" name="address" id="a" value="<?php echo htmlspecialchars($user['address']); ?>" required>
    Población: <input type="text" name="poblacio" id="po" value="<?php echo htmlspecialchars($user['poblacio']); ?>" required>
    Código postal: <input type="text" name="cp" id="cp"  value="<?php echo htmlspecialchars($user['cp']); ?>" required>
    Nueva Contraseña: <input type="password" name="p" placeholder="Dejar en blanco para no cambiar">
    Foto de Perfil: <input type="file" name="profile_image">
    <input type="submit" value="Guardar Cambios">
</form>
<footer>
</footer>
</body>
</html>