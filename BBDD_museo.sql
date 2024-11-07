DROP DATABASE museu_apelles_fenosa;
CREATE DATABASE museu_apelles_fenosa;
USE museu_apelles_fenosa;

CREATE TABLE ubicaciones (
    id_ubicacion INT PRIMARY KEY AUTO_INCREMENT,
    descripcion_ubicacion TEXT NOT NULL,
    id_padre INT,
    fecha_inicio_ubicacion DATE NOT NULL,
    fecha_fin_ubicacion DATE NOT NULL
);

CREATE TABLE exposiciones (
    id_exposicion INT PRIMARY KEY AUTO_INCREMENT,
    texto_exposicion TEXT NOT NULL,
    tipo_exposicion VARCHAR(255) NOT NULL,
    lugar_exposicion VARCHAR(255) NOT NULL,
    fecha_inicio_exposicion DATE NOT NULL,
    fecha_fin_exposicion DATE NOT NULL
);

CREATE TABLE obras (
    numero_registro VARCHAR(255) PRIMARY KEY,
    nombre_objeto VARCHAR(255) NOT NULL,
    fotografia VARCHAR(255),
    titulo VARCHAR(255) NOT NULL,
    autor VARCHAR(255) NOT NULL,
    datacion VARCHAR(255) NOT NULL,
    anyo_inicial INT NOT NULL,
    anyo_final INT NOT NULL,
    descripcion_obra TEXT NOT NULL,
    fecha_registro DATE NOT NULL,
    material VARCHAR(255) NOT NULL,
    tecnica VARCHAR(255) NOT NULL,
    clasificacion_generica VARCHAR(255) NOT NULL,
    coleccion_procedencia VARCHAR(255) NOT NULL,
    maxima_altura_cm FLOAT NOT NULL,
    maxima_anchura_cm FLOAT NOT NULL,
    maxima_profundidad_cm FLOAT NOT NULL,
    nombre_museo VARCHAR(255) NOT NULL,
    fk_ubicacion INT,
    estado_conservacion VARCHAR(255) NOT NULL,
    lugar_ejecucion VARCHAR(255) NOT NULL,
    lugar_procedencia VARCHAR(255) NOT NULL,
    numero_tiraje VARCHAR(255) NOT NULL,
    otros_numeros_identificacion VARCHAR(255),
    numero_ejemplares INT NOT NULL,
    forma_ingreso VARCHAR(255) NOT NULL,
    fecha_ingreso DATE NOT NULL,
    fuente_ingreso VARCHAR(255) NOT NULL,
    valoracion_economica DECIMAL(11,2) NOT NULL,
    historia_objeto TEXT NOT NULL,
    bibliografia TEXT NOT NULL,
    FOREIGN KEY (fk_ubicacion) REFERENCES ubicaciones(id_ubicacion)
);

CREATE TABLE obras_exposiciones (
    fk_obra VARCHAR(255),
    fk_exposicion INT,
    FOREIGN KEY (fk_obra) REFERENCES obras(numero_registro),
    FOREIGN KEY (fk_exposicion) REFERENCES exposiciones(id_exposicion)
);

CREATE TABLE usuarios (
    id_usuario INT PRIMARY KEY AUTO_INCREMENT,
    foto_usuario VARCHAR(255),
    usuario VARCHAR(255) NOT NULL,
    nombre VARCHAR(255) NOT NULL,
    apellidos VARCHAR(255),
    contrasenya VARCHAR(255) NOT NULL,
    correo_electronico VARCHAR(255),
    telefono VARCHAR(255),
    rol ENUM('Lector', 'Tècnic', 'Administració') NOT NULL,
    estado ENUM('Actiu', 'Inactiu') NOT NULL
);

CREATE TABLE logs_obras (
    id_log INT PRIMARY KEY AUTO_INCREMENT,
    fk_obra VARCHAR(255) NOT NULL,
    baja VARCHAR(255) NOT NULL,
    causa_baja VARCHAR(255) NOT NULL,
    fecha_baja DATE NOT NULL,
    persona_autorizada INT NOT NULL,
    FOREIGN KEY (fk_obra) REFERENCES obras(numero_registro),
    FOREIGN KEY (persona_autorizada) REFERENCES usuarios(id_usuario)
);

CREATE TABLE restauraciones (
    id_restauracion INT PRIMARY KEY AUTO_INCREMENT,
    fk_obra VARCHAR(255) NOT NULL,
    comentario_restauracion TEXT NOT NULL,
    nombre_restaurador VARCHAR(255) NOT NULL,
    fecha_inicio_restauracion DATE NOT NULL,
    fecha_fin_restauracion DATE NOT NULL,
    FOREIGN KEY (fk_obra) REFERENCES obras(numero_registro)
);

CREATE TABLE movimientos (
    id_movimiento INT PRIMARY KEY AUTO_INCREMENT,
    fk_obra VARCHAR(255) NOT NULL,
    comentario_movimiento TEXT NOT NULL,
    museo VARCHAR(255) NOT NULL,
    fecha_inicio_movimiento DATE NOT NULL,
    fecha_fin_movimiento DATE NOT NULL,
    FOREIGN KEY (fk_obra) REFERENCES obras(numero_registro)
);

CREATE TABLE vocabularios (
    id_vocabulario INT AUTO_INCREMENT PRIMARY KEY,
    nombre_vocabulario VARCHAR(255) NOT NULL UNIQUE
);

CREATE TABLE campos (
    id_campo INT AUTO_INCREMENT PRIMARY KEY,
    nombre_campo VARCHAR(255) NOT NULL,
    fk_vocabulario INT NOT NULL,
    FOREIGN KEY (fk_vocabulario) REFERENCES vocabularios(id_vocabulario)
);

CREATE TABLE copias_seguridad (
    id_copia INT PRIMARY KEY AUTO_INCREMENT,
    nombre_copia VARCHAR(255) NOT NULL,
    descripcion_copia TEXT,
    fecha_copia DATE NOT NULL,
    fk_creador INT NOT NULL,
    FOREIGN KEY (fk_creador) REFERENCES usuarios(id_usuario)
);

INSERT INTO ubicaciones (descripcion_ubicacion, id_padre, fecha_inicio_ubicacion, fecha_fin_ubicacion) VALUES
('Sala A', 0, '2023-01-01', '2023-12-31'),
('Sala B', 0, '2023-01-01', '2023-12-31'),
('Galería 1', 1, '2023-02-01', '2023-10-31'),
('Galería 2', 1, '2023-02-01', '2023-10-31'),
('Sala C', 0, '2023-01-01', '2023-12-31'),
('Sala D', 0, '2023-03-01', '2023-11-30'),
('Sección Historia', 5, '2023-04-01', '2023-09-30'),
('Sección Moderna', 5, '2023-04-01', '2023-09-30'),
('Pasillo 1', 2, '2023-05-01', '2023-10-31'),
('Pasillo 2', 2, '2023-05-01', '2023-10-31'),
('Exhibición Temporal 1', 6, '2023-06-01', '2023-08-31'),
('Exhibición Temporal 2', 6, '2023-06-01', '2023-08-31'),
('Área de Escultura', 1, '2023-02-01', '2023-10-31'),
('Área de Pintura', 1, '2023-02-01', '2023-10-31'),
('Depósito Central', 0, '2023-01-01', '2023-12-31'),
('Sala de Restauración', 0, '2023-01-01', '2023-12-31'),
('Sala de Exhibiciones Especiales', 0, '2023-01-01', '2023-12-31'),
('Galería 3', 1, '2023-02-01', '2023-10-31'),
('Galería 4', 1, '2023-02-01', '2023-10-31'),
('Pasillo 3', 2, '2023-05-01', '2023-10-31'),
('Pasillo 4', 2, '2023-05-01', '2023-10-31'),
('Vestíbulo', 0, '2023-01-01', '2023-12-31'),
('Depósito 1', 15, '2023-02-01', '2023-12-31'),
('Depósito 2', 15, '2023-02-01', '2023-12-31'),
('Sala de Conferencias', 0, '2023-01-01', '2023-12-31'),
('Zona de Entrada', 0, '2023-01-01', '2023-12-31'),
('Pasillo de Arte Moderno', 2, '2023-03-01', '2023-10-31'),
('Área de Arte Clásico', 1, '2023-04-01', '2023-10-31'),
('Sala de Exposiciones Fotográficas', 0, '2023-05-01', '2023-12-31'),
('Sala de Exposiciones Temporales', 0, '2023-06-01', '2023-12-31');


INSERT INTO exposiciones (texto_exposicion, tipo_exposicion, lugar_exposicion, fecha_inicio_exposicion, fecha_fin_exposicion) VALUES
('Exposición Renacentista', 'Pintura', 'Sala A', '2023-01-01', '2023-06-30'),
('Exposición Contemporánea', 'Escultura', 'Galería 1', '2023-07-01', '2023-12-31'),
('Obras de Dalí', 'Pintura', 'Sala B', '2023-02-01', '2023-08-31'),
('Exposición Fotográfica', 'Fotografía', 'Galería 2', '2023-03-01', '2023-09-30'),
('Esculturas Modernas', 'Escultura', 'Sala C', '2023-04-01', '2023-10-31'),
('Fotografía del Siglo XX', 'Fotografía', 'Sala D', '2023-05-01', '2023-11-30'),
('Arte Africano', 'Escultura', 'Sección Historia', '2023-01-15', '2023-07-15'),
('Muestras de Asia', 'Pintura', 'Sección Moderna', '2023-06-01', '2023-12-01'),
('Arte y Naturaleza', 'Pintura', 'Pasillo 1', '2023-04-01', '2023-09-30'),
('Impresionismo', 'Pintura', 'Pasillo 2', '2023-05-01', '2023-10-31'),
('Escultura Griega', 'Escultura', 'Exhibición Temporal 1', '2023-06-01', '2023-08-31'),
('Escultura Romana', 'Escultura', 'Exhibición Temporal 2', '2023-06-01', '2023-08-31'),
('Arte Moderno', 'Pintura', 'Área de Pintura', '2023-07-01', '2023-12-31'),
('Fotografía Moderna', 'Fotografía', 'Sala de Exposiciones Fotográficas', '2023-06-15', '2023-10-15'),
('Clásicos del Renacimiento', 'Pintura', 'Área de Escultura', '2023-02-01', '2023-10-31'),
('Arte Contemporáneo', 'Pintura', 'Pasillo 3', '2023-03-01', '2023-09-30'),
('Arte Antiguo', 'Escultura', 'Pasillo 4', '2023-04-01', '2023-09-30'),
('Escultura Renacentista', 'Escultura', 'Vestíbulo', '2023-05-01', '2023-09-30'),
('Arte Abstracto', 'Pintura', 'Pasillo de Arte Moderno', '2023-01-01', '2023-12-31'),
('Muestra de Impresionismo', 'Pintura', 'Área de Arte Clásico', '2023-06-01', '2023-10-31'),
('Arte Latinoamericano', 'Pintura', 'Zona de Entrada', '2023-02-15', '2023-08-15'),
('Escultura Española', 'Escultura', 'Galería 3', '2023-07-15', '2023-12-15'),
('Exposición de Van Gogh', 'Pintura', 'Galería 4', '2023-03-15', '2023-09-15'),
('Exposición de Picasso', 'Pintura', 'Sala de Exposiciones Temporales', '2023-01-10', '2023-07-10'),
('Exposición Barroca', 'Pintura', 'Sala A', '2023-03-10', '2023-08-10'),
('Escultura Contemporánea', 'Escultura', 'Sala B', '2023-05-15', '2023-10-15'),
('Arte Japonés', 'Pintura', 'Galería 1', '2023-02-01', '2023-09-01'),
('Fotografía Clásica', 'Fotografía', 'Sala D', '2023-03-01', '2023-08-31'),
('Escultura Clásica', 'Escultura', 'Galería 2', '2023-04-01', '2023-10-31'),
('Exposición de Monet', 'Pintura', 'Sala de Conferencias', '2023-01-20', '2023-06-20');

INSERT INTO obras (numero_registro, nombre_objeto, fotografia, titulo, autor, datacion, anyo_inicial, anyo_final, descripcion_obra, fecha_registro, material, tecnica, clasificacion_generica, coleccion_procedencia, maxima_altura_cm, maxima_anchura_cm, maxima_profundidad_cm, nombre_museo, fk_ubicacion, estado_conservacion, lugar_ejecucion, lugar_procedencia, numero_tiraje, otros_numeros_identificacion, numero_ejemplares, forma_ingreso, fecha_ingreso, fuente_ingreso, valoracion_economica, historia_objeto, bibliografia) VALUES
('REG001', 'Cuadro', 'foto1.jpg', 'La Noche Estrellada', 'Vincent van Gogh', '1889', 1889, 1889, 'Una representación expresiva del cielo nocturno', '2023-01-15', 'Óleo', 'Impresionismo', 'Pintura', 'Colección Europea', 73.7, 92.1, 3.0, 'Museo de Arte Moderno', 1, 'Buena', 'Francia', 'Holanda', 'T001', 'ID123', 5, 'Donación', '2023-01-20', 'Fundación del Arte', 200000.00, 'Historia de la obra y restauraciones.', 'Libro A'),
('REG002', 'Escultura', 'foto2.jpg', 'El Pensador', 'Auguste Rodin', '1902', 1902, 1904, 'Escultura que representa a un hombre en profundo pensamiento', '2023-02-10', 'Bronce', 'Escultura', 'Escultura', 'Colección Francesa', 180.0, 70.0, 120.0, 'Museo de Esculturas', 2, 'Excelente', 'Francia', 'Francia', 'T002', 'ID124', 10, 'Compra', '2023-02-15', 'Ministerio de Cultura', 500000.00, 'Descripción y relevancia de la obra.', 'Revista B'),
('REG003', 'Pintura', 'foto3.jpg', 'Mona Lisa', 'Leonardo da Vinci', '1503', 1503, 1506, 'Retrato icónico de una mujer', '2023-03-20', 'Óleo', 'Renacimiento', 'Pintura', 'Colección Italiana', 77.0, 53.0, 2.0, 'Museo del Louvre', 3, 'Excelente', 'Italia', 'Francia', 'T003', 'ID125', 1, 'Legado', '2023-03-25', 'Museo del Louvre', 780000000.00, 'Obra maestra del Renacimiento.', 'Libro C'),
('REG004', 'Escultura', 'foto4.jpg', 'David', 'Miguel Ángel', '1504', 1501, 1504, 'Escultura de mármol del héroe bíblico', '2023-04-15', 'Mármol', 'Escultura', 'Escultura', 'Colección Italiana', 517.0, 199.0, 120.0, 'Museo de Florencia', 4, 'Buena', 'Italia', 'Italia', 'T004', 'ID126', 1, 'Donación', '2023-04-20', 'Ministerio de Cultura', 300000000.00, 'Historia de la escultura.', 'Libro D'),
('REG005', 'Pintura', 'foto5.jpg', 'El Grito', 'Edvard Munch', '1893', 1893, 1893, 'Obra expresionista de un personaje gritando', '2023-05-05', 'Óleo', 'Expresionismo', 'Pintura', 'Colección Nórdica', 91.0, 73.5, 2.5, 'Museo de Oslo', 5, 'Moderada', 'Noruega', 'Noruega', 'T005', 'ID127', 3, 'Compra', '2023-05-10', 'Museo de Oslo', 150000000.00, 'Relato de la historia del cuadro.', 'Revista E'),
('REG006', 'Escultura', 'foto6.jpg', 'Venus de Milo', 'Desconocido', '130 a.C.', -130, -130, 'Escultura antigua de Afrodita', '2023-06-01', 'Mármol', 'Escultura', 'Escultura', 'Colección Griega', 203.0, 68.0, 68.0, 'Museo del Louvre', 6, 'Buena', 'Grecia', 'Grecia', 'T006', 'ID128', 1, 'Legado', '2023-06-05', 'Museo del Louvre', 120000000.00, 'Historia y contexto de la escultura.', 'Enciclopedia F'),
('REG007', 'Pintura', 'foto7.jpg', 'Las Meninas', 'Diego Velázquez', '1656', 1656, 1656, 'Retrato grupal de la familia real española', '2023-07-10', 'Óleo', 'Barroco', 'Pintura', 'Colección Española', 318.0, 276.0, 2.0, 'Museo del Prado', 7, 'Excelente', 'España', 'España', 'T007', 'ID129', 1, 'Donación', '2023-07-15', 'Museo del Prado', 200000000.00, 'Historia de la pintura y el autor.', 'Libro G'),
('REG008', 'Escultura', 'foto8.jpg', 'Pietà', 'Miguel Ángel', '1499', 1498, 1499, 'Escultura de la Virgen María sosteniendo a Jesús', '2023-08-20', 'Mármol', 'Escultura', 'Escultura', 'Colección Vaticana', 174.0, 195.0, 69.0, 'Museos Vaticanos', 8, 'Buena', 'Italia', 'Italia', 'T008', 'ID130', 1, 'Legado', '2023-08-25', 'Museos Vaticanos', 90000000.00, 'Detalles sobre la obra y su autor.', 'Enciclopedia H'),
('REG009', 'Pintura', 'foto9.jpg', 'La Persistencia de la Memoria', 'Salvador Dalí', '1931', 1931, 1931, 'Representación surrealista de relojes derritiéndose', '2023-09-12', 'Óleo', 'Surrealismo', 'Pintura', 'Colección Española', 24.0, 33.0, 2.5, 'Museo de Arte Moderno', 9, 'Buena', 'España', 'España', 'T009', 'ID131', 4, 'Compra', '2023-09-15', 'Museo de Arte Moderno', 120000000.00, 'Significado surrealista.', 'Revista I'),
('REG010', 'Escultura', 'foto10.jpg', 'Nike de Samotracia', 'Desconocido', '200 a.C.', -200, -200, 'Escultura de la diosa de la victoria', '2023-10-01', 'Mármol', 'Escultura', 'Escultura', 'Colección Griega', 244.0, 200.0, 120.0, 'Museo del Louvre', 10, 'Moderada', 'Grecia', 'Grecia', 'T010', 'ID132', 1, 'Legado', '2023-10-05', 'Museo del Louvre', 110000000.00, 'Historia y simbolismo.', 'Enciclopedia J'),
('REG011', 'Escultura', 'foto11.jpg', 'Discóbolo', 'Mirón', '450 a.C.', -450, -450, 'Escultura de un atleta lanzando un disco', '2023-10-10', 'Mármol', 'Escultura Griega', 'Escultura', 'Colección Griega', 155.0, 95.0, 60.0, 'Museo Británico', 11, 'Buena', 'Grecia', 'Grecia', 'T011', 'ID133', 1, 'Compra', '2023-10-15', 'Museo Británico', 100000000.00, 'Historia y restauraciones.', 'Libro K'),
('REG012', 'Pintura', 'foto12.jpg', 'Guernica', 'Pablo Picasso', '1937', 1937, 1937, 'Pintura que refleja los horrores de la guerra', '2023-11-01', 'Óleo', 'Cubismo', 'Pintura', 'Colección Española', 349.3, 776.6, 2.0, 'Museo Reina Sofía', 12, 'Excelente', 'España', 'España', 'T012', 'ID134', 1, 'Donación', '2023-11-05', 'Museo Reina Sofía', 200000000.00, 'Descripción y contexto histórico.', 'Revista L'),
('REG013', 'Escultura', 'foto13.jpg', 'Moái', 'Cultura Rapa Nui', '1000 d.C.', 1000, 1500, 'Escultura monolítica de la Isla de Pascua', '2023-12-01', 'Piedra', 'Escultura', 'Escultura', 'Colección Chilena', 400.0, 150.0, 100.0, 'Museo de Santiago', 13, 'Moderada', 'Chile', 'Chile', 'T013', 'ID135', 10, 'Compra', '2023-12-05', 'Gobierno Chileno', 25000000.00, 'Historia de los moáis.', 'Enciclopedia M'),
('REG014', 'Pintura', 'foto14.jpg', 'El Jardín de las Delicias', 'El Bosco', '1503', 1500, 1505, 'Tríptico que representa la vida y el pecado', '2024-01-01', 'Óleo', 'Gótico', 'Pintura', 'Colección Española', 220.0, 389.0, 2.0, 'Museo del Prado', 14, 'Buena', 'Países Bajos', 'España', 'T014', 'ID136', 1, 'Legado', '2024-01-05', 'Museo del Prado', 150000000.00, 'Análisis detallado del simbolismo.', 'Libro N'),
('REG015', 'Escultura', 'foto15.jpg', 'León de Lucerna', 'Bertel Thorvaldsen', '1820', 1820, 1821, 'Escultura que simboliza a los guardias suizos caídos', '2024-02-10', 'Piedra', 'Escultura', 'Escultura', 'Colección Suiza', 600.0, 300.0, 120.0, 'Museo de Lucerna', 15, 'Buena', 'Suiza', 'Suiza', 'T015', 'ID137', 1, 'Donación', '2024-02-15', 'Gobierno Suizo', 7500000.00, 'Simbolismo de la escultura.', 'Revista O'),
('REG016', 'Pintura', 'foto16.jpg', 'La Ronda de Noche', 'Rembrandt', '1642', 1642, 1642, 'Retrato grupal de la guardia cívica', '2024-03-01', 'Óleo', 'Barroco', 'Pintura', 'Colección Holandesa', 363.0, 437.0, 2.5, 'Museo de Ámsterdam', 16, 'Moderada', 'Holanda', 'Holanda', 'T016', 'ID138', 1, 'Compra', '2024-03-05', 'Museo de Ámsterdam', 120000000.00, 'Historia de la obra.', 'Enciclopedia P'),
('REG017', 'Escultura', 'foto17.jpg', 'Mercurio Volando', 'Giambologna', '1580', 1580, 1580, 'Escultura de Mercurio en una postura dinámica', '2024-04-01', 'Bronce', 'Renacimiento', 'Escultura', 'Colección Italiana', 156.0, 60.0, 60.0, 'Museo de Florencia', 17, 'Buena', 'Italia', 'Italia', 'T017', 'ID139', 1, 'Compra', '2024-04-05', 'Ministerio de Cultura', 40000000.00, 'Significado y análisis estilístico.', 'Libro Q'),
('REG018', 'Pintura', 'foto18.jpg', 'El Beso', 'Gustav Klimt', '1908', 1908, 1908, 'Escena de un beso dorado', '2024-05-01', 'Óleo y pan de oro', 'Modernismo', 'Pintura', 'Colección Austriaca', 180.0, 180.0, 2.0, 'Galería Belvedere', 18, 'Buena', 'Austria', 'Austria', 'T018', 'ID140', 1, 'Donación', '2024-05-05', 'Museo de Viena', 100000000.00, 'Análisis y simbolismo.', 'Revista R'),
('REG019', 'Escultura', 'foto19.jpg', 'Tierra Madre', 'Desconocido', '2500 a.C.', -2500, -2500, 'Estatuilla de fertilidad', '2024-06-01', 'Arcilla', 'Escultura Antigua', 'Escultura', 'Colección Mesopotámica', 25.0, 10.0, 5.0, 'Museo Británico', 19, 'Buena', 'Mesopotamia', 'Irak', 'T019', 'ID141', 5, 'Compra', '2024-06-05', 'Museo Británico', 5000000.00, 'Significado arqueológico.', 'Libro S'),
('REG020', 'Pintura', 'foto20.jpg', 'Los Fusilamientos del 3 de mayo', 'Francisco de Goya', '1814', 1814, 1814, 'Representación de la represión napoleónica', '2024-07-01', 'Óleo', 'Romanticismo', 'Pintura', 'Colección Española', 266.0, 345.0, 2.5, 'Museo del Prado', 20, 'Moderada', 'España', 'España', 'T020', 'ID142', 1, 'Compra', '2024-07-05', 'Museo del Prado', 130000000.00, 'Simbolismo histórico.', 'Revista T'),
('REG021', 'Escultura', 'foto21.jpg', 'Laocoön y sus Hijos', 'Agesandro', '30 a.C.', -30, -30, 'Escena de lucha contra serpientes', '2024-08-01', 'Mármol', 'Escultura Griega', 'Escultura', 'Colección Griega', 242.0, 160.0, 100.0, 'Museo Vaticano', 21, 'Buena', 'Grecia', 'Grecia', 'T021', 'ID143', 1, 'Legado', '2024-08-05', 'Museo Vaticano', 75000000.00, 'Análisis arqueológico.', 'Enciclopedia U'),
('REG022', 'Pintura', 'foto22.jpg', 'Nacimiento de Venus', 'Sandro Botticelli', '1486', 1484, 1486, 'Escena mitológica de Venus emergiendo del mar', '2024-09-01', 'Tempera', 'Renacimiento', 'Pintura', 'Colección Italiana', 172.5, 278.5, 2.0, 'Museo Uffizi', 22, 'Buena', 'Italia', 'Italia', 'T022', 'ID144', 1, 'Donación', '2024-09-05', 'Museo Uffizi', 90000000.00, 'Historia y simbolismo.', 'Revista V'),
('REG023', 'Escultura', 'foto23.jpg', 'Gran Esfinge de Giza', 'Desconocido', '2558 a.C.', -2558, -2532, 'Figura monumental de una esfinge', '2024-10-01', 'Piedra caliza', 'Escultura Antigua', 'Escultura', 'Colección Egipcia', 2000.0, 1900.0, 1000.0, 'Museo Egipcio', 23, 'Moderada', 'Egipto', 'Egipto', 'T023', 'ID145', 1, 'Legado', '2024-10-05', 'Museo Egipcio', 200000000.00, 'Análisis arqueológico.', 'Libro W'),
('REG024', 'Pintura', 'foto24.jpg', 'Noche Estrellada sobre el Ródano', 'Vincent van Gogh', '1888', 1888, 1888, 'Cielo estrellado reflejado en el río', '2024-11-01', 'Óleo', 'Postimpresionismo', 'Pintura', 'Colección Europea', 72.5, 92.5, 2.5, 'Museo de Arte Moderno', 24, 'Buena', 'Francia', 'Francia', 'T024', 'ID146', 1, 'Compra', '2024-11-05', 'Museo de Arte Moderno', 75000000.00, 'Historia y contexto.', 'Enciclopedia X'),
('REG025', 'Escultura', 'foto25.jpg', 'Dama de Elche', 'Desconocido', 'IV a.C.', -400, -400, 'Figura de mujer con tocado ibérico', '2024-12-01', 'Piedra', 'Escultura Ibérica', 'Escultura', 'Colección Española', 56.0, 45.0, 30.0, 'Museo Arqueológico Nacional', 25, 'Buena', 'España', 'España', 'T025', 'ID147', 1, 'Legado', '2024-12-05', 'Museo Arqueológico Nacional', 50000000.00, 'Significado arqueológico.', 'Revista Y'),
('REG026', 'Pintura', 'foto26.jpg', 'Retrato de Adele Bloch-Bauer I', 'Gustav Klimt', '1907', 1907, 1907, 'Retrato en pan de oro', '2025-01-01', 'Óleo y pan de oro', 'Modernismo', 'Pintura', 'Colección Austriaca', 138.0, 138.0, 2.0, 'Museo Belvedere', 26, 'Buena', 'Austria', 'Austria', 'T026', 'ID148', 1, 'Compra', '2025-01-05', 'Galería de Viena', 150000000.00, 'Historia del retrato.', 'Libro Z'),
('REG027', 'Escultura', 'foto27.jpg', 'El Coloso de Rodas', 'Escultor de Lindos', '292 a.C.', -292, -280, 'Escultura colosal de Helios', '2025-02-01', 'Bronce', 'Escultura Griega', 'Escultura', 'Colección Griega', 3300.0, 600.0, 300.0, 'Museo de Rodas', 27, 'Destruida', 'Grecia', 'Grecia', 'T027', 'ID149', 1, 'Documentación Histórica', '2025-02-05', 'Museo de Rodas', 40000000.00, 'Historia y reconstrucciones.', 'Enciclopedia AA'),
('REG028', 'Pintura', 'foto28.jpg', 'La Joven de la Perla', 'Johannes Vermeer', '1665', 1665, 1665, 'Retrato de una joven con turbante', '2025-03-01', 'Óleo', 'Barroco', 'Pintura', 'Colección Holandesa', 44.5, 39.0, 2.0, 'Museo Mauritshuis', 28, 'Excelente', 'Holanda', 'Holanda', 'T028', 'ID150', 1, 'Donación', '2025-03-05', 'Museo Mauritshuis', 80000000.00, 'Significado y análisis estilístico.', 'Revista BB'),
('REG029', 'Escultura', 'foto29.jpg', 'Busto de Nefertiti', 'Thutmose', '1345 a.C.', -1345, -1345, 'Retrato de la reina egipcia', '2025-04-01', 'Piedra caliza pintada', 'Escultura Egipcia', 'Escultura', 'Colección Egipcia', 48.0, 19.0, 15.0, 'Museo de Berlín', 29, 'Excelente', 'Egipto', 'Egipto', 'T029', 'ID151', 1, 'Compra', '2025-04-05', 'Museo de Berlín', 90000000.00, 'Historia y contexto arqueológico.', 'Libro CC'),
('REG030', 'Pintura', 'foto30.jpg', 'Cristo Redentor', 'Paul Landowski', '1931', 1931, 1931, 'Escultura monumental en Río de Janeiro', '2025-05-01', 'Hormigón y esteatita', 'Art Decó', 'Escultura', 'Colección Brasilera', 3000.0, 1000.0, 1000.0, 'Museo Nacional de Brasil', 30, 'Buena', 'Brasil', 'Brasil', 'T030', 'ID152', 1, 'Donación', '2025-05-05', 'Gobierno de Brasil', 150000000.00, 'Historia de la construcción.', 'Enciclopedia DD');

INSERT INTO obras_exposiciones (fk_obra, fk_exposicion) VALUES
('REG001', 1), ('REG002', 2), ('REG003', 3), ('REG004', 4), ('REG005', 5),
('REG006', 6), ('REG007', 7), ('REG008', 8), ('REG009', 9), ('REG010', 10),
('REG011', 11), ('REG012', 12), ('REG013', 13), ('REG014', 14), ('REG015', 15),
('REG016', 16), ('REG017', 17), ('REG018', 18), ('REG019', 19), ('REG020', 20),
('REG021', 21), ('REG022', 22), ('REG023', 23), ('REG024', 24), ('REG025', 25),
('REG026', 26), ('REG027', 27), ('REG028', 28), ('REG029', 29), ('REG030', 30);


INSERT INTO usuarios (foto_usuario, usuario, nombre, apellidos, contrasenya, correo_electronico, telefono, rol, estado) VALUES
('foto1.jpg', 'Lector1', 'Ana', 'Martínez', '123', 'ana.martinez@mail.com', '123456789', 'Lector', 'Actiu'),
('foto2.jpg', 'Lector2', 'Luis', 'González', '123', 'luis.gonzalez@mail.com', '987654321', 'Lector', 'Inactiu'),
('foto3.jpg', 'Lector3', 'María', 'López', '123', 'maria.lopez@mail.com', '456123789', 'Lector', 'Actiu'),
('foto4.jpg', 'Lector4', 'Juan', 'Rodríguez', '123', 'juan.rodriguez@mail.com', '321654987', 'Lector', 'Inactiu'),
('foto5.jpg', 'Lector5', 'Carmen', 'Hernández', '123', 'carmen.hernandez@mail.com', '159753468', 'Lector', 'Actiu'),
('foto6.jpg', 'Lector6', 'David', 'Fernández', '123', 'david.fernandez@mail.com', '357159246', 'Lector', 'Inactiu'),
('foto7.jpg', 'Lector7', 'Elena', 'Gómez', '123', 'elena.gomez@mail.com', '753951486', 'Lector', 'Actiu'),
('foto8.jpg', 'Lector8', 'Jorge', 'Díaz', '123', 'jorge.diaz@mail.com', '789123654', 'Lector', 'Inactiu'),
('foto9.jpg', 'Lector9', 'Sara', 'Martín', '123', 'sara.martin@mail.com', '951357852', 'Lector', 'Actiu'),
('foto10.jpg', 'Lector10', 'Pablo', 'Ruiz', '123', 'pablo.ruiz@mail.com', '963852741', 'Lector', 'Inactiu'),
('foto11.jpg', 'Tecnic1', 'Marta', 'Álvarez', '123', 'marta.alvarez@mail.com', '789456123', 'Tècnic', 'Actiu'),
('foto12.jpg', 'Tecnic2', 'Carlos', 'Mendoza', '123', 'carlos.mendoza@mail.com', '159357486', 'Tècnic', 'Inactiu'),
('foto13.jpg', 'Tecnic3', 'Laura', 'Blanco', '123', 'laura.blanco@mail.com', '951753684', 'Tècnic', 'Actiu'),
('foto14.jpg', 'Tecnic4', 'Raúl', 'Moreno', '123', 'raul.moreno@mail.com', '852369741', 'Tècnic', 'Inactiu'),
('foto15.jpg', 'Tecnic5', 'Isabel', 'Santos', '123', 'isabel.santos@mail.com', '753159842', 'Tècnic', 'Actiu'),
('foto16.jpg', 'Tecnic6', 'Antonio', 'Vega', '123', 'antonio.vega@mail.com', '159486273', 'Tècnic', 'Inactiu'),
('foto17.jpg', 'Tecnic7', 'Beatriz', 'Rivas', '123', 'beatriz.rivas@mail.com', '456987123', 'Tècnic', 'Actiu'),
('foto18.jpg', 'Tecnic8', 'Sergio', 'Fuentes', '123', 'sergio.fuentes@mail.com', '789456321', 'Tècnic', 'Inactiu'),
('foto19.jpg', 'Tecnic9', 'Verónica', 'Ortega', '123', 'veronica.ortega@mail.com', '951753486', 'Tècnic', 'Actiu'),
('foto20.jpg', 'Tecnic10', 'Andrés', 'Lara', '123', 'andres.lara@mail.com', '852963741', 'Tècnic', 'Inactiu'),
('foto21.jpg', 'Admin1', 'Sonia', 'Ibáñez', '123', 'sonia.ibanez@mail.com', '357951468', 'Administració', 'Actiu'),
('foto22.jpg', 'Admin2', 'Óscar', 'Reyes', '123', 'oscar.reyes@mail.com', '753159486', 'Administració', 'Inactiu'),
('foto23.jpg', 'Admin3', 'Cristina', 'Navarro', '123', 'cristina.navarro@mail.com', '159753486', 'Administració', 'Actiu'),
('foto24.jpg', 'Admin4', 'Miguel', 'Pérez', '123', 'miguel.perez@mail.com', '951357486', 'Administració', 'Inactiu'),
('foto25.jpg', 'Admin5', 'Inés', 'Romero', '123', 'ines.romero@mail.com', '789951357', 'Administració', 'Actiu'),
('foto26.jpg', 'Admin6', 'Fernando', 'Soler', '123', 'fernando.soler@mail.com', '963741258', 'Administració', 'Inactiu'),
('foto27.jpg', 'Admin7', 'Alicia', 'Giménez', '123', 'alicia.gimenez@mail.com', '852963741', 'Administració', 'Actiu'),
('foto28.jpg', 'Admin8', 'Héctor', 'Castro', '123', 'hector.castro@mail.com', '456321789', 'Administració', 'Inactiu'),
('foto29.jpg', 'Admin9', 'Patricia', 'Linares', '123', 'patricia.linares@mail.com', '753159842', 'Administració', 'Actiu'),
('foto30.jpg', 'Admin10', 'Javier', 'Calvo', '123', 'javier.calvo@mail.com', '951753486', 'Administració', 'Inactiu');


INSERT INTO logs_obras (fk_obra, baja, causa_baja, fecha_baja, persona_autorizada) VALUES
('REG001', 'Exposición Prolongada', 'Desgaste', '2023-01-10', 1),
('REG002', 'Daño en Transporte', 'Impacto', '2023-02-15', 2),
('REG003', 'Restauración Incorrecta', 'Mal Manejo', '2023-03-20', 3),
('REG004', 'Daño por Agua', 'Inundación', '2023-04-25', 4),
('REG005', 'Vandalismo', 'Graffiti', '2023-05-30', 5),
('REG006', 'Exposición Prolongada', 'Luz Solar', '2023-06-05', 6),
('REG007', 'Daño en Almacenaje', 'Humedad', '2023-07-10', 7),
('REG008', 'Desgaste Natural', 'Oxidación', '2023-08-15', 8),
('REG009', 'Manejo Incorrecto', 'Caída', '2023-09-20', 9),
('REG010', 'Accidente Laboral', 'Golpe', '2023-10-25', 10),
('REG011', 'Error en Exposición', 'Temperatura', '2023-11-30', 11),
('REG012', 'Transporte Deficiente', 'Vibración', '2023-12-05', 12),
('REG013', 'Incidente Climático', 'Tormenta', '2024-01-10', 13),
('REG014', 'Fallo de Seguridad', 'Robo', '2024-02-15', 14),
('REG015', 'Error Humano', 'Manejo', '2024-03-20', 15),
('REG016', 'Exposición Inapropiada', 'Calor', '2024-04-25', 16),
('REG017', 'Desgaste Natural', 'Corrosión', '2024-05-30', 17),
('REG018', 'Daño por Plagas', 'Insectos', '2024-06-05', 18),
('REG019', 'Condiciones de Luz', 'Exposición', '2024-07-10', 19),
('REG020', 'Vibración en Transporte', 'Daño', '2024-08-15', 20),
('REG021', 'Error de Almacenaje', 'Mal Estado', '2024-09-20', 21),
('REG022', 'Incidente de Limpieza', 'Producto', '2024-10-25', 22),
('REG023', 'Material Débil', 'Rompimiento', '2024-11-30', 23),
('REG024', 'Exposición Humedad', 'Condensación', '2024-12-05', 24),
('REG025', 'Accidente en Exhibición', 'Destrucción', '2024-12-15', 25),
('REG026', 'Error en Carga', 'Ruptura', '2024-12-20', 26),
('REG027', 'Fallo de Material', 'Degradación', '2025-01-10', 27),
('REG028', 'Problema en Restauración', 'Daño Irreparable', '2025-01-15', 28),
('REG029', 'Condiciones Ambientales', 'Calor Extremo', '2025-02-01', 29),
('REG030', 'Mal Almacenaje', 'Golpe', '2025-02-10', 30);

INSERT INTO restauraciones (fk_obra, comentario_restauracion, nombre_restaurador, fecha_inicio_restauracion, fecha_fin_restauracion) 
VALUES
('REG001', 'Restauración de la pintura por deterioro en los colores y la capa superficial.', 'Ana Pérez', '2024-03-01', '2024-04-15'),
('REG002', 'Restauración de la base de la escultura debido a la corrosión del bronce.', 'Juan Martínez', '2024-04-01', '2024-05-10'),
('REG003', 'Restauración por daños en el lienzo y la capa de pintura debido a la exposición al aire.', 'Laura González', '2024-05-01', '2024-06-10'),
('REG004', 'Recuperación del mármol y restauración de la estructura de la escultura.', 'Carlos Rodríguez', '2024-06-01', '2024-07-15'),
('REG005', 'Restauración de la capa de pintura, eliminando los signos de envejecimiento.', 'Raúl Hernández', '2024-07-01', '2024-08-10'),
('REG006', 'Restauración de grietas y limpieza de la escultura de mármol.', 'Marta Sánchez', '2024-08-01', '2024-09-05'),
('REG007', 'Conservación de la pintura, restauración de colores y detalles en el fondo.', 'José García', '2024-09-01', '2024-10-15'),
('REG008', 'Restauración del mármol y tratamiento contra la humedad.', 'Elena Díaz', '2024-10-01', '2024-11-05'),
('REG009', 'Restauración de la pintura, eliminación de grietas y protección contra la luz.', 'Pedro López', '2024-11-01', '2024-12-10'),
('REG010', 'Restauración y refuerzo de la estructura del mármol.', 'Beatriz Fernández', '2024-12-01', '2025-01-10'),
('REG011', 'Recuperación de la escultura de mármol y refuerzo de la base estructural.', 'Luis Romero', '2025-01-01', '2025-02-15'),
('REG012', 'Restauración del lienzo y preservación de la pintura contra los agentes ambientales.', 'Ricardo Martínez', '2025-02-01', '2025-03-10'),
('REG013', 'Limpieza de la escultura y restauración de la piedra monolítica.', 'Sandra Ruiz', '2025-03-01', '2025-04-10'),
('REG014', 'Restauración del tríptico, reparación de las partes deterioradas por el tiempo.', 'Antonio García', '2025-04-01', '2025-05-20'),
('REG015', 'Restauración del mármol y estabilización de la estructura del monumento.', 'Isabel Castro', '2025-05-01', '2025-06-10'),
('REG016', 'Restauración de la pintura, restauración de los detalles del retrato y protección UV.', 'Javier Pérez', '2025-06-01', '2025-07-10'),
('REG017', 'Restauración de la escultura, reforzamiento de las partes más delicadas.', 'Sofía González', '2025-07-01', '2025-08-15'),
('REG018', 'Restauración de la pintura, tratamiento de conservación y restauración de detalles dorados.', 'David Ruiz', '2025-08-01', '2025-09-10'),
('REG019', 'Restauración de la arcilla y consolidación de la figura.', 'Ana López', '2025-09-01', '2025-10-05'),
('REG020', 'Restauración de la pintura, eliminación de manchas y consolidación del lienzo.', 'Eduardo Romero', '2025-10-01', '2025-11-10'),
('REG021', 'Restauración de la escultura de mármol y tratamiento contra los efectos del tiempo.', 'Felipe Torres', '2025-11-01', '2025-12-05'),
('REG022', 'Restauración de la pintura y restauración de la capa dorada en la obra.', 'Patricia Martínez', '2025-12-01', '2026-01-10'),
('REG023', 'Restauración de la esfinge y limpieza del material original.', 'Cristina Hernández', '2026-01-01', '2026-02-15'),
('REG024', 'Restauración de la pintura y conservación de la capa de óleo original.', 'Gerardo Sánchez', '2026-02-01', '2026-03-10'),
('REG025', 'Restauración de la piedra y protección de los detalles de la escultura.', 'María Fernández', '2026-03-01', '2026-04-05'),
('REG026', 'Restauración del retrato, recuperación de detalles en pan de oro.', 'Oscar Martín', '2026-04-01', '2026-05-15'),
('REG027', 'Recuperación de la estructura del bronce y tratamiento de corrosión.', 'Ricardo Gómez', '2026-05-01', '2026-06-10'),
('REG028', 'Restauración de la pintura y protección contra la humedad del lienzo.', 'Juan Pérez', '2026-06-01', '2026-07-10'),
('REG029', 'Restauración de la escultura de mármol y refuerzo de las uniones estructurales.', 'Laura Jiménez', '2026-07-01', '2026-08-05'),
('REG030', 'Restauración de los detalles en oro y conservación de la pintura original.', 'Antonio Fernández', '2026-08-01', '2026-09-15');


INSERT INTO movimientos (fk_obra, comentario_movimiento, museo, fecha_inicio_movimiento, fecha_fin_movimiento) 
VALUES
('REG001', 'Movimiento de la obra para exhibición en una nueva sala del museo.', 'Museo de Arte Contemporáneo', '2024-03-01', '2024-03-15'),
('REG002', 'Traslado de la escultura para restauración en el taller especializado.', 'Museo Nacional de Escultura', '2024-04-01', '2024-04-10'),
('REG003', 'Movimiento de la pintura hacia una nueva exposición temporal.', 'Museo de Arte Moderno', '2024-05-01', '2024-05-20'),
('REG004', 'Traslado de la escultura para ser exhibida en una galería internacional.', 'Museo Internacional de Escultura', '2024-06-01', '2024-06-15'),
('REG005', 'Movimiento de la obra a una nueva sala del museo debido a una renovación.', 'Museo Nacional de Arte', '2024-07-01', '2024-07-10'),
('REG006', 'Traslado de la escultura para ser restaurada en el taller de conservación.', 'Museo de Arte de Barcelona', '2024-08-01', '2024-08-10'),
('REG007', 'Movimiento de la pintura para ser parte de una nueva muestra de arte contemporáneo.', 'Museo de Arte Contemporáneo de Madrid', '2024-09-01', '2024-09-15'),
('REG008', 'Traslado de la escultura a una exposición al aire libre.', 'Museo de Escultura al Aire Libre', '2024-10-01', '2024-10-20'),
('REG009', 'Movimiento de la obra a una nueva sala de restauración.', 'Museo Nacional de Restauración', '2024-11-01', '2024-11-10'),
('REG010', 'Traslado de la pintura a una muestra de arte en una ciudad extranjera.', 'Museo de Arte Internacional', '2024-12-01', '2024-12-15'),
('REG011', 'Movimiento de la escultura para su conservación en el museo.', 'Museo de Escultura Nacional', '2025-01-01', '2025-01-10'),
('REG012', 'Traslado de la pintura hacia un nuevo espacio para la conservación.', 'Museo de Arte Clásico', '2025-02-01', '2025-02-15'),
('REG013', 'Movimiento de la escultura a un taller especializado para restauración.', 'Museo de Arte Medieval', '2025-03-01', '2025-03-10'),
('REG014', 'Traslado de la pintura a una nueva ubicación debido a la expansión del museo.', 'Museo de Arte Universal', '2025-04-01', '2025-04-10'),
('REG015', 'Movimiento de la escultura a una nueva exposición de arte moderno.', 'Museo de Arte Moderno de Madrid', '2025-05-01', '2025-05-15'),
('REG016', 'Traslado de la pintura a una exposición itinerante de arte contemporáneo.', 'Museo de Arte del Siglo XXI', '2025-06-01', '2025-06-10'),
('REG017', 'Movimiento de la escultura a una muestra internacional de arte contemporáneo.', 'Museo de Escultura Contemporánea', '2025-07-01', '2025-07-10'),
('REG018', 'Traslado de la pintura a una exposición de restauración y conservación.', 'Museo Nacional de Conservación', '2025-08-01', '2025-08-15'),
('REG019', 'Movimiento de la escultura a una exposición al aire libre para su restauración.', 'Museo de Escultura al Aire Libre', '2025-09-01', '2025-09-10'),
('REG020', 'Traslado de la pintura a una galería de arte de prestigio internacional.', 'Museo de Arte Internacional', '2025-10-01', '2025-10-15'),
('REG021', 'Movimiento de la escultura para su conservación y protección en el museo.', 'Museo de Escultura Nacional', '2025-11-01', '2025-11-10'),
('REG022', 'Traslado de la pintura a una exposición sobre arte barroco.', 'Museo Nacional de Arte Barroco', '2025-12-01', '2025-12-10'),
('REG023', 'Movimiento de la escultura a una nueva ubicación para su conservación a largo plazo.', 'Museo de Arte Contemporáneo', '2026-01-01', '2026-01-15'),
('REG024', 'Traslado de la pintura a una nueva muestra sobre arte renacentista.', 'Museo de Arte Renacentista', '2026-02-01', '2026-02-10'),
('REG025', 'Movimiento de la escultura para su conservación y exhibición temporal.', 'Museo de Arte Moderno', '2026-03-01', '2026-03-10'),
('REG026', 'Traslado de la pintura para exhibirla en una nueva galería de arte moderno.', 'Museo de Arte Moderno de Madrid', '2026-04-01', '2026-04-10'),
('REG027', 'Movimiento de la escultura para restauración en un taller especializado.', 'Museo Nacional de Escultura', '2026-05-01', '2026-05-10'),
('REG028', 'Traslado de la pintura para su exhibición en una galería internacional.', 'Museo de Arte Internacional', '2026-06-01', '2026-06-10'),
('REG029', 'Movimiento de la escultura para ser parte de una exposición en el extranjero.', 'Museo Internacional de Arte', '2026-07-01', '2026-07-15'),
('REG030', 'Traslado de la pintura hacia una nueva galería de arte en el centro de la ciudad.', 'Museo Nacional de Arte', '2026-08-01', '2026-08-15');


INSERT INTO copias_seguridad (nombre_copia, descripcion_copia, fecha_copia, fk_creador)
VALUES
('Copia_2024_03', 'Copia de seguridad de las obras de arte del mes de marzo, incluyendo restauraciones y movimientos.', '2024-03-01', 1),
('Copia_2024_04', 'Copia de seguridad de las obras restauradas y los movimientos realizados durante abril.', '2024-04-01', 2),
('Copia_2024_05', 'Copia de seguridad de todas las obras en proceso de restauración en mayo.', '2024-05-01', 3),
('Copia_2024_06', 'Copia de seguridad de la base de datos de obras, incluyendo nuevos movimientos en junio.', '2024-06-01', 4),
('Copia_2024_07', 'Copia de seguridad de todas las restauraciones y movimientos registrados en julio.', '2024-07-01', 5),
('Copia_2024_08', 'Copia de seguridad de las restauraciones realizadas y las obras trasladadas en agosto.', '2024-08-01', 6),
('Copia_2024_09', 'Copia de seguridad de todas las obras en proceso de conservación en septiembre.', '2024-09-01', 7),
('Copia_2024_10', 'Copia de seguridad de las obras restauradas y las que fueron parte de exposiciones temporales en octubre.', '2024-10-01', 8),
('Copia_2024_11', 'Copia de seguridad de las obras restauradas y las exposiciones realizadas en noviembre.', '2024-11-01', 9),
('Copia_2024_12', 'Copia de seguridad de las obras trasladadas para exhibición y restauración en diciembre.', '2024-12-01', 10),
('Copia_2025_01', 'Copia de seguridad de las obras y las actividades realizadas en enero.', '2025-01-01', 11),
('Copia_2025_02', 'Copia de seguridad de las restauraciones de las obras y movimientos en febrero.', '2025-02-01', 12),
('Copia_2025_03', 'Copia de seguridad de la base de datos de obras y sus traslados en marzo.', '2025-03-01', 13),
('Copia_2025_04', 'Copia de seguridad de las obras restauradas y exhibidas en abril.', '2025-04-01', 14),
('Copia_2025_05', 'Copia de seguridad de las obras de arte y su conservación durante mayo.', '2025-05-01', 15),
('Copia_2025_06', 'Copia de seguridad de las exposiciones y restauraciones realizadas en junio.', '2025-06-01', 16),
('Copia_2025_07', 'Copia de seguridad de las obras restauradas y movimientos del mes de julio.', '2025-07-01', 17),
('Copia_2025_08', 'Copia de seguridad de las obras en conservación y restauración en agosto.', '2025-08-01', 18),
('Copia_2025_09', 'Copia de seguridad de los movimientos de las obras y sus restauraciones en septiembre.', '2025-09-01', 19),
('Copia_2025_10', 'Copia de seguridad de las restauraciones y exposiciones realizadas en octubre.', '2025-10-01', 20),
('Copia_2025_11', 'Copia de seguridad de las obras y las actividades realizadas en noviembre.', '2025-11-01', 21),
('Copia_2025_12', 'Copia de seguridad de las obras restauradas y sus movimientos en diciembre.', '2025-12-01', 22),
('Copia_2026_01', 'Copia de seguridad de las obras en exposición y restauración en enero.', '2026-01-01', 23),
('Copia_2026_02', 'Copia de seguridad de las obras que fueron restauradas y exhibidas en febrero.', '2026-02-01', 24),
('Copia_2026_03', 'Copia de seguridad de las obras de arte trasladadas y restauradas en marzo.', '2026-03-01', 25),
('Copia_2026_04', 'Copia de seguridad de las obras restauradas y sus movimientos durante abril.', '2026-04-01', 26),
('Copia_2026_05', 'Copia de seguridad de las obras de arte y sus movimientos durante mayo.', '2026-05-01', 27),
('Copia_2026_06', 'Copia de seguridad de las restauraciones realizadas y las exposiciones de junio.', '2026-06-01', 28),
('Copia_2026_07', 'Copia de seguridad de todas las obras restauradas y los movimientos de julio.', '2026-07-01', 29),
('Copia_2026_08', 'Copia de seguridad de las obras y movimientos del mes de agosto.', '2026-08-01', 30);


INSERT INTO vocabularios (nombre_vocabulario) VALUES
("Classificació genèrica"),
("Material"),
("Codi Getty material"),
("Tècnica"),
("Codi Getty tècnica"),
("Codi autor"),
("Forma d'ingrés"),
("Baixa"),
("Causa de baixa"),
("Estat de conservació"),
("Tipus exposició"),
("Autories");

INSERT INTO campos (nombre_campo, fk_vocabulario) VALUES
-- Forma d'ingrés
('Cessió', (SELECT ID_vocabulario FROM vocabularios WHERE Nombre_vocabulario = "Forma d'ingrés")),
('Comodat', (SELECT ID_vocabulario FROM vocabularios WHERE Nombre_vocabulario = "Forma d'ingrés")),
('Compra', (SELECT ID_vocabulario FROM vocabularios WHERE Nombre_vocabulario = "Forma d'ingrés")),
('Dació', (SELECT ID_vocabulario FROM vocabularios WHERE Nombre_vocabulario = "Forma d'ingrés")),
('Desconeguda', (SELECT ID_vocabulario FROM vocabularios WHERE Nombre_vocabulario = "Forma d'ingrés")),
('Dipòsit', (SELECT ID_vocabulario FROM vocabularios WHERE Nombre_vocabulario = "Forma d'ingrés")),
('Donació', (SELECT ID_vocabulario FROM vocabularios WHERE Nombre_vocabulario = "Forma d'ingrés")),
('Entrega obligatòria', (SELECT ID_vocabulario FROM vocabularios WHERE Nombre_vocabulario = "Forma d'ingrés")),
('Excavació', (SELECT ID_vocabulario FROM vocabularios WHERE Nombre_vocabulario = "Forma d'ingrés")),
('Expropiació', (SELECT ID_vocabulario FROM vocabularios WHERE Nombre_vocabulario = "Forma d'ingrés")),
('Herència', (SELECT ID_vocabulario FROM vocabularios WHERE Nombre_vocabulario = "Forma d'ingrés")),
('Intercanvi', (SELECT ID_vocabulario FROM vocabularios WHERE Nombre_vocabulario = "Forma d'ingrés")),
('Llegat', (SELECT ID_vocabulario FROM vocabularios WHERE Nombre_vocabulario = "Forma d'ingrés")),
('Ocupació', (SELECT ID_vocabulario FROM vocabularios WHERE Nombre_vocabulario = "Forma d'ingrés")),
('Ofrena', (SELECT ID_vocabulario FROM vocabularios WHERE Nombre_vocabulario = "Forma d'ingrés")),
('Permuta', (SELECT ID_vocabulario FROM vocabularios WHERE Nombre_vocabulario = "Forma d'ingrés")),
('Premi', (SELECT ID_vocabulario FROM vocabularios WHERE Nombre_vocabulario = "Forma d'ingrés")),
('Propietat directa', (SELECT ID_vocabulario FROM vocabularios WHERE Nombre_vocabulario = "Forma d'ingrés")),
('Recol·lecció', (SELECT ID_vocabulario FROM vocabularios WHERE Nombre_vocabulario = "Forma d'ingrés")),
('Recuperació', (SELECT ID_vocabulario FROM vocabularios WHERE Nombre_vocabulario = "Forma d'ingrés")),
('Successió interadministrativa', (SELECT ID_vocabulario FROM vocabularios WHERE Nombre_vocabulario = "Forma d'ingrés")),

-- Baixa
('No', (SELECT ID_vocabulario FROM vocabularios WHERE Nombre_vocabulario = "Baixa")),
('Sí', (SELECT ID_vocabulario FROM vocabularios WHERE Nombre_vocabulario = "Baixa")),

-- Causa de baixa
('Confiscació', (SELECT ID_vocabulario FROM vocabularios WHERE Nombre_vocabulario = "Causa de baixa")),
('Destrucció', (SELECT ID_vocabulario FROM vocabularios WHERE Nombre_vocabulario = "Causa de baixa")),
('Estat de conservació molt deficient', (SELECT ID_vocabulario FROM vocabularios WHERE Nombre_vocabulario = "Causa de baixa")),
('Manteniment i restauració onerós', (SELECT ID_vocabulario FROM vocabularios WHERE Nombre_vocabulario = "Causa de baixa")),
('Pèrdua', (SELECT ID_vocabulario FROM vocabularios WHERE Nombre_vocabulario = "Causa de baixa")),
('Robatori', (SELECT ID_vocabulario FROM vocabularios WHERE Nombre_vocabulario = "Causa de baixa")),
('Successió interadministrativa', (SELECT ID_vocabulario FROM vocabularios WHERE Nombre_vocabulario = "Causa de baixa")),
('Valor patrimonial insuficient', (SELECT ID_vocabulario FROM vocabularios WHERE Nombre_vocabulario = "Causa de baixa")),

-- Estat de conservació
('Bo', (SELECT ID_vocabulario FROM vocabularios WHERE Nombre_vocabulario = "Estat de conservació")),
('Dolent', (SELECT ID_vocabulario FROM vocabularios WHERE Nombre_vocabulario = "Estat de conservació")),
('Excel·lent', (SELECT ID_vocabulario FROM vocabularios WHERE Nombre_vocabulario = "Estat de conservació")),
('Indeterminat', (SELECT ID_vocabulario FROM vocabularios WHERE Nombre_vocabulario = "Estat de conservació")),
('Desconeguda', (SELECT ID_vocabulario FROM vocabularios WHERE Nombre_vocabulario = "Estat de conservació")),
('Regular', (SELECT ID_vocabulario FROM vocabularios WHERE Nombre_vocabulario = "Estat de conservació")),

-- Tipus exposició
('Aliena', (SELECT ID_vocabulario FROM vocabularios WHERE Nombre_vocabulario = "Tipus exposició")),
('Pròpia', (SELECT ID_vocabulario FROM vocabularios WHERE Nombre_vocabulario = "Tipus exposició"));