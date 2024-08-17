CREATE DATABASE crm_itplusnet;

USE crm_itplusnet;

CREATE TABLE dificultad_soporte (
  id CHAR(36) NOT NULL PRIMARY KEY,
  nombre varchar(20) NOT NULL,
  descripcion varchar(255) NULL,
  uf float NOT NULL
);

CREATE TABLE estado_soporte (
  id CHAR(36) NOT NULL PRIMARY KEY,
  nombre VARCHAR(255) NOT NULL,
  descripcion VARCHAR(255) NOT NULL
);

CREATE TABLE tipo_soporte (
  id CHAR(36) NOT NULL PRIMARY KEY,
  nombre  VARCHAR(255) NOT NULL,
  descripcion VARCHAR(255) NOT NULL
);

CREATE TABLE region(
  id CHAR(36) NOT NULL PRIMARY KEY,
  nombre VARCHAR(100) NOT NULL
);

CREATE TABLE comuna(
  id CHAR(36) NOT NULL PRIMARY KEY,
  nombre VARCHAR(100) NOT NULL,
  region_id CHAR(36),
  FOREIGN KEY (region_id) REFERENCES region(id)
);

CREATE TABLE direccion(
  id CHAR(36) NOT NULL PRIMARY KEY,
  calle VARCHAR(255) NOT NULL,
  numero VARCHAR(20) NOT NULL,
  comuna_id CHAR(36) NOT NULL,
  FOREIGN KEY (comuna_id) REFERENCES comuna(id)
);

CREATE TABLE sucursal(
  id CHAR(36) NOT NULL PRIMARY KEY,
  nombre VARCHAR(100) NOT NULL,
  activa BOOLEAN,
  direccion_id CHAR(36),
  FOREIGN KEY (direccion_id) REFERENCES direccion(id)
);

CREATE TABLE bodega(
  id CHAR(36) NOT NULL PRIMARY KEY,
  nombre VARCHAR(100) NOT NULL,
  activa BOOLEAN,
  sucursal_id CHAR(36),
  FOREIGN KEY (sucursal_id) REFERENCES sucursal(id)
);

CREATE TABLE empresa(
  id CHAR(36) NOT NULL PRIMARY KEY,
  rut VARCHAR(12) NOT NULL,
  nombre VARCHAR(50) NOT NULL,
  razon_social VARCHAR(150) NOT NULL,
  direccion_id CHAR(36) NOT NULL,
  FOREIGN KEY (direccion_id) REFERENCES direccion(id),
  color VARCHAR(20) NOT NULL,
  ruta_logo VARCHAR(255) NOT NULL,
  activa BOOLEAN
);

CREATE TABLE usuario(
  id CHAR(36) NOT NULL PRIMARY KEY,
  rut VARCHAR(12) NOT NULL, 
  hashed_password VARCHAR(255) NOT NULL,
  nombre VARCHAR(255) NOT NULL,
  correo VARCHAR(255) NOT NULL UNIQUE,
  telefono VARCHAR(15),
  direccion_id CHAR(36),
  empresa_id CHAR(36),
  FOREIGN KEY (empresa_id) REFERENCES empresa(id),
  FOREIGN KEY (direccion_id) REFERENCES direccion(id),
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  activo BOOLEAN
);

CREATE TABLE soporte(  
  id CHAR(36) NOT NULL PRIMARY KEY,
  horas_hombre float,
  uf float,
  descripcion VARCHAR(4000),
  solucion VARCHAR(4000),
  celular varchar(12),
  email varchar(45),
  caja int,
  urgente BOOLEAN,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  bodega_id CHAR(36) NOT NULL,
  dificultad_soporte_id CHAR(36) NOT NULL,
  estado_soporte_id CHAR(36) NOT NULL,
  tipo_soporte_id CHAR(36) NOT NULL,
  FOREIGN KEY (bodega_id) REFERENCES bodega(id),
  FOREIGN KEY (dificultad_soporte_id) REFERENCES dificultad_soporte(id),
  FOREIGN KEY (estado_soporte_id) REFERENCES estado_soporte(id),
  FOREIGN KEY (tipo_soporte_id) REFERENCES tipo_soporte(id)
);

CREATE TABLE historial_estado (
  id CHAR(36) NOT NULL PRIMARY KEY,
  created_at TIMESTAMP NOT NULL,
  comentario VARCHAR(255) NULL,
  soporte_id CHAR(36) NOT NULL,
  estado_soporte_id CHAR(36) NOT NULL,
  usuario_id CHAR(36) NOT NULL,
  FOREIGN KEY (soporte_id) REFERENCES soporte(id) ON DELETE CASCADE,
  FOREIGN KEY (estado_soporte_id) REFERENCES estado_soporte(id),
  FOREIGN KEY (usuario_id) REFERENCES usuario(id)
);

CREATE TABLE notas(
  id CHAR(36) NOT NULL PRIMARY KEY,
  usuario_id CHAR(36) NOT NULL,
  soporte_id CHAR(36) NOT NULL,
  FOREIGN KEY(soporte_id) REFERENCES soporte(id) ON DELETE CASCADE,
  FOREIGN KEY(usuario_id) REFERENCES usuario(id) ON DELETE CASCADE,
  nota varchar(255) NOT NULL,
  fecha_de_creacion TIMESTAMP NOT NULL
);