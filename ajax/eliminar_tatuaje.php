<?php

require "db/db_connection.php";
require "db/comprobar_sesion.php";

if (isset($_GET["id"])) {
    $id = $_GET["id"];
    $tatuaje = get_tatuaje($id);
    if ($tatuaje && $tatuaje["id_tatuador"] == $_SESSION["user_id"]) {
        unlink($tatuaje["ruta"]);
        delete_tatuaje($id);
    }
}

header("Location: perfil.php");
exit();

?>