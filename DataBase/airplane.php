<?php
// Conectar a la base de datos (o crearla si no existe)
$db = new SQLite3('aviones.db');

// Eliminar tablas para reiniciar la base de datos (solo para desarrollo/testing)
$db->exec("DROP TABLE IF EXISTS fabricantes");
$db->exec("DROP TABLE IF EXISTS modelos_aviones");
$db->exec("DROP TABLE IF EXISTS usuarios");
$db->exec("DROP TABLE IF EXISTS suscripciones");
$db->exec("DROP TABLE IF EXISTS contactos");

// Crear la tabla fabricantes si no existe
$db->exec("CREATE TABLE IF NOT EXISTS fabricantes (
    fab_id INTEGER PRIMARY KEY AUTOINCREMENT,
    fab_nom TEXT NOT NULL,
    fab_imagen TEXT NOT NULL
);");

// Crear la tabla modelos_aviones si no existe (ahora con fecha_lanzamiento y velocidad_maxima)
$db->exec("CREATE TABLE IF NOT EXISTS modelos_aviones (
    mod_id INTEGER PRIMARY KEY AUTOINCREMENT,
    mod_nom TEXT NOT NULL,
    mod_descripcio TEXT NOT NULL,
    mod_imagen TEXT,
    fecha_lanzamiento TEXT,
    velocidad_maxima INTEGER,
    fab_id INTEGER NOT NULL,
    FOREIGN KEY(fab_id) REFERENCES fabricantes(fab_id)
);");

// Insertar datos en la tabla fabricantes (Boeing y Airbus)
$db->exec("INSERT INTO fabricantes (fab_nom, fab_imagen) VALUES 
('Boeing','https://media.istockphoto.com/id/517851883/es/foto/boing-747-en-vuelo.jpg?s=612x612&w=0&k=20&c=k5HxEvfI3_9QIqKfrLNY9BFHzQsLz8JMmvL0JcEWhY8='),
('Airbus', 'https://t3.ftcdn.net/jpg/05/55/34/62/360_F_555346287_MhBuFKC7YJqVhSPowlY03DcNpqmDKldF.jpg'),
('Embraer', 'https://storage.googleapis.com/site.esss.co/bcd8b658-2019-04-08-thumb-embraer.jpg'),
('Bombardier', 'https://imagenes.20minutos.es/files/image_1920_1080/uploads/imagenes/2025/04/11/bombardier-global-8000.jpeg'),
('Otros', 'https://aeroin.net/wp-content/uploads/2021/07/Il62.jpg')
;");




// Insertar datos en la tabla modelos_aviones (con fecha de lanzamiento y velocidad máxima)
$db->exec("INSERT INTO modelos_aviones (mod_nom, mod_descripcio, mod_imagen, fecha_lanzamiento, velocidad_maxima, fab_id) 
VALUES 
('737', 'El Boeing 737 es un avión de pasillo único utilizado principalmente para vuelos comerciales de corta y media distancia. Es uno de los aviones más populares del mundo.', 'https://img.static-kl.com/transform/2651d1aa-6331-459b-8719-28d6d8170167/', '1968', 876, 1),
('747', 'El Boeing 747 es un avión de pasajeros de largo alcance conocido como \"Jumbo\". Es famoso por su capacidad de transportar a cientos de personas y por su icónica doble cubierta.', 'https://upload.wikimedia.org/wikipedia/commons/4/40/Pan_Am_Boeing_747-121_N732PA_Bidini.jpg', '1969', 988, 1),
('757', 'El Boeing 757 es un avión de mediano alcance utilizado para vuelos comerciales. Tiene una capacidad para aproximadamente 200-300 pasajeros.', 'https://upload.wikimedia.org/wikipedia/commons/thumb/3/34/Delta_Air_Lines_Boeing_757-300%3B_N582NW%40LAX%3B11.10.2011_623ft_%286646227129%29.jpg/330px-Delta_Air_Lines_B757-300%3B_N582NW%40LAX%3B11.10.2011_623ft_%286646227129%29.jpg', '1982', 982, 1),
('767', 'El Boeing 767 es un avión de fuselaje ancho utilizado tanto para vuelos de pasajeros como para carga. Es ideal para vuelos de largo alcance.', 'https://upload.wikimedia.org/wikipedia/commons/thumb/4/43/Delta_Air_Lines_B767-332_N130DL.jpg/1200px-Delta_Air_Lines_B767-332_N130DL.jpg', '1981', 913, 1),
('777', 'El Boeing 777 es un avión de largo alcance de fuselaje ancho. Se destaca por su eficiencia y capacidad de transportar grandes cantidades de pasajeros y carga.', 'https://aircharterservice-globalcontent-live.cphostaccess.com/images/aircraft-guide-images/group/boeing-b777-22c3002c8x-large_tcm36-3695.jpg', '1994', 950, 1),
('787', 'El Boeing 787 Dreamliner es un avión de largo alcance de última generación que ofrece una eficiencia de combustible superior y un diseño avanzado.', 'https://phantom-expansion.uecdn.es/ccb93ccebbce08f5986229a8379a9cc3/crop/167x80/1965x1278/resize/1200/f/webp/assets/multimedia/imagenes/2023/10/25/16982385979337.jpg', '2009', 954, 1),
('707', 'El Boeing 707 fue un avión revolucionario que marcó el comienzo de la era de los aviones a reacción para pasajeros.', 'https://cdn.britannica.com/74/183374-050-E56D88D9/Boeing-707.jpg', '1957', 960, 1),
('727', 'El Boeing 727 fue un popular avión trimotor de corto a medio alcance, muy utilizado en vuelos domésticos.', 'https://upload.wikimedia.org/wikipedia/commons/5/57/B-727_Iberia_%28cropped%29.jpg', '1963', 960, 1),

-- Nuevos modelos de Boeing con URLs buscadas
('717', 'El Boeing 717 es un avión de pasillo único, ideal para rutas regionales y de corta distancia, derivado del McDonnell Douglas MD-95.', 'data:image/jpeg;base64,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', '1999', 811, 1),
('C-17 Globemaster III', 'El Boeing C-17 Globemaster III es un gran avión de transporte militar que puede llevar cargas pesadas por todo el mundo y aterrizar en pistas pequeñas.', 'https://galaxiamilitar.es/wp-content/uploads/2025/06/C-17.jpg', '1991', 830, 1),
('P-8 Poseidon', 'El Boeing P-8 Poseidon es un avión de patrulla marítima y guerra antisubmarina basado en el Boeing 737.', 'https://upload.wikimedia.org/wikipedia/commons/3/3f/US_Navy_P-8_Poseidon_taking_off_at_Perth_Airport.jpg', '2009', 907, 1),
('747-8F', 'El Boeing 747-8F es la versión de carga de la última generación del Jumbo, con mayor capacidad y eficiencia de combustible.', 'https://www.aircharteradvisors.com/wp-content/uploads/2020/04/boeing-747-8F-freight-airliner-e1586796350454.jpg', '2011', 988, 1),
('KC-46 Pegasus', 'El Boeing KC-46 Pegasus es un avión militar de reabastecimiento en vuelo y transporte, basado en el Boeing 767.', 'https://aviaciondigital.com/wp-content/uploads/2023/08/boeing-avion-cisterna.jpg', '2015', 915, 1),

-- Modelos de Airbus con URLs buscadas
('A220', 'El Airbus A220 es un avión de pasillo único diseñado para vuelos de corta distancia. Es conocido por su eficiencia y comodidad.', 'https://upload.wikimedia.org/wikipedia/commons/8/8c/Airbus_A220-300.jpg', '2013', 871, 2),
('A300', 'El Airbus A300 fue el primer avión de pasillo doble de Airbus, diseñado para vuelos de largo alcance.', 'https://news.flylinkers.com/wp-content/uploads/2022/10/airbus-a300.png', '1972', 917, 2),
('A310', 'El Airbus A310 es un avión de fuselaje ancho, diseñado para vuelos de largo alcance, y es considerado un antecesor del A330.', 'https://mantisserv.com/113/airbus-a310.jpg', '1982', 913, 2),
('A318', 'El Airbus A318 es el modelo más pequeño de la familia A320, ideal para vuelos regionales y de corto alcance.', 'https://aeroaffaires.es/wp-content/uploads/2018/08/airbus-a318-elite.jpg', '2002', 871, 2),
('A319', 'El Airbus A319 es un avión de pasillo único que ofrece una capacidad intermedia, adecuado para vuelos de corta y media distancia.', 'https://www.aeroflap.com.br/wp-content/uploads/2016/02/A319_Airbus___2009-e1472579779378.jpg', '1995', 871, 2),
('A320', 'El Airbus A320 es un avión de pasillo único, famoso por su eficiencia y flexibilidad en vuelos de corta y media distancia.', 'https://upload.wikimedia.org/wikipedia/commons/thumb/c/c1/Airbus_A320-214%2C_Airbus_Industrie_JP7617615.jpg/960px-Airbus_A320-214%2C_Airbus_Industrie_JP7617615.jpg', '1987', 871, 2),
('A321', 'El Airbus A321 es una versión más grande del A320, diseñado para vuelos de mayor distancia y con mayor capacidad.', 'https://upload.wikimedia.org/wikipedia/commons/1/18/Lufthansa.a321-100.d-aire.arp.jpg', '1993', 871, 2),
('A330', 'El Airbus A330 es un avión de fuselaje ancho utilizado para vuelos de largo alcance. Es popular por su eficiencia y capacidad de transporte.', 'https://upload.wikimedia.org/wikipedia/commons/thumb/f/ff/F-WWCB_A330-203_Airbus_Industrie_TLS_27SEP13_%289972134676%29.jpg/1200px-F-WWCB_A330-203_Airbus_Industrie_TLS_27SEP13_%289972134676%29.jpg', '1992', 913, 2),
('A340', 'El Airbus A340 es un avión de fuselaje ancho y cuatro motores, diseñado para vuelos de largo alcance.', 'https://upload.wikimedia.org/wikipedia/commons/e/ec/Frankfurt_Airport_Lufthansa_Airbus_A340-313_D-AIGY_%28DSC02566%29.jpg', '1991', 913, 2),
('A350', 'El Airbus A350 es un avión de fuselaje ancho de última generación, diseñado para vuelos de largo alcance, con una gran eficiencia de combustible.', 'https://aviaciondigital.com/wp-content/uploads/2023/03/Lufthansa-A350-1000.jpg', '2013', 945, 2),
('A380', 'El Airbus A380 es el avión comercial más grande del mundo, con capacidad para más de 800 pasajeros. Es conocido por su doble cubierta y su capacidad para vuelos de largo alcance.', 'https://images.aircharterservice.com/global/aircraft-guide/group-charter/airbus-a380-1.jpg', '2005', 1020, 2),

-- Nuevos modelos de Airbus con URLs buscadas
('Beluga XL', 'El Airbus Beluga XL es un avión de transporte de carga de gran tamaño, diseñado específicamente para mover secciones de aviones entre las plantas de Airbus. Es fácilmente reconocible por su forma de ballena beluga.', 'https://www.microsiervos.com/images/beluga-xl-airbus.jpg', '2018', 737, 2),
('A400M Atlas', 'El Airbus A400M Atlas es un avión de transporte militar de cuatro motores turbohélice, capaz de realizar reabastecimiento en vuelo y operar en pistas cortas no preparadas.', 'https://upload.wikimedia.org/wikipedia/commons/3/31/German_Air_Force_Airbus_A400M_%28out_cropped%29.jpg', '2009', 780, 2),
('A330 MRTT', 'El Airbus A330 Multi Role Tanker Transport (MRTT) es una versión militar del A330, utilizada para reabastecimiento en vuelo y transporte de personal/carga.', 'https://mediarenditions.airbus.com/aYQBKyL6-hjyBKemIw7zmw-C-MC0hTlvMjFqgUn_170/resize?src=kpkp://airbus/38/701/701278-lnfxc349oc.jpg&w=640&h=480&t=fill', '2007', 880, 2),
('A320neo', 'La familia Airbus A320neo (New Engine Option) es una mejora del A320 original, ofreciendo mayor eficiencia de combustible y menor ruido.', 'https://upload.wikimedia.org/wikipedia/commons/thumb/4/4d/IndiGo_Airbus_A320neo_F-WWDG_%28to_VT-ITI%29_%2828915135713%29.jpg/960px-IndiGo_Airbus_A320neo_F-WWDG_%28to_VT-ITI%29_%2828915135713%29.jpg', '2014', 876, 2),

-- Modelos de Embraer con URLs buscadas
('ERJ-145', 'El Embraer ERJ-145 es un jet regional de tamaño mediano, ideal para vuelos de corto y medio alcance, con capacidad para aproximadamente 50 pasajeros.', 'https://aircharterservice-globalcontent-live.cphostaccess.com/images/aircraft-guide-images/group/embraer-emb145-large_tcm36-3722.jpg', '1996', 834, 3),
('ERJ-170', 'El Embraer ERJ-170 es un avión regional de pasillo único, diseñado para ofrecer comodidad en vuelos cortos y medianos.', 'https://aeroaffaires.es/wp-content/uploads/2019/04/emb170_ext-800x430-c-center.jpg', '2002', 820, 3),
('E170', 'El Embraer E170 es un jet regional con capacidad para aproximadamente 70-80 pasajeros, ideal para rutas de corto y medio alcance.', 'https://accaircharter.co.uk/wp-content/uploads/2023/04/Embraer-E170-Executive.png', '2002', 820, 3),
('E175', 'El Embraer E175 es una variante del E-Jet, ligeramente más grande que el E170, muy popular en vuelos regionales en Norteamérica.', 'https://img.static-kl.com/transform/1426fd3e-e86b-448e-add2-a99c816b9757/', '2003', 820, 3),
('E190', 'El Embraer E190 es un jet de tamaño mediano con capacidad para unos 100-114 pasajeros, utilizado para rutas de media distancia.', 'https://www.lot.com/content/dam/lot/lot-com/other-images/flota/embraer-190/EMB190-03-chmury-xR-1X-jacek-bonczek.jpg', '2004', 870, 3),
('E195', 'El Embraer E195 es el modelo más grande de la primera generación de E-Jets, ofreciendo mayor capacidad y autonomía.', 'https://fly-news.es/wp-content/uploads/Luxair-Embraer-E195-E2.jpg', '2006', 870, 3),
('E190-E2', 'El Embraer E190-E2 es la segunda generación del E190, destacando por su mejor eficiencia de combustible y menor ruido.', 'https://revistapesquisa.fapesp.br/wp-content/thumbs/19bb0c3de110309cc8511b9736016e3d10495f0b_1200-630.jpg', '2016', 870, 3),
('E195-E2', 'El Embraer E195-E2 es el miembro más grande de la familia E-Jet E2, compitiendo en el segmento de aviones de pasillo único con mayor capacidad.', 'https://actualidadaeroespacial.com/wp-content/uploads/2021/02/KLM-Embraer-240221.jpg', '2017', 870, 3),

-- Nuevos modelos de Embraer con URLs buscadas
('ERJ-135', 'El Embraer ERJ-135 es un jet regional de menor capacidad (37 pasajeros), ideal para rutas cortas y operaciones en aeropuertos más pequeños.', 'https://i0.wp.com/aeronauticapy.com/wp-content/uploads/2020/06/erj-135.jpg?resize=1140%2C570&ssl=1', '1999', 834, 3),
('Legacy 600', 'El Embraer Legacy 600 es un jet de negocios de largo alcance, basado en la plataforma del jet regional ERJ-135.', 'https://aircharterservice-globalcontent-live.cphostaccess.com/images/aircraft-guide-images/private/embraer20legacy20600-65020ex_tcm36-3859.jpg', '2001', 834, 3),
('Praetor 600', 'El Embraer Praetor 600 es un jet de negocios super-midsize con un alcance impresionante, ideal para vuelos transcontinentales.', 'https://aeroaffaires.es/wp-content/uploads/2019/07/praetor-600-aeroaffaires-e1564659513355.jpg', '2019', 863, 3),
('Phenom 300', 'El Embraer Phenom 300 es uno de los jets ligeros más populares y vendidos en el mundo, conocido por su velocidad y eficiencia.', 'https://www.aerotendencias.com/wp-content/uploads/2024/03/Phenom_300.jpg', '2009', 839, 3),

-- Bombardier regional jets (CRJ family)
('CRJ-100/200', 'El Bombardier CRJ‑100/200 es un jet regional de aproximadamente 50 plazas, primer modelo de la familia CRJ introducido en 1992.', 'https://baatraining.com/wp-content/uploads/2023/02/trto-bombardier-crj-100-200-hero.webp', '1992', 800, 4),
('CRJ-700', 'El Bombardier CRJ‑700 es una versión estirada del CRJ‑200, con capacidad para hasta 78 pasajeros y mejor alcance.', 'https://images.aircharterservice.com/global/aircraft-guide/group-charter/bombardier-crj-700-1.jpg', '1999', 827, 4),
('CRJ-900', 'El Bombardier CRJ‑900 es un desarrollo adicional del CRJ‑700, con capacidad ampliada de hasta 90 pasajeros y excelente eficiencia.', 'https://aeroaffaires.es/wp-content/uploads/2019/04/image.png', '2001', 820, 4),
('CRJ-1000', 'El Bombardier CRJ‑1000 es el de mayor capacidad de la serie CRJ, capaz de transportar hasta 104 pasajeros en rutas regionales.', 'https://aircharterservice-globalcontent-live.cphostaccess.com/images/aircraft-guide-images/group/bombardier-crj-1000-large_tcm36-3710.jpg', '2006', 1040, 4),

-- Bombardier business jets (Challenger)
('Challenger 350', 'El Bombardier Challenger 350 es un jet de negocios super‑mediano, muy popular por su fiabilidad, alcance y confort de cabina.', 'https://simply-jet.ch/_next/image?url=https%3A%2F%2Fsimplyjet-prod-ch.s3.eu-central-2.amazonaws.com%2Fwebsite%2Faircraft-cms%2F1718708309176~challenger-350.webp&w=3840&q=75', '2014', 3300, 4),

-- Aviación general (pistón)
('Cessna 172 Skyhawk', 'Avión monomotor de pistón, cuatro plazas, el más producido y popular para formación.', 'https://upload.wikimedia.org/wikipedia/commons/8/8c/Airbus_A220-300.jpg', '1956', 640, 5),
('Piper PA-28 Cherokee', 'Avión monomotor de pistón, cuatro plazas, utilizado en formación y aviación general.', 'https://www.piperflyer.com/articles/art-cats/45-magazine/article-archive/piper-models/single-engine/pa-24-comanche-1.html', '1960', 800, 5),
('Beechcraft Bonanza (V35)', 'Avión monomotor de pistón de alta gama con tren retráctil, muy popular en aviación privada.', 'https://www.airteamimages.com/search?q=P28A', '1947', 1600, 5),
('Diamond DA40', 'Avión monomotor moderno de cuatro plazas, construcción composite, ideal para formación avanzada.', 'https://pilotinstitute.com/category-class-and-type-of-aircraft/', '1997', 1240, 5),
('Cirrus SR22', 'Avión monomotor de pistón, cuatro plazas, con paracaídas completo de fuselaje, alto rendimiento.', 'https://aeroaffaires.es/wp-content/uploads/2019/04/image.png', '2001', 1660, 5),

-- Jets ligeros y midsize (no Bombardier)
('Cessna Citation Mustang', 'Jet muy ligero, cinco plazas, ideal para entrada al mundo del jet privado.', 'https://www.aircharterservice.com/global/aircraft-guide/group-charter/citation-mustang', '2006', 1300, 5),
('Embraer Phenom 100', 'Jet muy ligero, cuatro plazas, alta eficiencia y confort.', 'https://www.aeronauticapy.com.../erj-135.jpg', '2008', 1430, 5),
('HondaJet HA-420', 'Jet muy ligero, fuselaje composite y motores montados sobre ala para más confort.', 'https://aeroaffaires.es/wp-content/uploads/2019/07/praetor-500-e1564659513355.jpg', '2015', 1400, 6),
('Beechcraft Premier IA', 'Jet muy ligero, fuselaje composite, rendimiento por encima de jets en su categoría.', 'https://simplyjet.ch/.../challenger-350.webp', '2001', 1700, 5),
('Cessna Citation XLS+', 'Jet ligero-midsize, cabina espaciosa, muy empleado en charter ejecutivo.', 'https://images.aircharterservice.com/.../citationxls.jpg', '1998', 3000, 5),

-- Turboprop utilitarios
('Cessna 208 Caravan', 'Turboprop de un motor, versátil para carga y pasajeros en pistas cortas.', 'https://upload.wikimedia.org/wikipedia/commons/thumb/.../Cessna_208_Caravan.jpg', '1982', 1750, 5),
('Pilatus PC-12', 'Turboprop monomotor, versátil, amplia cabina para pasajeros o carga.', 'https://upload.wikimedia.org/wikipedia/commons/thumb/.../Pilatus_PC-12.jpg', '1994', 1900, 5),
('Beechcraft King Air 200', 'Turboprop bimotor, muy popular en aviación ejecutiva y médica.', 'https://upload.wikimedia.org/wikipedia/commons/thumb/.../Beechcraft_King_Air_200.jpg', '1974', 2100, 5),

-- Helicópteros civiles
('Robinson R44', 'Helicóptero ligero de cuatro plazas, muy usado en formación y vuelos privados.', 'https://upload.wikimedia.org/wikipedia/commons/thumb/.../Robinson_R44.jpg', '1992', 560, 5),
('Bell 206 JetRanger', 'Helicóptero ligero muy versátil en misiones civiles y policiales.', 'https://upload.wikimedia.org/wikipedia/commons/thumb/.../Bell_206.jpg', '1967', 660, 5),
('Airbus H125', 'Helicóptero ligero robusto, usado en trabajo aéreo, rescate y civil.', 'https://upload.wikimedia.org/wikipedia/commons/thumb/.../Airbus_H125.jpg', '1999', 650, 5),

-- Ultraligeros / Bush planes
('CubCrafters XCub', 'Ultraligero “bush plane” moderno, para pistas cortas y terrenos extremos.', 'https://upload.wikimedia.org/wikipedia/commons/thumb/.../CubCrafters_XCub.jpg', '2016', 1300, 5),
('ICON A5', 'Avioneta amphibious ligera con parabrisas completo, muy popular para recreo.', 'https://upload.wikimedia.org/wikipedia/commons/thumb/.../ICON_A5.jpg', '2016', 1200, 5),

-- Gliders / planeadores
('Schleicher ASK 21', 'Planeador biplaza de instrucción, muy usado en clubes de vuelo.', 'https://upload.wikimedia.org/wikipedia/commons/thumb/.../ASK_21.jpg', '1979', 0, 5),
('Schempp-Hirth Discus-2', 'Planeador de alto rendimiento, uno de los más populares para competición.', 'https://upload.wikimedia.org/wikipedia/commons/thumb/.../Discus-2.jpg', '1998', 0, 5)

;");



// Crear la tabla suscripciones
$db->exec("CREATE TABLE IF NOT EXISTS suscripciones (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    email TEXT NOT NULL UNIQUE
);");

// Crear la tabla contactos
$db->exec("CREATE TABLE IF NOT EXISTS contactos (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    nombre TEXT NOT NULL,
    email TEXT NOT NULL,
    mensaje TEXT NOT NULL
);");
$db->exec("INSERT INTO contactos (nombre, email, mensaje) VALUES ('Juan Pérez', 'juan.perez@example.com', 'Me gustaría obtener más información sobre los vuelos a Madrid.');");
  

$db->exec("INSERT INTO contactos (nombre, email, mensaje) VALUES ('María García', 'maria.garcia@otroejemplo.net', 'Tengo una consulta sobre un paquete vacacional específico.');");


$db->exec("INSERT INTO contactos (nombre, email, mensaje) VALUES ('Pedro López', 'pedro.lopez@dominio.org', 'Necesito soporte técnico con la reserva que acabo de hacer.');");


// Cerrar la conexión
$db->close();
?>