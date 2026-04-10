<?php

session_start();

?>

<header>
    <nav>
        <a href="index.php"><img src="./assets/img/logo.png" alt="Ink Legacy Tattoo Studio - Logotipo oficial del estudio de tatuajes" height="90"></a>
        <ul>
            <li><a href="index.php">INICIO</a></li>
            <li><a href="sobrenosotros.php">SOBRE NOSOTROS</a></li>
            <li><a href="artistas.php">ARTISTAS</a></li>
            <li><a href="contacto.php">CONTACTO</a></li>
            <?php if (!isset($_SESSION['user_id'])) { ?>
                <li><a href="login.php">INICIAR SESIÓN</a></li>
            <?php } ?>
            <?php if (isset($_SESSION['user_id'])) { ?>
                <li><a href="logout.php">CERRAR SESIÓN</a></li>
            <?php } ?>

        </ul>
        <img src="./assets/img/menu.svg" alt="Abrir menú de navegación" id="menu-icon" height="40">
    </nav>
</header>