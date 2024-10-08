DROP DATABASE museu_apelles_fenosa;
CREATE DATABASE museu_apelles_fenosa;
USE museu_apelles_fenosa;

CREATE TABLE exposiciones (
    ID_exposicion INT PRIMARY KEY AUTO_INCREMENT,
    Texto TEXT,
    Fecha_inicio DATE,
    Fecha_fin DATE,
    Tipo TEXT,
    Lugar_ubicacion VARCHAR(255)
);

CREATE TABLE ubicaciones (
    ID_ubicacion INT PRIMARY KEY AUTO_INCREMENT,
    Descripcion TEXT,
    ID_padre INT,
    Fecha_inicio DATE,
    Fecha_fin DATE
);

CREATE TABLE obras (
  Numero_registro VARCHAR(255) PRIMARY KEY,
  Nombre_museo VARCHAR(255) NOT NULL,
  Fotografia VARCHAR(255),
  Clasificacion_generica ENUM('valor1', 'valor2', 'valor3'), -- Adaptar valores
  Nombre_del_objeto VARCHAR(255),
  Coleccion_de_procedencia VARCHAR(255),
  Medidas_maxima_altura_cm INT,
  Medidas_maxima_anchura_cm INT,
  Medidas_maxima_profundidad_cm INT,
  Material VARCHAR(255),
  Tecnica VARCHAR(255),
  Autor VARCHAR(255),
  Titulo VARCHAR(255),
  Año_inicial YEAR,
  Año_final YEAR,
  Datacion VARCHAR(255),
  Ubicacion VARCHAR(255),
  Fecha_inicio_ubicacion DATE,
  Fecha_fin_ubicacion DATE,
  Comentario_ubicacion VARCHAR(255),
  Fecha_de_registro DATE,
  Numero_de_ejemplares INT,
  Forma_de_ingreso VARCHAR(255),
  Fecha_de_ingreso DATE,
  Fuente_de_ingreso VARCHAR(255),
  Estado_de_conservacion ENUM('bueno', 'malo'), -- Adaptar valores
  Lugar_de_ejecucion VARCHAR(255),
  Lugar_de_procedencia VARCHAR(255),
  Num_Tiraje VARCHAR(255),
  Otros_numeros_de_identificacion VARCHAR(255),
  Valoracion_economica DECIMAL(10,2),
  Bibliografia VARCHAR(255),
  Descripcion TEXT, -- Para texto largo, dejamos TEXT
  Historia_del_objeto TEXT, -- Para texto muy largo, dejamos TEXT
  FK_id_exposicion INT,
  FK_id_ubicacion INT,
  FOREIGN KEY (FK_id_exposicion) REFERENCES exposiciones(ID_exposicion),
  FOREIGN KEY (FK_id_ubicacion) REFERENCES ubicaciones (ID_ubicacion)
);

CREATE TABLE restauraciones (
    ID_restauracion INT PRIMARY KEY AUTO_INCREMENT,
    Fecha_inicio DATE,
    Fecha_fin DATE,
    Comentario TEXT,
    Nombre_restaurador VARCHAR(255),
    FK_id_obra varchar(255),
    FOREIGN KEY (FK_id_obra) REFERENCES obras(Numero_registro)
);

CREATE TABLE movimientos (
    ID_movimiento INT PRIMARY KEY AUTO_INCREMENT,
    FK_id_obra varchar(255),
    Museo TEXT,
    Fecha_inicio DATE,
    Fecha_fin DATE,
    Comentario TEXT,
    FOREIGN KEY (FK_id_obra) REFERENCES obras(Numero_registro)
);

CREATE TABLE usuarios (
    ID_usuario INT PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(255) NOT NULL,
    contrasenya VARCHAR(255) NOT NULL,
    Telefono VARCHAR(255),
    Rol ENUM('convidat', 'tecnic', 'administracio') NOT NULL
);

CREATE TABLE logs (
    ID_log INT PRIMARY KEY AUTO_INCREMENT,
    Baja TEXT,
    Causa_baja TEXT,
    Fecha_baja DATE,
    Persona_baja TEXT,
    FK_id_obra varchar(255),
    FK_id_usuario INT,
    FOREIGN KEY (FK_id_obra) REFERENCES obras(Numero_registro),
    FOREIGN KEY (FK_id_usuario) REFERENCES usuarios(ID_usuario)
);