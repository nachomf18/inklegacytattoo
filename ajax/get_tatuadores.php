<?php

require "../db/db_connection.php";

$tatuadores = get_tatuadores();

if ($tatuadores) {
    echo json_encode($tatuadores);
} else {
    echo json_encode([]);
}

?>