DROP DATABASE museu_apelles_fenosa;
CREATE DATABASE museu_apelles_fenosa;
USE museu_apelles_fenosa;

CREATE TABLE ubicaciones (
    ID_ubicacion INT PRIMARY KEY AUTO_INCREMENT,
    Descripcion TEXT NOT NULL,
    ID_padre INT NOT NULL,
    Fecha_inicio DATE NOT NULL,
    Fecha_fin DATE NOT NULL
);

CREATE TABLE exposiciones (
    ID_exposicion INT PRIMARY KEY AUTO_INCREMENT,
    Texto TEXT NOT NULL,
    Fecha_inicio DATE NOT NULL,
    Fecha_fin DATE NOT NULL,
    Tipo TEXT NOT NULL,
    Lugar_exposicion VARCHAR(255) NOT NULL
);

CREATE TABLE obras (
    Numero_registro VARCHAR(255) PRIMARY KEY,
    Nombre_museo VARCHAR(255) NOT NULL,
    Fotografia VARCHAR(255) NOT NULL,
    Clasificacion_generica TEXT NOT NULL,
    Nombre_del_objeto VARCHAR(255) NOT NULL,
    Coleccion_de_procedencia VARCHAR(255) NOT NULL,
    Medidas_maxima_altura_cm FLOAT NOT NULL,
    Medidas_maxima_anchura_cm FLOAT NOT NULL,
    Medidas_maxima_profundidad_cm FLOAT NOT NULL,
    Material VARCHAR(255) NOT NULL,
    Tecnica VARCHAR(255) NOT NULL,
    Autor VARCHAR(255) NOT NULL,
    Titulo VARCHAR(255) NOT NULL,
    Anyo_inicial INT NOT NULL,
    Anyo_final INT NOT NULL,
    Datacion VARCHAR(255) NOT NULL,
    FK_id_ubicacion INT NOT NULL,
    Fecha_de_registro DATE NOT NULL,
    Numero_de_ejemplares INT NOT NULL,
    Forma_de_ingreso ENUM('cessió', 'comodat', 'compra', 'dació', 'desconeguda', 'dipòsit', 'donació', 'entrega obligatòria', 'excavació', 'expropiació', 'herència', 'intercanvi', 'llegat', 'ocupació', 'ofrena', 'permuta', 'premi', 'propietat directa', 'recol.lecció', 'recuperació', 'successió interadministrativa') NOT NULL,
    Fecha_de_ingreso DATE NOT NULL,
    Fuente_de_ingreso VARCHAR(255) NOT NULL,
    Estado_de_conservacion ENUM('Bo', 'Dolent', 'Excel·lent', 'Indeterminat', 'Desconeguda', 'Regular')  NOT NULL,
    Lugar_de_ejecucion VARCHAR(255) NOT NULL,
    Lugar_de_procedencia VARCHAR(255) NOT NULL,
    Num_Tiraje VARCHAR(255) NOT NULL,
    Otros_numeros_de_identificacion VARCHAR(255) NOT NULL,
    Valoracion_economica DECIMAL(10,2) NOT NULL,
    Bibliografia VARCHAR(255) NOT NULL,
    Descripcion TEXT NOT NULL,
    Historia_del_objeto TEXT NOT NULL,
    FK_id_exposicion INT NOT NULL,
    FOREIGN KEY (FK_id_ubicacion) REFERENCES ubicaciones (ID_ubicacion),
    FOREIGN KEY (FK_id_exposicion) REFERENCES exposiciones(ID_exposicion)
);

CREATE TABLE restauraciones (
    ID_restauracion INT PRIMARY KEY AUTO_INCREMENT,
    Fecha_inicio DATE NOT NULL,
    Fecha_fin DATE NOT NULL,
    Comentario TEXT NOT NULL,
    Nombre_restaurador VARCHAR(255) NOT NULL,
    FK_id_obra VARCHAR(255),
    FOREIGN KEY (FK_id_obra) REFERENCES obras(Numero_registro)
);

CREATE TABLE movimientos (
    ID_movimiento INT PRIMARY KEY AUTO_INCREMENT,
    FK_id_obra varchar(255) NOT NULL,
    Museo TEXT NOT NULL,
    Fecha_inicio DATE NOT NULL,
    Fecha_fin DATE NOT NULL,
    Comentario TEXT NOT NULL,
    FOREIGN KEY (FK_id_obra) REFERENCES obras(Numero_registro)
);

CREATE TABLE usuarios (
    ID_usuario INT PRIMARY KEY AUTO_INCREMENT,
    Nombre VARCHAR(255) NOT NULL,
    Apellidos VARCHAR(255),
    Contrasenya VARCHAR(255) NOT NULL,
    Telefono VARCHAR(255),
    Rol ENUM('Lector', 'Tècnic', 'Administració') NOT NULL,
    Estado ENUM('Actiu', 'Inactiu') NOT NULL
);

CREATE TABLE logs (
    ID_log INT PRIMARY KEY AUTO_INCREMENT,
    Baja TEXT NOT NULL,
    Causa_baja TEXT NOT NULL,
    Fecha_baja DATE NOT NULL,
    Persona_baja TEXT NOT NULL,
    FK_id_obra VARCHAR(255),
    FK_id_usuario INT,
    FOREIGN KEY (FK_id_obra) REFERENCES obras(Numero_registro),
    FOREIGN KEY (FK_id_usuario) REFERENCES usuarios(ID_usuario)
);

CREATE TABLE vocabularios (
    ID_vocabulario INT PRIMARY KEY,
    Classificacion_generica TEXT,
    Material TEXT,
    Codigo_getty_material TEXT,
    Tecnica TEXT,
    Codigo_getty_tecnica TEXT,
    Codigo_autor TEXT,
    Forma_ingreso ENUM('cessió', 'comodat', 'compra', 'dació', 'desconeguda', 'dipòsit', 'donació', 'entrega obligatòria', 'excavació', 'expropiació', 'herència', 'intercanvi', 'llegat', 'ocupació', 'ofrena', 'permuta', 'premi', 'propietat directa', 'recol.lecció', 'recuperació', 'successió interadministrativa'),
    Baja ENUM('No', 'Si'),
    Causa_de_baja ENUM('Confiscació', 'Destrucció', 'Estat de conservació molt
deficient', 'Manteniment i restauració
onerós', 'Pèrdua', 'Robatori', 'Successió interadministrativa', 'Valor patrimonial insuficient'),
    Estado_de_conservacion ENUM('Bo', 'Dolent', 'Excel·lent', 'Indeterminat', 'Desconeguda', 'Regular')  NOT NULL,
    Tipo_exposicion ENUM('Aliena', 'Pròpia'),
    Datacion TEXT
); 

CREATE TABLE copias_seguridad (
    ID_copia INT PRIMARY KEY AUTO_INCREMENT,
    Nombre_copia VARCHAR(255) NOT NULL,
    Descripcion VARCHAR(255) NOT NULL,
    Fecha DATE NOT NULL,
    FK_id_creador INT NOT NULL,
    FOREIGN KEY (FK_id_creador) REFERENCES usuarios(ID_usuario)
);

INSERT INTO usuarios (Nombre, Apellidos, Contrasenya, Telefono, Rol) 
VALUES ('admin', NULL, '123', '673764023', 'administracio'), ('tecnic', NULL, '123', '673764023', 'tecnic'), ('lector', NULL, '123', '673764023', 'lector');

INSERT INTO exposiciones (Texto, Fecha_inicio, Fecha_fin, Tipo, Lugar_exposicion)
VALUES
('Exposición de arte contemporáneo', '2021-01-15', '2021-03-15', 'Pròpia', 'Sala Principal'),
('Muestra de esculturas clásicas', '2020-05-01', '2020-08-01', 'Aliena', 'Galería de Esculturas'),
('Exposición temporal de fotografía', '2021-07-01', '2021-09-01', 'Pròpia', 'Sala Secundaria'),
('Exposición de pintura moderna', '2019-09-10', '2019-11-30', 'Pròpia', 'Sala Principal'),
('Exposición de grabados antiguos', '2020-12-01', '2021-02-01', 'Aliena', 'Sala Principal'),
('Exposición de arte renacentista', '2022-04-15', '2022-07-15', 'Pròpia', 'Galería de Esculturas'),
('Exposición de arte conceptual', '2022-10-01', '2023-01-01', 'Pròpia', 'Sala Principal'),
('Muestra internacional de arte moderno', '2023-03-01', '2023-06-01', 'Aliena', 'Sala Secundaria'),
('Exposición de esculturas contemporáneas', '2023-09-15', '2023-12-15', 'Pròpia', 'Galería de Esculturas'),
('Exposición fotográfica urbana', '2024-02-01', '2024-04-01', 'Pròpia', 'Sala Principal');


INSERT INTO ubicaciones (Descripcion, ID_padre, Fecha_inicio, Fecha_fin)
VALUES
('Sala Principal', 0, '2020-01-01', '2022-12-31'),
('Sala Secundaria', 1, '2020-02-01', '2022-10-31'),
('Almacén Principal', 0, '2019-05-01', '2023-03-15'),
('Almacén Secundario', 3, '2019-06-01', '2023-03-15'),
('Exposición Temporal 1', 1, '2021-03-15', '2021-06-15'),
('Exposición Temporal 2', 1, '2021-07-01', '2021-09-30'),
('Galería de Esculturas', 0, '2018-08-01', '2024-12-31'),
('Área de Restauración', 0, '2022-05-01', '2024-12-31'),
('Oficinas Administrativas', 0, '2015-01-01', '2024-12-31'),
('Depósito de Obras', 3, '2019-06-01', '2023-03-15');


INSERT INTO obras VALUES
('O001', 'Museu Apelles Fenosa', 'foto1.jpg', 'Escultura', 'Escultura de mármol', 'Colección Apelles Fenosa', 120.5, 45.0, 35.0, 'Mármol', 'Cincelado', 'Apelles Fenosa', 'El pensador', 1950, 1951, 'c. 1950-1951', 1, '2021-01-15', 1, 'donació', '2020-12-01', 'Fundación Apelles', 'Excel·lent', 'Barcelona', 'Barcelona', 'T001', 'ID001', 150000.00, 'Bibliografía de esculturas', 'Escultura de un hombre pensante', 'Fue adquirida por el museo en 2020.', 1),
('O002', 'Museu Apelles Fenosa', 'foto2.jpg', 'Pintura', 'Óleo sobre lienzo', 'Colección Privada', 80.0, 60.0, 0.0, 'Lienzo', 'Óleo', 'Pablo Picasso', 'Retrato de una dama', 1940, 1940, 'c. 1940', 2, '2021-02-10', 1, 'compra', '2020-11-15', 'Galería de Arte Moderna', 'Bo', 'París', 'Madrid', 'T002', 'ID002', 2000000.00, 'Catálogo de Picasso', 'Retrato expresionista de una dama', 'Obra adquirida en subasta.', 2),
('O003', 'Museu Apelles Fenosa', 'foto3.jpg', 'Fotografía', 'Fotografía en blanco y negro', 'Archivo Fotográfico Nacional', 30.0, 40.0, 0.0, 'Papel fotográfico', 'Impresión', 'Manuel Álvarez Bravo', 'Calle de México', 1932, 1932, 'c. 1932', 3, '2020-10-20', 1, 'donació', '2020-10-10', 'Donación particular', 'Regular', 'Ciudad de México', 'Ciudad de México', 'T003', 'ID003', 5000.00, 'Fotografía Latinoamericana', 'Fotografía de una calle en Ciudad de México', 'Obra donada por un coleccionista.', 3),
('O004', 'Museu Apelles Fenosa', 'foto4.jpg', 'Grabado', 'Grabado en madera', 'Colección Apelles Fenosa', 50.0, 70.0, 0.0, 'Madera', 'Grabado', 'Joan Miró', 'El jardín', 1965, 1965, 'c. 1965', 4, '2021-03-05', 2, 'cessió', '2020-09-01', 'Colección Joan Miró', 'Bo', 'Mallorca', 'Barcelona', 'T004', 'ID004', 75000.00, 'Catálogo de grabados', 'Grabado abstracto en colores vivos', 'Obra cedida para exposición temporal.', 4),
('O005', 'Museu Apelles Fenosa', 'foto5.jpg', 'Escultura', 'Escultura en bronce', 'Colección Apelles Fenosa', 180.0, 80.0, 50.0, 'Bronce', 'Fundición', 'Henry Moore', 'Figura reclinada', 1960, 1960, 'c. 1960', 5, '2021-06-20', 1, 'compra', '2021-05-01', 'Fundación Henry Moore', 'Bo', 'Londres', 'Londres', 'T005', 'ID005', 1200000.00, 'Catálogo de esculturas de Henry Moore', 'Escultura moderna de una figura humana reclinada', 'Obra adquirida en una feria de arte.', 5),
('O006', 'Museu Apelles Fenosa', 'foto6.jpg', 'Pintura', 'Acrílico sobre lienzo', 'Colección Contemporánea', 100.0, 150.0, 0.0, 'Lienzo', 'Acrílico', 'Jackson Pollock', 'No. 5', 1948, 1948, 'c. 1948', 6, '2021-08-15', 1, 'compra', '2021-07-01', 'Galería de Arte Contemporáneo', 'Excel·lent', 'Nueva York', 'Nueva York', 'T006', 'ID006', 50000000.00, 'Catálogo de arte moderno', 'Pintura abstracta en estilo drip painting', 'Adquirida en subasta internacional.', 6),
('O007', 'Museu Apelles Fenosa', 'foto7.jpg', 'Fotografía', 'Fotografía digital', 'Colección de Fotografía Contemporánea', 60.0, 40.0, 0.0, 'Papel fotográfico', 'Impresión digital', 'Annie Leibovitz', 'Retrato de celebridad', 2005, 2005, 'c. 2005', 7, '2021-09-10', 1, 'donació', '2021-08-15', 'Donación de la artista', 'Excel·lent', 'Nueva York', 'Nueva York', 'T007', 'ID007', 100000.00, 'Revista de Fotografía Contemporánea', 'Retrato de una celebridad en blanco y negro', 'Donada por la propia artista.', 7),
('O008', 'Museu Apelles Fenosa', 'foto8.jpg', 'Escultura', 'Escultura en piedra', 'Colección Apelles Fenosa', 250.0, 100.0, 60.0, 'Piedra', 'Talla', 'Constantin Brâncuși', 'Columna sin fin', 1918, 1918, 'c. 1918', 8, '2021-11-05', 1, 'compra', '2021-10-01', 'Fundación Brâncuși', 'Bo', 'París', 'París', 'T008', 'ID008', 2500000.00, 'Catálogo de Brâncuși', 'Escultura minimalista en forma de columna', 'Adquirida para una exposición permanente.', 8),
('O009', 'Museu Apelles Fenosa', 'foto9.jpg', 'Pintura', 'Óleo sobre tabla', 'Colección Impresionista', 120.0, 100.0, 0.0, 'Madera', 'Óleo', 'Claude Monet', 'El estanque de nenúfares', 1905, 1905, 'c. 1905', 9, '2022-01-15', 1, 'compra', '2021-12-01', 'Galería de Arte Impresionista', 'Bo', 'París', 'París', 'T009', 'ID009', 15000000.00, 'Catálogo Monet', 'Paisaje impresionista de un estanque con nenúfares', 'Adquirida en subasta privada.', 9),
('O010', 'Museu Apelles Fenosa', 'foto10.jpg', 'Pintura', 'Acuarela sobre papel', 'Colección Moderna', 60.0, 80.0, 0.0, 'Papel', 'Acuarela', 'Paul Klee', 'Paisaje imaginario', 1920, 1920, 'c. 1920', 10, '2022-03-20', 1, 'compra', '2022-02-15', 'Galería de Arte Moderna', 'Bo', 'Berlín', 'Berlín', 'T010', 'ID010', 500000.00, 'Catálogo de Paul Klee', 'Paisaje abstracto y colorido', 'Adquirida para una exposición permanente.', 10);
