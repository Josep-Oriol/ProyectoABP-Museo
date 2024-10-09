DROP DATABASE museu_apelles_fenosa;
CREATE DATABASE museu_apelles_fenosa;
USE museu_apelles_fenosa;

CREATE TABLE ubicaciones (
    ID_ubicacion INT PRIMARY KEY AUTO_INCREMENT,
    Descripcion TEXT,
    ID_padre INT,
    Fecha_inicio DATE,
    Fecha_fin DATE
);

CREATE TABLE exposiciones (
    ID_exposicion INT PRIMARY KEY AUTO_INCREMENT,
    Texto TEXT,
    Fecha_inicio DATE,
    Fecha_fin DATE,
    Tipo TEXT,
    Lugar_ubicacion VARCHAR(255)
);

CREATE TABLE obras (
  Numero_registro VARCHAR(255) PRIMARY KEY,
  Nombre_museo VARCHAR(255) NOT NULL,
  Fotografia VARCHAR(255),
  Clasificacion_generica ENUM('valor1', 'valor2', 'valor3'), -- Adaptar valores
  Nombre_del_objeto VARCHAR(255),
  Coleccion_de_procedencia VARCHAR(255),
  Medidas_maxima_altura_cm FLOAT,
  Medidas_maxima_anchura_cm FLOAT,
  Medidas_maxima_profundidad_cm FLOAT,
  Material VARCHAR(255),
  Tecnica VARCHAR(255),
  Autor VARCHAR(255),
  Titulo VARCHAR(255),
  Año_inicial YEAR,
  Año_final YEAR,
  Datacion DATE,
  FK_id_ubicacion INT,
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
  FOREIGN KEY (FK_id_ubicacion) REFERENCES ubicaciones (ID_ubicacion),
  FOREIGN KEY (FK_id_exposicion) REFERENCES exposiciones(ID_exposicion)
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
    Nombre VARCHAR(255) NOT NULL,
    Apellidos VARCHAR(255),
    Contrasenya VARCHAR(255) NOT NULL,
    Telefono VARCHAR(255),
    Rol ENUM('lector', 'tecnic', 'administracio') NOT NULL
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


INSERT INTO usuarios (Nombre, Contrasenya, Telefono, Rol) 
VALUES ('admin', NULL, '123', 'administracio'), ('tecnic', NULL, '123', '673764023', 'tecnic'), ('lector', NULL, '123', '673764023', 'lector');

INSERT INTO exposiciones (Texto, Fecha_inicio, Fecha_fin, Tipo, Lugar_ubicacion)
VALUES 
('Exposición de esculturas contemporáneas', '2023-05-01', '2023-09-01', 'Temporal', 'Sala 1 - Museo Apelles Fenosa'),
('Colección permanente de arte clásico', '2022-01-15', '2025-12-31', 'Permanente', 'Sala 2 - Museo Apelles Fenosa'),
('Exposición itinerante de arte abstracto', '2024-02-01', '2024-06-01', 'Itinerante', 'Sala 3 - Museo Apelles Fenosa');

INSERT INTO ubicaciones (Descripcion, ID_padre, Fecha_inicio, Fecha_fin)
VALUES 
('Sala de esculturas modernas en el primer piso', NULL, '2023-05-01', '2023-09-01'),
('Sala de arte clásico en el segundo piso', NULL, '2022-01-15', '2025-12-31'),
('Sala de arte abstracto en el tercer piso', NULL, '2024-02-01', '2024-06-01');

INSERT INTO obras (Numero_registro, Nombre_museo, Fotografia, Clasificacion_generica, Nombre_del_objeto, Coleccion_de_procedencia, Medidas_maxima_altura_cm, Medidas_maxima_anchura_cm, Medidas_maxima_profundidad_cm, Material, Tecnica, Autor, Titulo, Año_inicial, Año_final, Datacion, FK_id_ubicacion, Fecha_de_registro, Numero_de_ejemplares, Forma_de_ingreso, Fecha_de_ingreso, Fuente_de_ingreso, Estado_de_conservacion, Lugar_de_ejecucion, Lugar_de_procedencia, Num_Tiraje, Otros_numeros_de_identificacion, Valoracion_economica, Bibliografia, Descripcion, Historia_del_objeto, FK_id_exposicion)
VALUES 
('O001', 'Museo Apelles Fenosa', 'foto1.jpg', 'valor1', 'Escultura de mármol', 'Colección Apelles Fenosa', 150, 60, 40, 'Mármol', 'Esculpido', 'Apelles Fenosa', 'Figura abstracta', 2020, 2020, 'Contemporáneo', 1, '2023-05-01', 1, 'Donación', '2022-05-10', 'Colección privada', 'bueno', 'Barcelona', 'Barcelona', NULL, NULL, 5000.00, 'Libro de Escultura Contemporánea', 'Escultura abstracta representando una forma humana.', 'Esta obra fue parte de una colección privada antes de ser donada al museo.', 1),
('O002', 'Museo Apelles Fenosa', 'foto2.jpg', 'valor2', 'Vasija antigua', 'Colección Arqueológica', 30, 25, 25, 'Barro cocido', 'Moldeado', 'Anónimo', 'Vasija del siglo IV a.C.', -400, -350, 'Clásico', 2, '2022-01-15', 1, 'Compra', '2021-12-20', 'Subasta pública', 'bueno', 'Atenas', 'Grecia', NULL, NULL, 2000.00, 'Revista de Arqueología', 'Vasija utilizada para almacenar aceite en la antigüedad.', 'Procedente de excavaciones arqueológicas en Atenas.', 2),
('O003', 'Museo Apelles Fenosa', 'foto3.jpg', 'valor3', 'Pintura abstracta', 'Colección de Arte Moderno', 100, 150, 5, 'Óleo sobre lienzo', 'Pintura', 'Joan Miró', 'Composición en rojo y azul', 1935, 1935, 'Moderno', 3, '2024-02-01', 1, 'Legado', '2023-06-01', 'Legado familiar', 'bueno', 'París', 'París', NULL, NULL, 10000.00, 'Catálogo Joan Miró', 'Pintura abstracta con formas geométricas.', 'Legada al museo tras la muerte del coleccionista.', 3);