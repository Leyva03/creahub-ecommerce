<?php
include __DIR__ . '/../model/usuaris.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $user = getUserByEmail($email);

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        header('Location: https://tdiw-a5.deic-docencia.uab.cat/index.php?accio=default');
        exit();
    } else {
        echo "Credenciales incorrectas";
    }
}

include __DIR__ . '/../view/login.php';
?>
