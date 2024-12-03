DROP DATABASE museu_apelles_fenosa;
CREATE DATABASE museu_apelles_fenosa;
USE museu_apelles_fenosa;

CREATE TABLE ubicaciones (
    id_ubicacion INT PRIMARY KEY AUTO_INCREMENT,
    descripcion_ubicacion TEXT NOT NULL,
    id_padre INT,
    comentario_ubicacion TEXT,
    FOREIGN KEY (id_padre) REFERENCES ubicaciones(id_ubicacion) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE exposiciones (
    id_exposicion INT PRIMARY KEY AUTO_INCREMENT,
    texto_exposicion TEXT NOT NULL,
    tipo_exposicion VARCHAR(255),
    lugar_exposicion VARCHAR(255),
    fecha_inicio_exposicion DATE,
    fecha_fin_exposicion DATE
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
    material VARCHAR(255),
    tecnica VARCHAR(255),
    clasificacion_generica VARCHAR(255) NOT NULL,
    coleccion_procedencia VARCHAR(255),
    maxima_altura_cm FLOAT,
    maxima_anchura_cm FLOAT,
    maxima_profundidad_cm FLOAT,
    nombre_museo VARCHAR(255) NOT NULL,
    estado_conservacion VARCHAR(255),
    lugar_ejecucion VARCHAR(255),
    lugar_procedencia VARCHAR(255),
    numero_tiraje VARCHAR(255),
    otros_numeros_identificacion VARCHAR(255),
    numero_ejemplares INT,
    forma_ingreso VARCHAR(255),
    fecha_ingreso DATE NOT NULL,
    fuente_ingreso VARCHAR(255),
    valoracion_economica DECIMAL(11,2),
    historia_objeto TEXT,
    bibliografia TEXT
);

CREATE TABLE obras_ubicaciones (
    id_obra_ubicacion INT PRIMARY KEY AUTO_INCREMENT,
    fk_obra VARCHAR(255),
    fk_ubicacion INT,
    fecha_inicio_ubicacion DATE,
    fecha_fin_ubicacion DATE,
    FOREIGN KEY (fk_obra) REFERENCES obras(numero_registro) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (fk_ubicacion) REFERENCES ubicaciones(id_ubicacion) ON UPDATE CASCADE
);

CREATE TABLE obras_exposiciones (
    id_obra_exposicion INT PRIMARY KEY AUTO_INCREMENT,
    fk_obra VARCHAR(255),
    fk_exposicion INT,
    FOREIGN KEY (fk_obra) REFERENCES obras(numero_registro) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (fk_exposicion) REFERENCES exposiciones(id_exposicion) ON DELETE CASCADE ON UPDATE CASCADE
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
    FOREIGN KEY (fk_obra) REFERENCES obras(numero_registro) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (persona_autorizada) REFERENCES usuarios(id_usuario) ON UPDATE CASCADE
);

CREATE TABLE restauraciones (
    id_restauracion INT PRIMARY KEY AUTO_INCREMENT,
    comentario_restauracion TEXT NOT NULL,
    nombre_restaurador VARCHAR(255) NOT NULL,
    fecha_inicio_restauracion DATE NOT NULL,
    fecha_fin_restauracion DATE NOT NULL
);

CREATE TABLE obras_restauraciones (
    id_obra_restauracion INT PRIMARY KEY AUTO_INCREMENT,
    fk_obra VARCHAR(255),
    fk_restauracion INT,
    FOREIGN KEY (fk_obra) REFERENCES obras(numero_registro) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (fk_restauracion) REFERENCES restauraciones(id_restauracion) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE movimientos (
    id_movimiento INT PRIMARY KEY AUTO_INCREMENT,
    comentario_movimiento TEXT NOT NULL,
    museo VARCHAR(255) NOT NULL,
    fecha_inicio_movimiento DATE NOT NULL,
    fecha_fin_movimiento DATE NOT NULL
);

CREATE TABLE obras_movimientos (
    id_obra_movimiento INT PRIMARY KEY AUTO_INCREMENT,
    fk_obra VARCHAR(255),
    fk_movimiento INT,
    FOREIGN KEY (fk_obra) REFERENCES obras(numero_registro) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (fk_movimiento) REFERENCES movimientos(id_movimiento) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE vocabularios (
    id_vocabulario INT AUTO_INCREMENT PRIMARY KEY,
    nombre_vocabulario VARCHAR(255) NOT NULL UNIQUE
);

CREATE TABLE campos (
    id_campo INT AUTO_INCREMENT PRIMARY KEY,
    nombre_campo VARCHAR(255) NOT NULL,
    fk_vocabulario INT NOT NULL,
    FOREIGN KEY (fk_vocabulario) REFERENCES vocabularios(id_vocabulario) ON UPDATE CASCADE
);

CREATE TABLE copias_seguridad (
    id_copia INT PRIMARY KEY AUTO_INCREMENT,
    nombre_copia VARCHAR(255) NOT NULL,
    descripcion_copia TEXT,
    fecha_copia VARCHAR(255) NOT NULL,
    fk_creador INT NOT NULL,
    FOREIGN KEY (fk_creador) REFERENCES usuarios(id_usuario) ON UPDATE CASCADE
);

INSERT INTO ubicaciones (descripcion_ubicacion, id_padre, comentario_ubicacion) VALUES
('Sala Principal', NULL, 'Zona central del museo.'),
('Galería 1', 1, 'Primera galería con pinturas clásicas.'),
('Galería 2', 1, 'Galería dedicada al arte moderno.'),
('Galería 3', 1, 'Galería de arte contemporáneo.'),
('Almacén General', NULL, 'Zona de almacenamiento principal.'),
('Almacén 1', 5, 'Área para esculturas.'),
('Almacén 2', 5, 'Área para objetos históricos.'),
('Sala de Restauración', NULL, 'Espacio para trabajos de restauración.'),
('Sala de Investigación', NULL, 'Zona de estudio e investigación.'),
('Oficina Principal', NULL, 'Oficina de gestión y administración.'),
('Biblioteca', NULL, 'Área de consulta bibliográfica.'),
('Archivo General', NULL, 'Zona para documentos históricos.'),
('Sala de Exposición Temporal 1', 1, 'Espacio dedicado a exposiciones temporales.'),
('Sala de Exposición Temporal 2', 1, 'Segunda sala para muestras temporales.'),
('Depósito 1', 5, 'Depósito para obras en proceso de registro.'),
('Depósito 2', 5, 'Depósito para obras en proceso de restauración.'),
('Zona Técnica', NULL, 'Área para mantenimiento técnico.'),
('Zona de Carga y Descarga', NULL, 'Espacio para recepción y envío de obras.'),
('Patio Interior', NULL, 'Zona de descanso al aire libre.'),
('Sala de Conferencias', NULL, 'Espacio para charlas y eventos.'),
('Sala de Esculturas Clásicas', 2, 'Exposición de esculturas antiguas.'),
('Sala de Pinturas Renacentistas', 2, 'Exposición de arte del Renacimiento.'),
('Sala de Arte Abstracto', 3, 'Exposición de arte abstracto moderno.'),
('Sala de Arte Pop', 3, 'Exposición de arte pop.'),
('Sala de Arte Contemporáneo', 4, 'Obras de los últimos 20 años.'),
('Almacén Secundario', NULL, 'Almacén adicional para obras.'),
('Depósito de Seguridad', 26, 'Zona para obras de alto valor.'),
('Laboratorio de Análisis', 8, 'Zona para análisis de materiales y técnicas.'),
('Taller de Restauración', 8, 'Espacio para trabajos técnicos en las obras.'),
('Vestíbulo', 1, 'Entrada principal del museo.');

INSERT INTO exposiciones (texto_exposicion, tipo_exposicion, lugar_exposicion, fecha_inicio_exposicion, fecha_fin_exposicion) VALUES
('Exposición Renacimiento', 'Pintura', 'Galería 1', '2024-01-10', '2024-03-15'),
('Arte Moderno: Formas y Colores', 'Escultura', 'Galería 2', '2024-03-20', '2024-06-01'),
('Arte Contemporáneo Global', 'Mixta', 'Galería 3', '2024-06-10', '2024-08-30'),
('Esculturas Clásicas', 'Escultura', 'Sala de Esculturas Clásicas', '2024-02-01', '2024-04-15'),
('Pinturas del Renacimiento', 'Pintura', 'Sala de Pinturas Renacentistas', '2024-04-20', '2024-06-30'),
('El Arte Abstracto', 'Pintura', 'Sala de Arte Abstracto', '2024-07-01', '2024-09-15'),
('Pop Art: Una Revolución Visual', 'Mixta', 'Sala de Arte Pop', '2024-09-20', '2024-11-30'),
('Arte Contemporáneo del Siglo XXI', 'Mixta', 'Sala de Arte Contemporáneo', '2024-10-01', '2024-12-31'),
('Obras Maestras del Siglo XIX', 'Pintura', 'Galería 1', '2024-01-15', '2024-03-30'),
('Esculturas Modernas', 'Escultura', 'Galería 2', '2024-05-01', '2024-07-15'),
('Arte Efímero', 'Mixta', 'Sala de Exposición Temporal 1', '2024-07-20', '2024-09-30'),
('El Renacimiento Italiano', 'Pintura', 'Galería 1', '2024-02-01', '2024-03-31'),
('Vanguardias Europeas', 'Pintura', 'Sala de Arte Abstracto', '2024-03-01', '2024-05-15'),
('Arte Latinoamericano', 'Mixta', 'Sala de Exposición Temporal 2', '2024-05-20', '2024-07-31'),
('Exposición de Joyería Antigua', 'Otros', 'Galería 2', '2024-06-01', '2024-08-15'),
('Fotografía Moderna', 'Fotografía', 'Galería 3', '2024-06-20', '2024-09-10'),
('Arquitectura Contemporánea', 'Mixta', 'Galería 3', '2024-10-01', '2024-12-10'),
('Arte Asiático Tradicional', 'Mixta', 'Galería 1', '2024-01-01', '2024-02-28'),
('Grandes Maestros del Siglo XVIII', 'Pintura', 'Galería 1', '2024-03-10', '2024-05-10'),
('El Cubismo', 'Pintura', 'Sala de Arte Abstracto', '2024-04-01', '2024-06-30'),
('Arte Conceptual', 'Mixta', 'Sala de Arte Contemporáneo', '2024-05-15', '2024-08-01'),
('Escultura Africana', 'Escultura', 'Galería 2', '2024-08-10', '2024-10-20'),
('Fotografía Contemporánea', 'Fotografía', 'Galería 3', '2024-10-15', '2024-12-31'),
('Arte Islámico', 'Mixta', 'Galería 1', '2024-01-05', '2024-03-05'),
('El Impresionismo', 'Pintura', 'Galería 1', '2024-03-20', '2024-06-10'),
('Diseño Industrial', 'Otros', 'Sala de Exposición Temporal 1', '2024-06-15', '2024-08-31'),
('Arte de la Prehistoria', 'Mixta', 'Sala de Exposición Temporal 2', '2024-09-01', '2024-11-15'),
('Arte Egipcio', 'Mixta', 'Galería 1', '2024-02-15', '2024-04-10'),
('Esculturas Griegas', 'Escultura', 'Sala de Esculturas Clásicas', '2024-03-01', '2024-05-15'),
('El Barroco en Europa', 'Pintura', 'Galería 1', '2024-04-01', '2024-06-15');

INSERT INTO obras VALUES
('R00001', 'Escultura', 'images/iconDefaultObra.png', 'El Pensador', 'Auguste Rodin', '1902', 1902, 1902, 'Escultura en bronce representando a un hombre pensativo.',
 '2024-01-10', 'Bronce', 'Moldeo', 'Escultura', 'Colección Rodin', 180.0, 100.0, 90.0, 'Museo Central', 'Bueno', 'París', 'París', NULL, NULL, 1, 'Donación', '2023-12-01', 'Familia Rodin', 250000.00, 'Icono del pensamiento humano.', 'N/A'),
('R00002', 'Pintura', 'images/iconDefaultObra.png', 'La Gioconda', 'Leonardo da Vinci', '1503', 1503, 1519, 'Retrato renacentista de una mujer con una expresión enigmática.',
 '2024-01-15', 'Óleo sobre tabla', 'Óleo', 'Pintura', 'Colección Louvre', 77.0, 53.0, NULL, 'Museo Central', 'Excelente', 'Florencia', 'Florencia', NULL, NULL, 1, 'Compra', '2023-11-20', 'Gobierno Italiano', 800000000.00, 'Considerada la pintura más famosa del mundo.', 'N/A'),
('R00003', 'Escultura', 'images/iconDefaultObra.png', 'David', 'Miguel Ángel', '1501', 1501, 1504, 'Representación del rey David antes de enfrentarse a Goliat.',
 '2024-01-20', 'Mármol', 'Tallado', 'Escultura', 'Colección Florencia', 517.0, 199.0, 116.0, 'Museo Central', 'Bueno', 'Florencia', 'Florencia', NULL, NULL, 1, 'Cesión', '2023-12-15', 'Museo de Florencia', 10000000.00, 'Obra maestra del Renacimiento italiano.', 'N/A'),
('R00004', 'Pintura', 'images/iconDefaultObra.png', 'Las Meninas', 'Diego Velázquez', '1656', 1656, 1656, 'Representación de la infanta Margarita y su séquito.',
 '2024-01-25', 'Óleo sobre lienzo', 'Óleo', 'Pintura', 'Colección Española', 318.0, 276.0, NULL, 'Museo Central', 'Bueno', 'Madrid', 'Madrid', NULL, NULL, 1, 'Compra', '2023-10-05', 'Realeza Española', 500000000.00, 'Obra icónica del Siglo de Oro español.', 'N/A'),
('R00005', 'Escultura', 'images/iconDefaultObra.png', 'La Victoria de Samotracia', 'Autor Desconocido', 'Siglo II a.C.', -200, -100, 'Representación de la diosa griega Niké en movimiento.',
 '2024-02-01', 'Mármol', 'Tallado', 'Escultura', 'Colección Louvre', 245.0, 165.0, 80.0, 'Museo Central', 'Bueno', 'Samotracia', 'Samotracia', NULL, NULL, 1, 'Donación', '2023-11-30', 'Colección Privada', 3000000.00, 'Uno de los ejemplos más importantes del arte helenístico.', 'N/A'),
('R00006', 'Pintura', 'images/iconDefaultObra.png', 'El Grito', 'Edvard Munch', '1893', 1893, 1893, 'Obra expresionista que representa una figura gritando con un fondo de cielo ardiente.',
 '2024-02-05', 'Óleo, temple y pastel sobre cartón', 'Óleo y temple', 'Pintura', 'Colección Nacional de Noruega', 91.0, 73.5, NULL, 'Museo Central', 'Bueno', 'Oslo', 'Oslo', NULL, NULL, 1, 'Cesión', '2023-11-10', 'Museo de Oslo', 120000000.00, 'Una de las pinturas más reconocidas del expresionismo.', 'N/A'),
('R00007', 'Escultura', 'images/iconDefaultObra.png', 'La Pietà', 'Miguel Ángel', '1499', 1498, 1499, 'Escultura de mármol que representa a la Virgen María sosteniendo el cuerpo de Cristo.',
 '2024-02-10', 'Mármol', 'Tallado', 'Escultura', 'Colección Vaticana', 174.0, 195.0, 69.0, 'Museo Central', 'Excelente', 'Roma', 'Roma', NULL, NULL, 1, 'Compra', '2023-12-20', 'Museo Vaticano', 7500000.00, 'Ejemplo sublime de escultura renacentista.', 'N/A'),
('R00008', 'Pintura', 'images/iconDefaultObra.png', 'El Nacimiento de Venus', 'Sandro Botticelli', '1485', 1485, 1486, 'Representación mitológica del nacimiento de Venus en una concha.',
 '2024-02-15', 'Temple sobre lienzo', 'Temple', 'Pintura', 'Colección Florencia', 278.5, 172.5, NULL, 'Museo Central', 'Bueno', 'Florencia', 'Florencia', NULL, NULL, 1, 'Donación', '2023-11-25', 'Colección Medici', 60000000.00, 'Obra destacada del Renacimiento italiano.', 'N/A'),
('R00009', 'Escultura', 'images/iconDefaultObra.png', 'Moái', 'Cultura Rapa Nui', 'Siglo XIII', 1200, 1300, 'Estatua monolítica tallada en piedra volcánica representando ancestros.',
 '2024-02-20', 'Toba volcánica', 'Tallado', 'Escultura', 'Isla de Pascua', 400.0, 150.0, 120.0, 'Museo Central', 'Bueno', 'Isla de Pascua', 'Isla de Pascua', NULL, NULL, 1, 'Cesión', '2023-12-10', 'Gobierno Chileno', 2000000.00, 'Símbolo de la cultura Rapa Nui.', 'N/A'),
('R00010', 'Pintura', 'images/iconDefaultObra.png', 'La Noche Estrellada', 'Vincent van Gogh', '1889', 1889, 1889, 'Vista nocturna imaginaria con espirales y una iglesia.',
 '2024-03-01', 'Óleo sobre lienzo', 'Óleo', 'Pintura', 'Colección Holandesa', 73.7, 92.1, NULL, 'Museo Central', 'Bueno', 'Saint-Rémy', 'Saint-Rémy', NULL, NULL, 1, 'Donación', '2023-10-15', 'Fundación Van Gogh', 120000000.00, 'Icono del postimpresionismo.', 'N/A'),
('R00011', 'Escultura', 'images/iconDefaultObra.png', 'Venus de Milo', 'Autor Desconocido', 'Siglo II a.C.', -130, -100, 'Representación idealizada de la diosa griega Afrodita.',
 '2024-03-05', 'Mármol', 'Tallado', 'Escultura', 'Colección Louvre', 203.0, 72.0, 60.0, 'Museo Central', 'Bueno', 'Milo', 'Milo', NULL, NULL, 1, 'Cesión', '2023-11-05', 'Museo de Louvre', 15000000.00, 'Ejemplo icónico del arte griego clásico.', 'N/A'),
('R00012', 'Pintura', 'images/iconDefaultObra.png', 'La Persistencia de la Memoria', 'Salvador Dalí', '1931', 1931, 1931, 'Obra surrealista que muestra relojes blandos derretidos en un paisaje desértico.',
 '2024-03-10', 'Óleo sobre lienzo', 'Óleo', 'Pintura', 'Colección Dalí', 24.0, 33.0, NULL, 'Museo Central', 'Excelente', 'Figueras', 'Figueras', NULL, NULL, 1, 'Compra', '2023-12-01', 'Fundación Dalí', 45000000.00, 'Símbolo de la relatividad del tiempo.', 'N/A'),
('R00013', 'Escultura', 'images/iconDefaultObra.png', 'El Discóbolo', 'Mirón de Eleuteras', 'Siglo V a.C.', -460, -450, 'Escultura griega que representa a un atleta lanzando un disco.',
 '2024-03-15', 'Mármol', 'Tallado', 'Escultura', 'Colección Británica', 155.0, 70.0, 70.0, 'Museo Central', 'Bueno', 'Atenas', 'Atenas', NULL, NULL, 1, 'Cesión', '2023-11-10', 'Museo Británico', 9000000.00, 'Ejemplo destacado del arte griego clásico.', 'N/A'),
('R00014', 'Pintura', 'images/iconDefaultObra.png', 'El Jardín de las Delicias', 'El Bosco', '1500', 1500, 1505, 'Tríptico que representa el Edén, la humanidad y el infierno.',
 '2024-03-20', 'Óleo sobre tabla', 'Óleo', 'Pintura', 'Colección Flamenca', 220.0, 389.0, NULL, 'Museo Central', 'Bueno', 'Bolduque', 'Bolduque', NULL, NULL, 1, 'Compra', '2023-11-25', 'Fundación Flamenca', 75000000.00, 'Obra maestra del arte flamenco.', 'N/A'),
('R00015', 'Escultura', 'images/iconDefaultObra.png', 'El Ángel Caído', 'Ricardo Bellver', '1877', 1877, 1878, 'Escultura de bronce que representa la caída de Lucifer.',
 '2024-03-25', 'Bronce', 'Moldeo', 'Escultura', 'Colección Española', 265.0, 100.0, 100.0, 'Museo Central', 'Bueno', 'Madrid', 'Madrid', NULL, NULL, 1, 'Donación', '2023-12-10', 'Ayuntamiento de Madrid', 3000000.00, 'Ejemplo de la escultura española del siglo XIX.', 'N/A'),
('R00016', 'Pintura', 'images/iconDefaultObra.png', 'Guernica', 'Pablo Picasso', '1937', 1937, 1937, 'Pintura que representa los horrores del bombardeo de Guernica.',
 '2024-03-30', 'Óleo sobre lienzo', 'Óleo', 'Pintura', 'Colección Reina Sofía', 349.3, 776.6, NULL, 'Museo Central', 'Bueno', 'París', 'Guernica', NULL, NULL, 1, 'Cesión', '2023-12-15', 'Gobierno Español', 200000000.00, 'Símbolo universal del pacifismo.', 'N/A'),
('R00017', 'Escultura', 'images/iconDefaultObra.png', 'El Coloso de Rodas', 'Cares de Lindos', '292 a.C.', -292, -280, 'Estatua gigante del dios griego Helios en la isla de Rodas.',
 '2024-04-01', 'Bronce', 'Fundición', 'Escultura', 'Colección Helénica', 30000.0, 1000.0, 1000.0, 'Museo Central', 'Bueno', 'Rodas', 'Rodas', NULL, NULL, 1, 'Donación', '2023-11-10', 'Fundación Helénica', 150000000.00, 'Una de las siete maravillas del mundo antiguo.', 'N/A'),
('R00018', 'Pintura', 'images/iconDefaultObra.png', 'La Ronda de Noche', 'Rembrandt', '1642', 1642, 1642, 'Pintura que muestra a una compañía de guardias cívicos.',
 '2024-04-05', 'Óleo sobre lienzo', 'Óleo', 'Pintura', 'Colección Holandesa', 379.5, 453.5, NULL, 'Museo Central', 'Bueno', 'Ámsterdam', 'Ámsterdam', NULL, NULL, 1, 'Compra', '2023-12-05', 'Fundación Holandesa', 140000000.00, 'Obra maestra del barroco holandés.', 'N/A'),
('R00019', 'Escultura', 'images/iconDefaultObra.png', 'El Torso de Belvedere', 'Apolonio de Atenas', 'Siglo I a.C.', -100, -50, 'Fragmento de una estatua masculina en mármol.',
 '2024-04-10', 'Mármol', 'Tallado', 'Escultura', 'Colección Vaticana', 159.0, 60.0, 60.0, 'Museo Central', 'Bueno', 'Roma', 'Roma', NULL, NULL, 1, 'Cesión', '2023-12-20', 'Museo Vaticano', 4500000.00, 'Ejemplo clave del arte clásico.', 'N/A'),
('R00020', 'Escultura', 'images/iconDefaultObra.png', 'Cabeza de Guerrero Mexicano', 'Autor Anónimo', 'Siglo XVI', 1500, 1600, 'Cabeza esculpida en piedra que representa a un líder azteca.',
 '2024-06-01', 'Piedra', 'Tallado', 'Escultura', 'Colección Azteca', 75.0, 55.0, NULL, 'Museo Central', 'Bueno', 'Tenochtitlan', 'Tenochtitlan', NULL, NULL, 1, 'Compra', '2023-12-01', 'Museo de México', 800000.00, 'Un valioso objeto azteca.', 'N/A'),
('R00021', 'Pintura', 'images/iconDefaultObra.png', 'El Árbol de la Vida', 'Gustav Klimt', '1909', 1909, 1909, 'Obra modernista que simboliza la vida y la creación.',
 '2024-06-05', 'Óleo sobre lienzo', 'Óleo', 'Pintura', 'Colección Austriaca', 180.0, 180.0, NULL, 'Museo Central', 'Bueno', 'Viena', 'Viena', NULL, NULL, 1, 'Cesión', '2023-12-10', 'Fundación Vienesa', 12000000.00, 'Un símbolo de la vida y la creación humana.', 'N/A'),
('R00022', 'Escultura', 'images/iconDefaultObra.png', 'El Pensador', 'Auguste Rodin', '1902', 1902, 1902, 'Escultura que representa a un hombre reflexionando sobre el destino humano.',
 '2024-06-10', 'Bronce', 'Fundición', 'Escultura', 'Colección Rodin', 186.0, 98.0, 140.0, 'Museo Central', 'Bueno', 'París', 'París', NULL, NULL, 1, 'Compra', '2023-12-15', 'Museo Rodin', 25000000.00, 'Un emblema del arte moderno.', 'N/A'),
('R00023', 'Pintura', 'images/iconDefaultObra.png', 'La Creación de Adán', 'Miguel Ángel', '1512', 1512, 1512, 'Pintura del techo de la Capilla Sixtina que representa la creación de Adán.',
 '2024-06-15', 'Óleo sobre yeso', 'Fresco', 'Pintura', 'Colección Vaticana', 280.0, 570.0, NULL, 'Museo Central', 'Excelente', 'Roma', 'Roma', NULL, NULL, 1, 'Cesión', '2023-12-20', 'Museo Vaticano', 80000000.00, 'Icono del Renacimiento Italiano.', 'N/A'),
('R00024', 'Escultura', 'images/iconDefaultObra.png', 'La Victoria de Samotracia', 'Autor Desconocido', 'Siglo II a.C.', -190, -160, 'Escultura en mármol que representa a la diosa Nike de Samotracia.',
 '2024-06-20', 'Mármol', 'Tallado', 'Escultura', 'Colección Helénica', 245.0, 200.0, NULL, 'Museo Central', 'Bueno', 'Samotracia', 'Samotracia', NULL, NULL, 1, 'Cesión', '2023-12-25', 'Museo del Louvre', 120000000.00, 'Una de las esculturas más admiradas del arte clásico griego.', 'N/A'),
('R00025', 'Pintura', 'images/iconDefaultObra.png', 'El Nacimiento de Venus', 'Sandro Botticelli', '1486', 1486, 1486, 'Pintura que muestra el nacimiento de Venus sobre una concha marina.',
 '2024-06-25', 'Óleo sobre lienzo', 'Óleo', 'Pintura', 'Colección Italiana', 172.0, 278.0, NULL, 'Museo Central', 'Bueno', 'Florencia', 'Florencia', NULL, NULL, 1, 'Compra', '2023-12-30', 'Galería Uffizi', 70000000.00, 'Un ícono del Renacimiento italiano.', 'N/A'),
('R00026', 'Escultura', 'images/iconDefaultObra.png', 'La Piedad', 'Miguel Ángel', '1499', 1498, 1499, 'Escultura de mármol que representa a la Virgen María con el cuerpo de Jesús muerto.',
 '2024-07-01', 'Mármol', 'Tallado', 'Escultura', 'Colección Vaticana', 174.0, 195.0, 72.0, 'Museo Central', 'Excelente', 'Roma', 'Roma', NULL, NULL, 1, 'Cesión', '2024-01-05', 'Museo Vaticano', 90000000.00, 'Una de las esculturas más famosas del Renacimiento.', 'N/A'),
('R00027', 'Pintura', 'images/iconDefaultObra.png', 'Las Meninas', 'Diego Velázquez', '1656', 1656, 1656, 'Retrato de la corte española que muestra a la Infanta Margarita rodeada de sus damas de honor.',
 '2024-07-05', 'Óleo sobre lienzo', 'Óleo', 'Pintura', 'Colección Española', 318.0, 276.0, NULL, 'Museo Central', 'Excelente', 'Madrid', 'Madrid', NULL, NULL, 1, 'Compra', '2024-01-10', 'Museo del Prado', 70000000.00, 'Una obra maestra del Barroco Español.', 'N/A'),
('R00028', 'Escultura', 'images/iconDefaultObra.png', 'La Escalera de Jacob', 'Salvador Dalí', '1945', 1945, 1945, 'Escultura surrealista que representa una escalera que se convierte en una figura humana.',
 '2024-07-10', 'Madera y bronce', 'Escultura', 'Escultura', 'Colección Surrealista', 150.0, 200.0, 120.0, 'Museo Central', 'Bueno', 'Figueras', 'Figueras', NULL, NULL, 1, 'Compra', '2024-01-15', 'Museo Dalí', 18000000.00, 'Una de las esculturas más interesantes de Dalí.', 'N/A'),
('R00029', 'Pintura', 'images/iconDefaultObra.png', 'La Primavera', 'Sandro Botticelli', '1482', 1482, 1482, 'Pintura que representa la alegoría de la primavera y la belleza femenina.',
 '2024-07-15', 'Óleo sobre lienzo', 'Óleo', 'Pintura', 'Colección Italiana', 203.0, 314.0, NULL, 'Museo Central', 'Excelente', 'Florencia', 'Florencia', NULL, NULL, 1, 'Compra', '2024-01-20', 'Galería Uffizi', 75000000.00, 'Símbolo del Renacimiento italiano.', 'N/A'),
('R00030', 'Escultura', 'images/iconDefaultObra.png', 'Cabeza Colosal de los Olmecas', 'Autor Desconocido', 'Siglo XIII a.C.', -1300, -1200, 'Monolito de basalto representando el rostro de un gobernante olmeca.',
 '2024-07-20', 'Basalto', 'Tallado', 'Escultura', 'Colección Mesoamericana', 300.0, 200.0, 250.0, 'Museo Central', 'Bueno', 'Veracruz', 'Veracruz', NULL, NULL, 1, 'Compra', '2024-01-25', 'Arqueología Mexicana', 2000000.00, 'Una de las mayores reliquias olmecas conocidas.', 'N/A');


INSERT INTO obras_ubicaciones (
    fk_obra, fk_ubicacion, fecha_inicio_ubicacion, fecha_fin_ubicacion
) VALUES
('R00001', 1, '2024-01-01', '2024-06-01'),
('R00002', 2, '2024-01-15', '2024-06-15'),
('R00003', 3, '2024-02-01', '2024-07-01'),
('R00004', 4, '2024-02-10', '2024-07-10'),
('R00005', 5, '2024-03-01', '2024-08-01'),
('R00006', 6, '2024-03-15', '2024-08-15'),
('R00007', 7, '2024-04-01', '2024-09-01'),
('R00008', 8, '2024-04-10', '2024-09-10'),
('R00009', 9, '2024-05-01', '2024-10-01'),
('R00010', 10, '2024-05-15', '2024-10-15'),
('R00011', 11, '2024-06-01', '2024-11-01'),
('R00012', 12, '2024-06-10', '2024-11-10'),
('R00013', 13, '2024-07-01', '2024-12-01'),
('R00014', 14, '2024-07-15', '2024-12-15'),
('R00015', 15, '2024-08-01', '2025-01-01'),
('R00016', 16, '2024-08-10', '2025-01-10'),
('R00017', 17, '2024-09-01', '2025-02-01'),
('R00018', 18, '2024-09-15', '2025-02-15'),
('R00019', 19, '2024-10-01', '2025-03-01'),
('R00020', 20, '2024-10-10', '2025-03-10'),
('R00021', 21, '2024-11-01', '2025-04-01'),
('R00022', 22, '2024-11-15', '2025-04-15'),
('R00023', 23, '2024-12-01', '2025-05-01'),
('R00024', 24, '2024-12-10', '2025-05-10'),
('R00025', 25, '2025-01-01', '2025-06-01'),
('R00026', 26, '2025-01-10', '2025-06-10'),
('R00027', 27, '2025-02-01', '2025-07-01'),
('R00028', 28, '2025-02-10', '2025-07-10'),
('R00029', 29, '2025-03-01', '2025-08-01'),
('R00030', 30, '2025-03-15', '2025-08-15');


INSERT INTO obras_exposiciones (
    fk_obra, fk_exposicion
) VALUES
('R00001', 1),
('R00002', 2),
('R00003', 3),
('R00004', 4),
('R00005', 5),
('R00006', 6),
('R00007', 7),
('R00008', 8),
('R00009', 9),
('R00010', 10),
('R00011', 11),
('R00012', 12),
('R00013', 13),
('R00014', 14),
('R00015', 15),
('R00016', 16),
('R00017', 17),
('R00018', 18),
('R00019', 19),
('R00020', 20),
('R00021', 21),
('R00022', 22),
('R00023', 23),
('R00024', 24),
('R00025', 25),
('R00026', 26),
('R00027', 27),
('R00028', 28),
('R00029', 29),
('R00030', 30);


INSERT INTO usuarios (
    foto_usuario, usuario, nombre, apellidos, contrasenya, correo_electronico, telefono, rol, estado
) VALUES
('images/iconDefaultUser.png', 'lector1', 'Juan', 'Pérez', '123', 'juan.perez@correo.com', '1234567890', 'Lector', 'Actiu'),
('images/iconDefaultUser.png', 'lector2', 'María', 'Gómez', '123', 'maria.gomez@correo.com', '1234567891', 'Lector', 'Inactiu'),
('images/iconDefaultUser.png', 'lector3', 'Carlos', 'Martínez', '123', 'carlos.martinez@correo.com', '1234567892', 'Lector', 'Actiu'),
('images/iconDefaultUser.png', 'lector4', 'Laura', 'Rodríguez', '123', 'laura.rodriguez@correo.com', '1234567893', 'Lector', 'Inactiu'),
('images/iconDefaultUser.png', 'lector5', 'José', 'López', '123', 'jose.lopez@correo.com', '1234567894', 'Lector', 'Actiu'),
('images/iconDefaultUser.png', 'lector6', 'Ana', 'Hernández', '123', 'ana.hernandez@correo.com', '1234567895', 'Lector', 'Actiu'),
('images/iconDefaultUser.png', 'lector7', 'Miguel', 'García', '123', 'miguel.garcia@correo.com', '1234567896', 'Lector', 'Inactiu'),
('images/iconDefaultUser.png', 'lector8', 'Patricia', 'Martín', '123', 'patricia.martin@correo.com', '1234567897', 'Lector', 'Actiu'),
('images/iconDefaultUser.png', 'lector9', 'Luis', 'Sánchez', '123', 'luis.sanchez@correo.com', '1234567898', 'Lector', 'Inactiu'),
('images/iconDefaultUser.png', 'lector10', 'Sara', 'Álvarez', '123', 'sara.alvarez@correo.com', '1234567899', 'Lector', 'Actiu'),
('images/iconDefaultUser.png', 'tecnic1', 'José Antonio', 'Fernández', '123', 'joseantonio.fernandez@correo.com', '1234567800', 'Tècnic', 'Actiu'),
('images/iconDefaultUser.png', 'tecnic2', 'Raúl', 'González', '123', 'raul.gonzalez@correo.com', '1234567801', 'Tècnic', 'Inactiu'),
('images/iconDefaultUser.png', 'tecnic3', 'Carmen', 'Jiménez', '123', 'carmen.jimenez@correo.com', '1234567802', 'Tècnic', 'Actiu'),
('images/iconDefaultUser.png', 'tecnic4', 'Alberto', 'Ruiz', '123', 'alberto.ruiz@correo.com', '1234567803', 'Tècnic', 'Actiu'),
('images/iconDefaultUser.png', 'tecnic5', 'Beatriz', 'Torres', '123', 'beatriz.torres@correo.com', '1234567804', 'Tècnic', 'Inactiu'),
('images/iconDefaultUser.png', 'tecnic6', 'Sergio', 'Ramírez', '123', 'sergio.ramirez@correo.com', '1234567805', 'Tècnic', 'Actiu'),
('images/iconDefaultUser.png', 'tecnic7', 'Marta', 'Vázquez', '123', 'marta.vazquez@correo.com', '1234567806', 'Tècnic', 'Inactiu'),
('images/iconDefaultUser.png', 'tecnic8', 'Fernando', 'Castro', '123', 'fernando.castro@correo.com', '1234567807', 'Tècnic', 'Actiu'),
('images/iconDefaultUser.png', 'tecnic9', 'Rosa', 'Morales', '123', 'rosa.morales@correo.com', '1234567808', 'Tècnic', 'Inactiu'),
('images/iconDefaultUser.png', 'tecnic10', 'David', 'Pascual', '123', 'david.pascual@correo.com', '1234567809', 'Tècnic', 'Actiu'),
('images/iconDefaultUser.png', 'administracio1', 'Juan Carlos', 'Mendoza', '123', 'juancarlos.mendoza@correo.com', '1234567810', 'Administració', 'Actiu'),
('images/iconDefaultUser.png', 'administracio2', 'Pedro', 'Álvarez', '123', 'pedro.alvarez@correo.com', '1234567811', 'Administració', 'Actiu'),
('images/iconDefaultUser.png', 'administracio3', 'Clara', 'Vega', '123', 'clara.vega@correo.com', '1234567812', 'Administració', 'Inactiu'),
('images/iconDefaultUser.png', 'administracio4', 'Pablo', 'Gómez', '123', 'pablo.gomez@correo.com', '1234567813', 'Administració', 'Actiu'),
('images/iconDefaultUser.png', 'administracio5', 'Esther', 'Pérez', '123', 'esther.perez@correo.com', '1234567814', 'Administració', 'Actiu'),
('images/iconDefaultUser.png', 'administracio6', 'Marcos', 'Cordero', '123', 'marcos.cordero@correo.com', '1234567815', 'Administració', 'Inactiu'),
('images/iconDefaultUser.png', 'administracio7', 'Sonia', 'Moreno', '123', 'sonia.moreno@correo.com', '1234567816', 'Administració', 'Actiu'),
('images/iconDefaultUser.png', 'administracio8', 'Raquel', 'López', '123', 'raquel.lopez@correo.com', '1234567817', 'Administració', 'Inactiu'),
('images/iconDefaultUser.png', 'administracio9', 'Javier', 'Ruiz', '123', 'javier.ruiz@correo.com', '1234567818', 'Administració', 'Actiu'),
('images/iconDefaultUser.png', 'administracio10', 'Isabel', 'Serrano', '123', 'isabel.serrano@correo.com', '1234567819', 'Administració', 'Inactiu'),
('images/iconDefaultUser.png', 'lector11', 'Antonio', 'García', '123', 'antonio.garcia@correo.com', '1234567820', 'Lector', 'Actiu'),
('images/iconDefaultUser.png', 'lector12', 'Inés', 'Castillo', '123', 'ines.castillo@correo.com', '1234567821', 'Lector', 'Inactiu'),
('images/iconDefaultUser.png', 'tecnic11', 'Ricardo', 'Navas', '123', 'ricardo.navas@correo.com', '1234567822', 'Tècnic', 'Inactiu'),
('images/iconDefaultUser.png', 'tecnic12', 'Julia', 'Blanco', '123', 'julia.blanco@correo.com', '1234567823', 'Tècnic', 'Actiu'),
('images/iconDefaultUser.png', 'administracio11', 'Eduardo', 'Salazar', '123', 'eduardo.salazar@correo.com', '1234567824', 'Administració', 'Inactiu'),
('images/iconDefaultUser.png', 'a', 'a', 'a', 'a', 'a847384@correo.com', '1234567824', 'Administració', 'Actiu');

INSERT INTO logs_obras (
    fk_obra, baja, causa_baja, fecha_baja, persona_autorizada
) VALUES
('R00001', 'Retirada temporal', 'Exposición pendiente', '2024-11-01', 1),
('R00002', 'Retirada definitiva', 'Daños irreparables', '2024-11-02', 2),
('R00003', 'Retirada temporal', 'Revisión de conservación', '2024-11-03', 3),
('R00004', 'Retirada definitiva', 'Condiciones no adecuadas para exhibición', '2024-11-04', 4),
('R00005', 'Retirada temporal', 'Restauración programada', '2024-11-05', 5),
('R00006', 'Retirada definitiva', 'Obra perdida', '2024-11-06', 6),
('R00007', 'Retirada temporal', 'Daños por transporte', '2024-11-07', 7),
('R00008', 'Retirada definitiva', 'Obra duplicada', '2024-11-08', 8),
('R00009', 'Retirada temporal', 'Reubicación para exposición', '2024-11-09', 9),
('R00010', 'Retirada definitiva', 'Obra retirada por solicitud del autor', '2024-11-10', 10),
('R00011', 'Retirada temporal', 'Mantenimiento preventivo', '2024-11-11', 11),
('R00012', 'Retirada definitiva', 'Exposición cerrada', '2024-11-12', 12),
('R00013', 'Retirada temporal', 'Mejoras en el almacenamiento', '2024-11-13', 13),
('R00014', 'Retirada definitiva', 'Obra retirada por solicitud del museo', '2024-11-14', 14),
('R00015', 'Retirada temporal', 'Condiciones climáticas no adecuadas', '2024-11-15', 15),
('R00016', 'Retirada definitiva', 'Robo durante exposición', '2024-11-16', 16),
('R00017', 'Retirada temporal', 'Reparación de soporte estructural', '2024-11-17', 17),
('R00018', 'Retirada definitiva', 'Exposición cancelada', '2024-11-18', 18),
('R00019', 'Retirada temporal', 'Revisión de seguridad', '2024-11-19', 19),
('R00020', 'Retirada definitiva', 'Desaprobación por parte del comisario', '2024-11-20', 20),
('R00021', 'Retirada temporal', 'Completado proceso de restauración', '2024-11-21', 21),
('R00022', 'Retirada definitiva', 'Cambio de dirección del museo', '2024-11-22', 22),
('R00023', 'Retirada temporal', 'Ajustes de iluminación necesarios', '2024-11-23', 23),
('R00024', 'Retirada definitiva', 'Desactualización en la colección', '2024-11-24', 24),
('R00025', 'Retirada temporal', 'Exhibición en otro museo', '2024-11-25', 25),
('R00026', 'Retirada definitiva', 'Obra descontinuada', '2024-11-26', 26),
('R00027', 'Retirada temporal', 'Reubicación en exposición itinerante', '2024-11-27', 27),
('R00028', 'Retirada definitiva', 'Ajuste de colección permanente', '2024-11-28', 28),
('R00029', 'Retirada temporal', 'Desinfección y restauración de materiales', '2024-11-29', 29),
('R00030', 'Retirada definitiva', 'Restauración incompleta', '2024-11-30', 30);


INSERT INTO restauraciones (
    comentario_restauracion, nombre_restaurador, fecha_inicio_restauracion, fecha_fin_restauracion
) VALUES
('Restauración de la pintura debido a daños por humedad', 'Juan Pérez', '2024-05-01', '2024-06-15'),
('Reparación del marco dorado de la escultura', 'Laura Martínez', '2024-03-10', '2024-04-01'),
('Consolidación de la estructura de madera', 'Carlos Sánchez', '2024-06-05', '2024-07-20'),
('Restauración de la tela de la pintura, eliminación de manchas', 'Elena García', '2024-04-15', '2024-05-30'),
('Reparación de daños por abrasión en escultura de bronce', 'Luis Rodríguez', '2024-01-10', '2024-02-25'),
('Restauración de pintura mural, eliminación de craqueladuras', 'Marta López', '2024-07-01', '2024-08-15'),
('Reparación de daños causados por manipulación en escultura', 'Fernando Díaz', '2024-02-20', '2024-03-10'),
('Restauración del barniz de la pintura', 'Carmen Fernández', '2024-08-05', '2024-09-20'),
('Reparación de la cerámica rota', 'Raúl Martínez', '2024-09-10', '2024-10-01'),
('Consolidación de las piezas de madera', 'Isabel Sánchez', '2024-10-15', '2024-11-01'),
('Restauración de pintura por oxidación de pigmentos', 'Antonio Pérez', '2024-11-01', '2024-12-10'),
('Reparación de escultura con pérdida de detalles', 'José García', '2024-06-10', '2024-07-01'),
('Consolidación y refuerzo de pintura en óleo', 'María Rodríguez', '2024-03-20', '2024-04-05'),
('Reparación de tejidos desgastados en tapicería', 'Pablo Ruiz', '2024-05-01', '2024-05-25'),
('Restauración de pintura sobre lienzo, eliminación de repintes', 'Luis Martínez', '2024-07-10', '2024-08-01'),
('Reparación de escultura de mármol con fisuras', 'Ana Pérez', '2024-02-15', '2024-03-05'),
('Consolidación de pintura en fresco dañada', 'Raquel Fernández', '2024-09-05', '2024-10-20'),
('Restauración de piezas de vidrio roto', 'Javier Gómez', '2024-04-01', '2024-05-10'),
('Reparación de pérdida de pigmento en pintura de agua', 'Victor Ramos', '2024-06-01', '2024-06-30'),
('Restauración de marco de madera con carvado', 'Adriana Sánchez', '2024-08-10', '2024-09-01'),
('Reparación de grabados con pérdida de detalle', 'Tomás López', '2024-01-15', '2024-02-10'),
('Consolidación de murales de papel', 'Margarita Díaz', '2024-02-01', '2024-02-28'),
('Restauración de objeto de cerámica con grietas', 'Cristina Ruiz', '2024-10-05', '2024-11-01'),
('Reparación de desgaste de escultura en hierro', 'Ricardo Pérez', '2024-03-25', '2024-04-10'),
('Restauración de las esquinas dañadas de la pintura', 'Luis Hernández', '2024-07-15', '2024-08-05'),
('Reparación de escultura de madera con hongos', 'Alba Rodríguez', '2024-05-10', '2024-06-01'),
('Restauración de la estructura de una silla de diseño antiguo', 'Patricia González', '2024-11-10', '2024-12-01'),
('Consolidación de pintura sobre yeso en pared', 'Jesús Martínez', '2024-04-01', '2024-04-15'),
('Restauración de escultura metálica con corrosión', 'Francisco López', '2024-09-15', '2024-10-05'),
('Reparación de desgaste en bordes de pintura', 'Claudia Fernández', '2024-08-25', '2024-09-10'),
('Reparación de daños estructurales en escultura de piedra', 'Antonio Gómez', '2024-06-01', '2024-06-20'),
('Restauración de pintura sobre lienzo afectada por agua', 'Sonia Martínez', '2024-05-15', '2024-06-05'),
('Consolidación de pintura mural con pérdida de colores', 'Rosa Sánchez', '2024-07-05', '2024-07-30');


INSERT INTO obras_restauraciones (
    fk_obra, fk_restauracion
) VALUES
('R00001', 1),
('R00002', 2),
('R00003', 3),
('R00004', 4),
('R00005', 5),
('R00006', 6),
('R00007', 7),
('R00008', 8),
('R00009', 9),
('R00010', 10),
('R00011', 11),
('R00012', 12),
('R00013', 13),
('R00014', 14),
('R00015', 15),
('R00016', 16),
('R00017', 17),
('R00018', 18),
('R00019', 19),
('R00020', 20),
('R00021', 21),
('R00022', 22),
('R00023', 23),
('R00024', 24),
('R00025', 25),
('R00026', 26),
('R00027', 27),
('R00028', 28),
('R00029', 29),
('R00030', 30);


INSERT INTO movimientos (
    comentario_movimiento, museo, fecha_inicio_movimiento, fecha_fin_movimiento
) VALUES
('Movimiento de obras para nueva exposición', 'Museo Nacional de Arte', '2024-01-10', '2024-01-20'),
('Traslado de piezas para restauración', 'Museo de Arte Moderno', '2024-02-01', '2024-02-10'),
('Reubicación de piezas de la colección permanente', 'Museo de Historia', '2024-03-01', '2024-03-15'),
('Exhibición temporal en otra sala', 'Museo de Ciencias Naturales', '2024-04-05', '2024-04-15'),
('Exhibición itinerante a otra ciudad', 'Museo de Arte Contemporáneo', '2024-05-01', '2024-05-10'),
('Traslado de piezas para revisión de conservación', 'Museo de Antropología', '2024-06-01', '2024-06-10'),
('Mudanza de obras a nuevo espacio de almacenamiento', 'Museo de Arte Clásico', '2024-07-10', '2024-07-20'),
('Rotación de exposiciones temporales', 'Museo de Arte y Cultura', '2024-08-05', '2024-08-15'),
('Exhibición de piezas en un espacio al aire libre', 'Museo de Arte Digital', '2024-09-01', '2024-09-10'),
('Cambio de ubicación por condiciones climáticas', 'Museo de Arte Urbano', '2024-10-01', '2024-10-15'),
('Exhibición de arte contemporáneo en sala rotada', 'Museo de Arte Moderno', '2024-11-01', '2024-11-10'),
('Movimiento para renovar la colección', 'Museo de Arte Internacional', '2024-12-05', '2024-12-15'),
('Exhibición de objetos artísticos en exposiciones temporales', 'Museo de Arte y Ciencia', '2024-01-20', '2024-01-30'),
('Traslado de piezas para limpieza y conservación', 'Museo de Arte Prehistórico', '2024-02-20', '2024-02-28'),
('Reubicación de obras para nueva campaña de marketing', 'Museo del Prado', '2024-03-10', '2024-03-20'),
('Movimiento a nueva sala de exhibición permanente', 'Museo de Arte Barroco', '2024-04-10', '2024-04-20'),
('Puesta en exhibición de piezas en una exposición nacional', 'Museo de Arte Español', '2024-05-10', '2024-05-20'),
('Traslado de esculturas a sala de esculturas', 'Museo de Escultura', '2024-06-15', '2024-06-25'),
('Movimiento para renovación de sala de exposición', 'Museo de Historia Natural', '2024-07-05', '2024-07-15'),
('Rotación de arte contemporáneo', 'Museo de Arte Pop', '2024-08-15', '2024-08-25'),
('Cambio de ubicación debido a reformas en el museo', 'Museo de Arte Religioso', '2024-09-10', '2024-09-20'),
('Exhibición de obras en un espacio urbano', 'Museo de Arte Público', '2024-10-05', '2024-10-15'),
('Traslado para restauración urgente', 'Museo Nacional de Bellas Artes', '2024-11-15', '2024-11-25'),
('Exhibición de arte barroco en colaboración con otro museo', 'Museo de Arte Antiguo', '2024-12-01', '2024-12-10'),
('Rotación para nueva exposición de arte medieval', 'Museo Medieval', '2024-01-05', '2024-01-15'),
('Traslado de piezas para nueva temporada de exposiciones', 'Museo de Arte en la Calle', '2024-02-10', '2024-02-20'),
('Exhibición en el exterior del museo para el verano', 'Museo de Arte Contemporáneo', '2024-03-05', '2024-03-15'),
('Movimiento para cambio de lugar de almacenamiento', 'Museo de Arte Fotográfico', '2024-04-01', '2024-04-10'),
('Puesta en exposición de la nueva colección de arte', 'Museo de Artes Visuales', '2024-05-01', '2024-05-10'),
('Cambio de ubicación de piezas para nueva campaña', 'Museo de Arte Latinoamericano', '2024-06-01', '2024-06-10'),
('Traslado de piezas a nueva galería de arte', 'Museo de Arte y Diseño', '2024-07-10', '2024-07-20'),
('Reubicación de piezas a zona más segura del museo', 'Museo de Arte Subterráneo', '2024-08-01', '2024-08-10');


INSERT INTO obras_movimientos (
    fk_obra, fk_movimiento
) VALUES
('R00001', 1),
('R00002', 2),
('R00003', 3),
('R00004', 4),
('R00005', 5),
('R00006', 6),
('R00007', 7),
('R00008', 8),
('R00009', 9),
('R00010', 10),
('R00011', 11),
('R00012', 12),
('R00013', 13),
('R00014', 14),
('R00015', 15),
('R00016', 16),
('R00017', 17),
('R00018', 18),
('R00019', 19),
('R00020', 20),
('R00021', 21),
('R00022', 22),
('R00023', 23),
('R00024', 24),
('R00025', 25),
('R00026', 26),
('R00027', 27),
('R00028', 28),
('R00029', 29),
('R00030', 30);


INSERT INTO copias_seguridad (
    nombre_copia, descripcion_copia, fecha_copia, fk_creador
) VALUES
('Copia de seguridad 1', 'Copia de seguridad de las obras y movimientos del museo', '2024-01-10', 1),
('Copia de seguridad 2', 'Copia de seguridad de exposiciones y usuarios', '2024-02-01', 2),
('Copia de seguridad 3', 'Copia de seguridad de la base de datos de obras', '2024-03-05', 3),
('Copia de seguridad 4', 'Respaldo completo de las ubicaciones y restauraciones', '2024-04-10', 4),
('Copia de seguridad 5', 'Respaldo de obras, restauraciones y movimientos', '2024-05-15', 5),
('Copia de seguridad 6', 'Respaldo de todas las exposiciones y usuarios', '2024-06-01', 6),
('Copia de seguridad 7', 'Copia de seguridad de los datos del museo', '2024-07-10', 7),
('Copia de seguridad 8', 'Respaldo de las restauraciones y copias de seguridad anteriores', '2024-08-05', 8),
('Copia de seguridad 9', 'Copia completa del registro de obras y exposiciones', '2024-09-01', 9),
('Copia de seguridad 10', 'Respaldo del sistema de movimientos y restauraciones', '2024-10-01', 10),
('Copia de seguridad 11', 'Respaldo de todos los usuarios y su información', '2024-11-15', 11),
('Copia de seguridad 12', 'Copia de seguridad de las obras y sus movimientos', '2024-12-01', 12),
('Copia de seguridad 13', 'Respaldo de las obras registradas y las exposiciones', '2024-01-20', 13),
('Copia de seguridad 14', 'Copia de seguridad de las restauraciones y movimientos', '2024-02-25', 14),
('Copia de seguridad 15', 'Copia completa de los registros de exposiciones y movimientos', '2024-03-15', 15),
('Copia de seguridad 16', 'Respaldo de las obras, exposiciones y restauraciones', '2024-04-05', 16),
('Copia de seguridad 17', 'Copia de seguridad de los datos de las ubicaciones y usuarios', '2024-05-10', 17),
('Copia de seguridad 18', 'Respaldo completo de los movimientos y obras en exposición', '2024-06-15', 18),
('Copia de seguridad 19', 'Copia de las restauraciones y su impacto en las obras', '2024-07-20', 19),
('Copia de seguridad 20', 'Respaldo de las obras y las copias anteriores', '2024-08-15', 20),
('Copia de seguridad 21', 'Copia completa de todos los movimientos y ubicaciones', '2024-09-10', 21),
('Copia de seguridad 22', 'Respaldo de las obras y sus detalles completos', '2024-10-15', 22),
('Copia de seguridad 23', 'Copia de seguridad de los movimientos y los datos de los usuarios', '2024-11-05', 23),
('Copia de seguridad 24', 'Respaldo de las exposiciones itinerantes y sus piezas', '2024-12-01', 24),
('Copia de seguridad 25', 'Copia de las obras restauradas y sus historiales', '2024-01-05', 25),
('Copia de seguridad 26', 'Copia completa de las exposiciones y registros de restauración', '2024-02-10', 26),
('Copia de seguridad 27', 'Respaldo de las obras y sus cambios de ubicación', '2024-03-01', 27),
('Copia de seguridad 28', 'Copia de seguridad de todos los registros de restauraciones', '2024-04-25', 28),
('Copia de seguridad 29', 'Respaldo de todos los registros de copias de seguridad anteriores', '2024-05-20', 29),
('Copia de seguridad 30', 'Copia final de todas las obras y sus restauraciones', '2024-06-30', 30);


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