<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/register.css">
    <title>Registration</title>
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
                alert('Por favor introduzca su dirección usando menos de 30 caracteres');
                return false;
            }

            if (poblacio.length > 30) {
                alert('Por favor introduzca su población usando menos de 30 caracteres');
                return false;
            }

            var cpRegex = /^\d{5}$/;
            if (cp.length !== 5 || !cpRegex.test(cp)) {
                alert('Por favor introduzca un código postal de 5 dígitos');
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
    <h1>Regístrate</h1>
</div>
<form method="post" action="index.php?accio=registre" onsubmit="return validarFormulario()">
    Nombre completo: <input type="text" name="nom" id="nom" required/><br/> <!--pattern="[A-Za-zÀ-ÿ ]+" no es necesario-->
    Dirección de correo electrónico: <input type="email" name="email" id="e" required/><br/> <!--pattern="[A-Za-z0-9]+" o "^[a-zA-Z0-9]+$"para campo alfanumerico-->
    Contraseña: <input type="password" name="password" id="p" required/><br/>
    Dirección: <input type="text" name="address" id="a" maxlength="30" required><br/>
    Población: <input type="text" name="poblacio" id="po" maxlength="30" required><br/>
    Código postal: <input type="number" name="cp" id="cp" maxlength="5" pattern="^\d{5}$" required><br/> <!--maxlenght no necesario en number-->
    <input type="submit" value="Registrar"/>
</form>
</body>
</html>