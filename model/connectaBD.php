<?php

    function connectaBD() {
        $conn = pg_connect("host='hostname' dbname='yourdbname' user='youruser' password='yourpsswd");
        return $conn;
    }
?>
