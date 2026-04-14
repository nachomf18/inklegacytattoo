<?php

require "db/db_connection.php";
require "db/comprobar_sesion.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    delete_tatuaje($id);
}

header("Location: perfil.php");
exit();

?>