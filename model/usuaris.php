<?php

include __DIR__ . '/connectaBD.php';

function registerUser($nom, $email, $password, $address, $poblacio, $cp)
{
    $conn = connectaBD();


    if (!$conn) {
        die("Connexió fallida a la base de dades");
    }

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $query = "INSERT INTO users (nom, email, password, address, poblacio, cp) VALUES ($1, $2, $3, $4, $5, $6)";
    $result = pg_query_params($conn, $query, array($nom, $email, $hashed_password, $address, $poblacio, $cp));

    if (!$result) {
        echo "Error en la inserció: " . pg_last_error($conn);
    } else {
        echo "Usuari registrat correctament";
        header('Location: https://tdiw-a5.deic-docencia.uab.cat/index.php?accio=default');
    }

    pg_close($conn);
}

function getUserByEmail($email)
{
    $conn = connectaBD();

    if (!$conn) {
        die("Connexió fallida a la base de dades");
    }

    $query = "SELECT * FROM users WHERE email = $1";
    $result = pg_query_params($conn, $query, array($email));

    if ($result) {
        $user = pg_fetch_assoc($result);
        pg_close($conn);
        return $user;
    } else {
        echo "Error en la consulta: " . pg_last_error($conn);
    }

    pg_close($conn);
    return null;
}

function getUserById($user_id)
{
    $conn = connectaBD();

    if (!$conn) {
        die("Connexió fallida a la base de dades");
    }

    $query = "SELECT * FROM users WHERE id = $1";
    $result = pg_query_params($conn, $query, array($user_id));

    if ($result) {
        $user = pg_fetch_assoc($result);
        pg_close($conn);
        return $user;
    } else {
        echo "Error en la consulta: " . pg_last_error($conn);
    }

    pg_close($conn);
    return null;
}

function updateUser($user_id, $nom, $email, $address, $poblacio, $cp, $password = null, $profile_image = null)
{
    $conn = connectaBD();

    if (!$conn) {
        die("Connexió fallida a la base de dades");
    }

    $query = "UPDATE users SET nom = $1, email = $2, address = $3, poblacio = $4, cp = $5";
    $params = array($nom, $email, $address, $poblacio, $cp);

    if ($password != null) {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $query .= ", password = $6";
        array_push($params, $hashed_password);
        if ($profile_image != null) {
            $query .= ", profile_image = $7";
            array_push($params, $profile_image);
            $prueba = 1;
        }
        if ($prueba != null){
            $query .= " WHERE id = $8";
            array_push($params, $user_id);
        }
        else{
            $query .= " WHERE id = $7";
            array_push($params, $user_id);
        }
    }
    elseif ($profile_image != null) {
        $query .= ", profile_image = $6";
        array_push($params, $profile_image);
        $query .= " WHERE id = $7";
        array_push($params, $user_id);
    }
    else{
        $query .= " WHERE id = $6";
        array_push($params, $user_id);
    }


    $result = pg_query_params($conn, $query, $params);

    if (!$result) {
        echo "Error en la actualización: " . pg_last_error($conn);
    } else {
        echo "Perfil actualizado correctamente";
    }

    pg_close($conn);
}

function processProfileImage($file)
{
    $filesAbsolutePath = '/home/TDIW/tdiw-a5/public_html/fitxers/';
    $profileImageName = 'profile_' . $_SESSION['user_id'] . '_' . time() . '_' . rand(1000, 9999);
    $destinationPath = $filesAbsolutePath . $profileImageName.'.jpg';
    move_uploaded_file($file['tmp_name'], $destinationPath);
    return $profileImageName;
}