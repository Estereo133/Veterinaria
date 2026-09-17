CREATE DATABASE IF NOT EXISTS veterinaria
  CHARACTER SET utf8mb4
  COLLATE utf8mb4_unicode_ci;

USE veterinaria;

-- ---------- ROLES ----------
CREATE TABLE roles (
  id_rol INT AUTO_INCREMENT PRIMARY KEY,
  nombre VARCHAR(50) NOT NULL UNIQUE,
  descripcion VARCHAR(150)
) ENGINE=InnoDB;

INSERT INTO roles (nombre, descripcion) VALUES
('Administrador','Acceso total'),
('Veterinario','Atención clínica'),
('Recepcionista','Clientes, citas y ventas'),
('Consulta','Solo lectura');

-- ---------- USUARIOS ----------
CREATE TABLE usuarios (
  id_usuario INT AUTO_INCREMENT PRIMARY KEY,
  nombre VARCHAR(100) NOT NULL,
  apellidos VARCHAR(100) NOT NULL,
  correo VARCHAR(120) NOT NULL UNIQUE,
  usuario VARCHAR(50) NOT NULL UNIQUE,
  contrasena VARCHAR(255) NOT NULL,
  id_rol INT NOT NULL,
  estado ENUM('activo','inactivo') DEFAULT 'activo',
  fecha_registro DATETIME DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (id_rol) REFERENCES roles(id_rol)
) ENGINE=InnoDB;

-- Usuario de prueba (contraseña se actualiza con generar_hash.php)
INSERT INTO usuarios (nombre, apellidos, correo, usuario, contrasena, id_rol) VALUES
('Admin','Principal','admin@vet.com','admin', 'PENDIENTE', 1);