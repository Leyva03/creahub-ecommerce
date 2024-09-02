<?php
if (isset($_SESSION['user_id'])){
    unset($_SESSION['user_id']);
}
header("Location: https://tdiw-a5.deic-docencia.uab.cat/index.php?accio=default");
exit;