<?php
include __DIR__ . '/../model/usuaris.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['nom'], $_POST['email'], $_POST['password'], $_POST['address'], $_POST['poblacio'], $_POST['cp']) &&
        !empty($_POST['nom']) && !empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['address']) && !empty($_POST['poblacio']) && !empty($_POST['cp'])) {
        registerUser($_POST['nom'], $_POST['email'], $_POST['password'], $_POST['address'], $_POST['poblacio'], $_POST['cp']);
        exit();
    } else {
    }
}

// Validación del lado del servidor
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = $_POST['nom'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $address = $_POST['address'];
    $poblacio = $_POST['poblacio'];
    $cp = $_POST['cp'];

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Por favor introduzca su dirección email siguiendo el formato: tunombre@ejemplo.com";
        exit();
    }

    if (!is_numeric($cp) || floor($cp) != $cp) {
        echo "Por favor introduzca un código postal de 5 dígitos";
        exit();
    }

    // Si todo es válido, procede a registrar el usuario
    registerUser($nom, $email, $password, $address, $poblacio, $cp);
    exit();
}

include __DIR__ . '/../view/registre.php';
?>