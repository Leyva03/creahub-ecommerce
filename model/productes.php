<?php

require_once __DIR__.'/connectaBD.php';

function consultaProducte($conn, $id){
    $sql_productes = 'SELECT * FROM "public"."Productos" WHERE "categoria" = '. $id;

    $result = pg_query($conn, $sql_productes);

    $productes = pg_fetch_all($result);

    return $productes;
}

?>
