DROP DATABASE crm_itplusnet;

CREATE DATABASE crm_itplusnet;

USE crm_itplusnet;

CREATE TABLE dificultades_soporte (
  id CHAR(36) NOT NULL PRIMARY KEY,
  nombre varchar(20) NOT NULL,
  descripcion varchar(255),
  uf float
);

CREATE TABLE estados_soporte (
  id CHAR(36) NOT NULL PRIMARY KEY,
  nombre VARCHAR(255) NOT NULL,
  descripcion VARCHAR(255),
  orden INT NOT NULL
);

CREATE TABLE estados_cobranza (
  id CHAR(36) NOT NULL PRIMARY KEY,
  nombre VARCHAR(255) NOT NULL,
  descripcion VARCHAR(255) 
);

CREATE TABLE tipos_soporte (
  id CHAR(36) NOT NULL PRIMARY KEY,
  nombre  VARCHAR(255) NOT NULL,
  descripcion VARCHAR(255)
);

CREATE TABLE regiones (
  id CHAR(36) NOT NULL PRIMARY KEY,
  nombre VARCHAR(100) NOT NULL
);

CREATE TABLE comunas (
  id CHAR(36) NOT NULL PRIMARY KEY,
  nombre VARCHAR(100) NOT NULL,
  region_id CHAR(36),
  FOREIGN KEY (region_id) REFERENCES regiones(id)
);

CREATE TABLE direcciones (
  id CHAR(36) NOT NULL PRIMARY KEY,
  calle VARCHAR(255) NOT NULL,
  numero VARCHAR(20) NOT NULL,
  comuna_id CHAR(36) NOT NULL,
  FOREIGN KEY (comuna_id) REFERENCES comunas(id)
);

CREATE TABLE empresas (
  id CHAR(36) NOT NULL PRIMARY KEY,
  rut VARCHAR(12) NOT NULL,
  nombre VARCHAR(50) NOT NULL,
  razon_social VARCHAR(150) NOT NULL,
  direccion_id CHAR(36) NOT NULL,
  FOREIGN KEY (direccion_id) REFERENCES direcciones(id),
  color VARCHAR(20) NOT NULL,
  ruta_logo VARCHAR(255) NOT NULL,
  activa BOOLEAN
);

CREATE TABLE sucursales (
  id CHAR(36) NOT NULL PRIMARY KEY,
  nombre VARCHAR(100) NOT NULL,
  activa BOOLEAN,
  direccion_id CHAR(36),
  empresa_id char(36),
  FOREIGN KEY (direccion_id) REFERENCES direcciones(id),
  FOREIGN KEY (empresa_id) REFERENCES empresas(id)
);

CREATE TABLE bodegas (
  id CHAR(36) NOT NULL PRIMARY KEY,
  nombre VARCHAR(100) NOT NULL,
  activa BOOLEAN,
  sucursal_id CHAR(36),
  email	VARCHAR(255) NOT NULL, 
  FOREIGN KEY (sucursal_id) REFERENCES sucursales(id)
);

CREATE TABLE cajas (
  id CHAR(36) NOT NULL PRIMARY KEY,
  nombre VARCHAR(100) NOT NULL,
  activa BOOLEAN,
  sucursal_id CHAR(36),
  FOREIGN KEY (sucursal_id) REFERENCES sucursales(id)
);
-- Crear la tabla usuarios
CREATE TABLE usuarios (
    id CHAR(36) NOT NULL PRIMARY KEY,
    rut VARCHAR(12) NOT NULL,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    email_verified_at TIMESTAMP NULL,
    password VARCHAR(255) NOT NULL,
    remember_token VARCHAR(100) NULL,
    telefono VARCHAR(15) NULL,
    direccion_id CHAR(36) NULL,
    empresa_id CHAR(36) NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    activo BOOLEAN DEFAULT TRUE,
    sucursal_id char(36) NOT NULL,
    bodega_id char(36) NOT NULL,
    caja_id char(36) NOT NULL,
    FOREIGN KEY (sucursal_id) REFERENCES sucursales(id),
    FOREIGN KEY (bodega_id) REFERENCES bodegas(id),
    FOREIGN KEY (caja_id) REFERENCES cajas(id),
    FOREIGN KEY (direccion_id) REFERENCES direcciones(id),
    FOREIGN KEY (empresa_id) REFERENCES empresas(id)
);

-- Crear la tabla password_reset_tokens
CREATE TABLE password_reset_tokens (
    email VARCHAR(255) NOT NULL PRIMARY KEY,
    token VARCHAR(255) NOT NULL,
    created_at TIMESTAMP NULL
);

-- Crear la tabla sessions
CREATE TABLE sessions (
    id VARCHAR(255) NOT NULL PRIMARY KEY,
    user_id CHAR(36) NULL,
    ip_address VARCHAR(45) NULL,
    user_agent TEXT NULL,
    payload LONGTEXT NOT NULL,
    last_activity INT NOT NULL,
    INDEX (user_id),
    INDEX (last_activity),
    FOREIGN KEY (user_id) REFERENCES usuarios(id) ON DELETE SET NULL
);

CREATE TABLE soportes (
  id CHAR(36) NOT NULL PRIMARY KEY,
  numero_soporte INT NOT NULL AUTO_INCREMENT UNIQUE,
  horas_hombre float,
  uf float,
  descripcion VARCHAR(4000) NOT NULL,
  solucion VARCHAR(4000),
  celular varchar(12) NOT NULL,
  email varchar(45) NOT NULL,
  urgente BOOLEAN NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  fecha_estimada_entrega DATE,
  bodega_id CHAR(36) NOT NULL,
  sucursal_id CHAR(36) NOT NULL,
  caja_id CHAR(36) NOT NULL,
  dificultad_soporte_id CHAR(36),
  estado_soporte_id CHAR(36) NOT NULL,
  tipo_soporte_id CHAR(36),
  estado_cobranza_id CHAR(36),
  FOREIGN KEY (sucursal_id) REFERENCES sucursales(id),
  FOREIGN KEY (bodega_id) REFERENCES bodegas(id),
  FOREIGN KEY (caja_id) REFERENCES cajas(id),
  FOREIGN KEY (dificultad_soporte_id) REFERENCES dificultades_soporte(id),
  FOREIGN KEY (estado_soporte_id) REFERENCES estados_soporte(id),
  FOREIGN KEY (tipo_soporte_id) REFERENCES tipos_soporte(id),
  FOREIGN KEY (estado_cobranza_id) REFERENCES estados_cobranza(id)
);

CREATE TABLE soporte_imagenes (
  id CHAR(36) NOT NULL PRIMARY KEY,
  soporte_id CHAR(36) NOT NULL,
  ruta VARCHAR(255) NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (soporte_id) REFERENCES soportes(id) ON DELETE CASCADE
);


CREATE TABLE jerarquia_soportes (
  id CHAR(36) NOT NULL PRIMARY KEY,
  soporte_padre_id CHAR(36) NOT NULL,
  soporte_hijo_id CHAR(36) NOT NULL,
  FOREIGN KEY (soporte_padre_id) REFERENCES soportes(id) ON DELETE CASCADE,
  FOREIGN KEY (soporte_hijo_id) REFERENCES soportes(id) ON DELETE CASCADE
);

CREATE TABLE historiales_estado (
  id CHAR(36) NOT NULL PRIMARY KEY,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  comentario VARCHAR(255),
  soporte_id CHAR(36) NOT NULL,
  estado_soporte_id CHAR(36) NOT NULL,
  usuario_id CHAR(36) NOT NULL,
  FOREIGN KEY (soporte_id) REFERENCES soportes(id) ON DELETE CASCADE,
  FOREIGN KEY (estado_soporte_id) REFERENCES estados_soporte(id),
  FOREIGN KEY (usuario_id) REFERENCES usuarios(id)
);

CREATE TABLE notas (
  id CHAR(36) NOT NULL PRIMARY KEY,
  usuario_id CHAR(36) NOT NULL,
  soporte_id CHAR(36) NOT NULL,
  FOREIGN KEY(soporte_id) REFERENCES soportes(id) ON DELETE CASCADE,
  FOREIGN KEY(usuario_id) REFERENCES usuarios(id) ON DELETE CASCADE,
  nota varchar(255) NOT NULL,
  fecha_de_creacion TIMESTAMP NOT NULL
);

-- Crear la tabla conversations
CREATE TABLE conversations (
    id CHAR(36) NOT NULL PRIMARY KEY,
    soporte_id CHAR(36) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (soporte_id) REFERENCES soportes(id) ON DELETE CASCADE
);

-- Crear la tabla messages
CREATE TABLE messages (
    id CHAR(36) NOT NULL PRIMARY KEY,
    conversation_id CHAR(36) NOT NULL,
    role ENUM('user', 'assistant', 'system') NOT NULL,
    content TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (conversation_id) REFERENCES conversations(id) ON DELETE CASCADE
);