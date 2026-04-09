CREATE DATABASE IF NOT EXISTS "inklegacy";
USE "inklegacy";

CREATE TABLE tatuadores (
    id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(255) NOT NULL,
    clave VARCHAR(255) NOT NULL,
    nombre VARCHAR(255) NOT NULL,
    descripcion VARCHAR(255) NOT NULL,
    instagram VARCHAR(255) NOT NULL,
    imagen VARCHAR(255) NOT NULL
);

CREATE TABLE tatuajes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    ruta VARCHAR(255) NOT NULL,
    id_tatuador INT NOT NULL,
    FOREIGN KEY (id_tatuador) REFERENCES tatuadores(id)
);

CREATE TABLE mensajes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    asunto VARCHAR(255) NOT NULL,
    mensaje TEXT NOT NULL,
    id_tatuador INT NOT NULL,
    FOREIGN KEY (id_tatuador) REFERENCES tatuadores(id)
);

CREATE TABLE citas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    telefono VARCHAR(255) NOT NULL,
    fecha DATETIME NOT NULL,
    id_tatuador INT NOT NULL,
    FOREIGN KEY (id_tatuador) REFERENCES tatuadores(id)
);