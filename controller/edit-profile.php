<?php
include __DIR__ . '/../model/usuaris.php';

// Verificar si el usuario está autenticado
if (!isset($_SESSION['user_id'])) {
    header('Location: index.php?accio=login');
    exit();
}

$user_id = $_SESSION['user_id'];

// Obtener la información del usuario
$user = getUserById($user_id);

// Verificar si se ha enviado el formulario de edición
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Procesar la información del formulario y actualizar la base de datos
    $nom = $_POST['nom'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $poblacio = $_POST['poblacio'];
    $cp = $_POST['cp'];
    $password = $_POST['password'];

    if (isset($_FILES['profile_image']) && !empty($_FILES['profile_image']['name'])) {
        $profileImagePath = processProfileImage($_FILES['profile_image']);
        $profile_image = "/fitxers/".$profileImagePath.".jpg";
    }

    // Actualizar la información del usuario en la base de datos
    updateUser($user_id, $nom, $email, $address, $poblacio, $cp, $password, $profile_image);

    header('Location: index.php?accio=edit-profile');
    exit();
}
include __DIR__ . '/../view/edit-profile.php';
?>
