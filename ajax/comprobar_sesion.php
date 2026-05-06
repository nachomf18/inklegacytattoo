<?php

session_start();

if (isset($_SESSION["usuario"])) {
    echo "TRUE";
} else {
    echo "FALSE";
}
