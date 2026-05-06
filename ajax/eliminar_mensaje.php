<?php

require "db/db_connection.php";
require "db/comprobar_sesion.php";

if (isset($_POST["id"])) {
    $id = $_POST["id"];
    delete_mensaje($id);
}

header("Location: perfil.php");
exit();

?>