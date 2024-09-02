<?php
$conn = connectaBD();
function getCategories($conn)
{
    $sql = 'SELECT * FROM "public"."Categories"';

    $result = pg_query($conn, $sql);

    $categories = pg_fetch_all($result);

    return $categories;
}
?>