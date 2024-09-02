<?php

    function connectaBD() {
        $conn = pg_connect("host='127.0.0.1' dbname='tdiw-a5' user='tdiw-a5' password='WbEAbAyw'");
        return $conn;
    }
?>