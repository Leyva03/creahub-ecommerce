<?php

require_once __DIR__.'/connectaBD.php';

function consultaProducteDetall($conn, $id){
    $sql_productes = 'SELECT * FROM "public"."Productos" WHERE "id" = '. $id;

    $result = pg_query($conn, $sql_productes);

    $producteDetall = pg_fetch_all($result);

    return $producteDetall;
}

?>