DROP DATABASE biblioteca;
CREATE DATABASE IF NOT EXISTS biblioteca;
SET NAMES utf8mb4;
USE biblioteca;

DROP TABLE IF EXISTS penalizaciones;
DROP TABLE IF EXISTS prestamos;
DROP TABLE IF EXISTS ejemplares;
DROP TABLE IF EXISTS libros_autores;
DROP TABLE IF EXISTS autores;
DROP TABLE IF EXISTS libros;
DROP TABLE IF EXISTS usuarios;

-- Tabla de usuarios
CREATE TABLE usuarios (
    id_usuario INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50) NOT NULL,
    apellido1 VARCHAR(50) NOT NULL,
    apellido2 VARCHAR(50),
    direccion VARCHAR(100),
    email VARCHAR(100) UNIQUE NOT NULL,
    telefono VARCHAR(20),
    dni VARCHAR(20) UNIQUE,
    clave VARCHAR(255) NOT NULL,
    rol ENUM('lector', 'bibliotecario', 'administrador') NOT NULL,
    dni_confirmado BOOLEAN DEFAULT FALSE,
    fecha_registro DATETIME DEFAULT CURRENT_TIMESTAMP
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_bin;

-- Tabla de libros
CREATE TABLE libros (
    id_libro INT AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(100) NOT NULL,
    isbn VARCHAR(20) UNIQUE NOT NULL,
    editorial VARCHAR(50),
    fecha_publicacion DATE
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_bin;

-- Tabla de autores
CREATE TABLE autores (
    id_autor INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50) NOT NULL,
    apellido VARCHAR(50) NOT NULL
);

-- Tabla de relación libros-autores
CREATE TABLE libros_autores (
    id_libro INT,
    id_autor INT,
    PRIMARY KEY (id_libro, id_autor),
    FOREIGN KEY (id_libro) REFERENCES libros (id_libro),
    FOREIGN KEY (id_autor) REFERENCES autores (id_autor)
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_bin;

-- Tabla de ejemplares
CREATE TABLE ejemplares (
    id_ejemplar INT AUTO_INCREMENT PRIMARY KEY,
    id_libro INT,
    codigo VARCHAR(50) UNIQUE NOT NULL,
    estado VARCHAR(50),
    FOREIGN KEY (id_libro) REFERENCES libros (id_libro)
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_bin;

-- Tabla de préstamos
CREATE TABLE prestamos (
    id_prestamo INT AUTO_INCREMENT PRIMARY KEY,
    id_usuario INT,
    id_ejemplar INT,
    fecha_prestamo DATE NOT NULL,
    fecha_devolucion_esperada DATE NOT NULL,
    fecha_devolucion_real DATE,
    estado_prestamo ENUM('activo', 'devuelto', 'retrasado') NOT NULL,
    FOREIGN KEY (id_usuario) REFERENCES usuarios (id_usuario),
    FOREIGN KEY (id_ejemplar) REFERENCES ejemplares (id_ejemplar)
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_bin;

-- Tabla de penalizaciones
CREATE TABLE penalizaciones (
    id_penalizacion INT AUTO_INCREMENT PRIMARY KEY,
    id_usuario INT,
    tipo_penalizacion ENUM('no_devuelto', 'retraso') NOT NULL,
    fecha_inicio DATE NOT NULL,
    fecha_fin DATE,
    FOREIGN KEY (id_usuario) REFERENCES usuarios (id_usuario)
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_bin;

-- Inserción del usuario administrador
INSERT INTO usuarios (
    nombre, apellido1, apellido2, direccion, email, telefono, dni, clave, rol
)
VALUES (
    'Juan',
    'Pérez',
    'Gómez',
    'Calle Uno 23',
    'juan@example.com',
    '612345678',
    '12345678A',
    -- clave 123456789
    '$2y$10$LSGw53om0xsx9bCWio7x3.pJ6XjgXgE9L1VJHW2AYTWeqCWUA7WoW',
    'administrador'
);
