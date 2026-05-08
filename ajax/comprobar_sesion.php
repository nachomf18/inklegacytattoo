<?php

session_start();

if (isset($_SESSION["id_tatuador"])) {
    echo $_SESSION["id_tatuador"];
} else {
    echo -1;
}

