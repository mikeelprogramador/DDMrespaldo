-- MySQL dump 10.13  Distrib 8.0.36, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: bd_ddm
-- ------------------------------------------------------
-- Server version	5.5.5-10.4.32-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `tb_carrito`
--

DROP TABLE IF EXISTS `tb_carrito`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tb_carrito` (
  `id_carrito` int(11) NOT NULL AUTO_INCREMENT,
  `id_usuario` int(11) NOT NULL,
  PRIMARY KEY (`id_carrito`),
  KEY `id_usuario` (`id_usuario`),
  CONSTRAINT `tb_carrito_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `tb_usuarios` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_carrito`
--

LOCK TABLES `tb_carrito` WRITE;
/*!40000 ALTER TABLE `tb_carrito` DISABLE KEYS */;
INSERT INTO `tb_carrito` VALUES (4,3);
/*!40000 ALTER TABLE `tb_carrito` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_carypro`
--

DROP TABLE IF EXISTS `tb_carypro`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tb_carypro` (
  `id_carypro` int(11) NOT NULL AUTO_INCREMENT,
  `id_carrito` int(11) NOT NULL,
  `id_producto` varchar(10) NOT NULL,
  `cantidad_de_productos` int(11) NOT NULL,
  PRIMARY KEY (`id_carypro`),
  KEY `id_carrito` (`id_carrito`),
  KEY `id_producto` (`id_producto`),
  CONSTRAINT `tb_carypro_ibfk_1` FOREIGN KEY (`id_carrito`) REFERENCES `tb_carrito` (`id_carrito`),
  CONSTRAINT `tb_carypro_ibfk_2` FOREIGN KEY (`id_producto`) REFERENCES `tb_productos` (`id_producto`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_carypro`
--

LOCK TABLES `tb_carypro` WRITE;
/*!40000 ALTER TABLE `tb_carypro` DISABLE KEYS */;
INSERT INTO `tb_carypro` VALUES (36,4,'7',1);
/*!40000 ALTER TABLE `tb_carypro` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_categorias`
--

DROP TABLE IF EXISTS `tb_categorias`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tb_categorias` (
  `id_categoria` int(11) NOT NULL AUTO_INCREMENT,
  `categoria` varchar(150) NOT NULL,
  PRIMARY KEY (`id_categoria`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_categorias`
--

LOCK TABLES `tb_categorias` WRITE;
/*!40000 ALTER TABLE `tb_categorias` DISABLE KEYS */;
INSERT INTO `tb_categorias` VALUES (1,'Accesorios para celular'),(2,'Electrónica'),(3,'Gorras'),(4,'Ropa'),(5,'Hogar'),(6,'Cocina'),(7,'Calzado'),(8,'Videojuegos');
/*!40000 ALTER TABLE `tb_categorias` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_categoriasproducto`
--

DROP TABLE IF EXISTS `tb_categoriasproducto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tb_categoriasproducto` (
  `id_p_c` int(11) NOT NULL AUTO_INCREMENT,
  `id_producto` varchar(10) NOT NULL,
  `id_categoria` int(11) NOT NULL,
  PRIMARY KEY (`id_p_c`),
  KEY `id_producto` (`id_producto`),
  KEY `id_categoria` (`id_categoria`),
  CONSTRAINT `tb_categoriasproducto_ibfk_1` FOREIGN KEY (`id_producto`) REFERENCES `tb_productos` (`id_producto`),
  CONSTRAINT `tb_categoriasproducto_ibfk_2` FOREIGN KEY (`id_categoria`) REFERENCES `tb_categorias` (`id_categoria`)
) ENGINE=InnoDB AUTO_INCREMENT=78 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_categoriasproducto`
--

LOCK TABLES `tb_categoriasproducto` WRITE;
/*!40000 ALTER TABLE `tb_categoriasproducto` DISABLE KEYS */;
INSERT INTO `tb_categoriasproducto` VALUES (57,'01',1),(58,'01',2),(59,'3',2),(60,'4',5),(61,'4',6),(62,'5',1),(63,'5',2),(64,'2',3),(65,'2',4),(66,'6',7),(67,'7',2),(68,'7',8),(69,'8',2),(70,'8',8),(74,'9',2),(75,'9',5),(76,'9',6),(77,'10',4);
/*!40000 ALTER TABLE `tb_categoriasproducto` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_comentarios`
--

DROP TABLE IF EXISTS `tb_comentarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tb_comentarios` (
  `id_comentario` int(11) NOT NULL AUTO_INCREMENT,
  `comentario` varchar(600) NOT NULL,
  `fechaComentario` varchar(150) DEFAULT NULL,
  `id_producto` varchar(10) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `editado` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`id_comentario`),
  KEY `id_producto` (`id_producto`),
  KEY `id_usuario` (`id_usuario`),
  CONSTRAINT `tb_comentarios_ibfk_1` FOREIGN KEY (`id_producto`) REFERENCES `tb_productos` (`id_producto`),
  CONSTRAINT `tb_comentarios_ibfk_2` FOREIGN KEY (`id_usuario`) REFERENCES `tb_usuarios` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_comentarios`
--

LOCK TABLES `tb_comentarios` WRITE;
/*!40000 ALTER TABLE `tb_comentarios` DISABLE KEYS */;
/*!40000 ALTER TABLE `tb_comentarios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_compras`
--

DROP TABLE IF EXISTS `tb_compras`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tb_compras` (
  `id_compra` int(11) NOT NULL AUTO_INCREMENT,
  `id_usuario` int(11) NOT NULL,
  `departamento` varchar(250) NOT NULL,
  `municipio` varchar(250) NOT NULL,
  `telefono` int(11) NOT NULL,
  `barrio` varchar(250) NOT NULL,
  `direccion` varchar(250) NOT NULL,
  `fecha_de_compra` varchar(50) NOT NULL,
  `cliente` varchar(200) NOT NULL,
  `correo` varchar(200) NOT NULL,
  `total_compra` varchar(100) NOT NULL,
  PRIMARY KEY (`id_compra`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_compras`
--

LOCK TABLES `tb_compras` WRITE;
/*!40000 ALTER TABLE `tb_compras` DISABLE KEYS */;
INSERT INTO `tb_compras` VALUES (1,3,'Guaviare','San José del Guaviare',2147483647,'villa andrea','calel 26','2024-07-11 18:40:20','Pepito','pepito@gmail.com','50.000,00'),(8,3,'Guaviare','San Jose del Guaviare',2147483647,'villa andrea','calel 26','2024-06-11 19:44:05','Pepito','pepito@gmail.com','80.000,00'),(12,3,'Guaviare','San Jose del Guaviare',2147483647,'villa andrea','calel 26','2024-05-27 02:05:12 PM','Pepito','mike@gmail.com','3.220,00'),(13,4,'Guaviare','San Jose del Guaviare',2147483647,'Divino Niño','Calle 18#28-50','2024-07-30 11:40:07 AM','jhon hnery','henryjhon10@gmail.com','75.540,00'),(31,3,'Guaviare','Calamar',2147483647,'villa andrea','calel 26','2024-08-05 10:46:01 PM','pepito','pepito@gmail.com','2.500,00'),(32,3,'Guaviare','Calamar',2147483647,'villa andrea','calel 26','2024-08-05 10:51:48 PM','pepito','pepito@gmail.com','11.900,00'),(33,3,'Guaviare','Retorno',2147483647,'villa andrea','calel 26','2024-08-07 09:44:02 AM','pepito','pepito@gmail.com','2.500,00');
/*!40000 ALTER TABLE `tb_compras` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_departamentos`
--

DROP TABLE IF EXISTS `tb_departamentos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tb_departamentos` (
  `id_departamento` int(11) NOT NULL,
  `departamento` varchar(150) NOT NULL,
  PRIMARY KEY (`id_departamento`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_departamentos`
--

LOCK TABLES `tb_departamentos` WRITE;
/*!40000 ALTER TABLE `tb_departamentos` DISABLE KEYS */;
INSERT INTO `tb_departamentos` VALUES (95,'Guaviare');
/*!40000 ALTER TABLE `tb_departamentos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_facturas`
--

DROP TABLE IF EXISTS `tb_facturas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tb_facturas` (
  `id_factura` int(11) NOT NULL AUTO_INCREMENT,
  `id_compra` int(11) NOT NULL,
  `id_producto` varchar(10) NOT NULL,
  `producto` varchar(150) NOT NULL,
  `cantidades` int(11) NOT NULL,
  `sub_valor` varchar(150) NOT NULL,
  PRIMARY KEY (`id_factura`),
  KEY `id_compra` (`id_compra`),
  CONSTRAINT `tb_facturas_ibfk_1` FOREIGN KEY (`id_compra`) REFERENCES `tb_compras` (`id_compra`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_facturas`
--

LOCK TABLES `tb_facturas` WRITE;
/*!40000 ALTER TABLE `tb_facturas` DISABLE KEYS */;
INSERT INTO `tb_facturas` VALUES (1,1,'1','computadora',1,'1.200.000,00'),(6,8,'121212','GTA VI',4,'0,00'),(7,8,'12','computadora2',4,'200.000,00'),(10,12,'22','cepillo de ropa',1,'3.220,00'),(11,13,'21','silbato',3,'75.540,00'),(20,31,'1938','cuto',1,'2.500,00'),(21,32,'1938','cuto',2,'5.000,00'),(22,32,'21','silbato',2,'6.900,00'),(23,33,'1938','cuto',1,'2.500,00');
/*!40000 ALTER TABLE `tb_facturas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_historial`
--

DROP TABLE IF EXISTS `tb_historial`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tb_historial` (
  `idHistorial` int(11) NOT NULL AUTO_INCREMENT,
  `id_usuario` int(11) NOT NULL,
  `id_producto` varchar(10) NOT NULL,
  `fec_ver` varchar(150) NOT NULL,
  PRIMARY KEY (`idHistorial`),
  KEY `id_usuario` (`id_usuario`),
  KEY `id_producto` (`id_producto`),
  CONSTRAINT `tb_historial_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `tb_usuarios` (`id`),
  CONSTRAINT `tb_historial_ibfk_2` FOREIGN KEY (`id_producto`) REFERENCES `tb_productos` (`id_producto`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_historial`
--

LOCK TABLES `tb_historial` WRITE;
/*!40000 ALTER TABLE `tb_historial` DISABLE KEYS */;
INSERT INTO `tb_historial` VALUES (1,1,'01','2024-08-11 08:06:51 AM'),(2,1,'01','2024-08-11 08:07:42 AM'),(3,1,'01','2024-08-11 08:15:44 AM'),(4,1,'2','2024-08-11 08:16:03 AM'),(5,1,'3','2024-08-11 08:17:57 AM'),(6,1,'2','2024-08-11 08:24:20 AM'),(7,1,'9','2024-08-11 08:43:36 AM');
/*!40000 ALTER TABLE `tb_historial` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_historial_productos`
--

DROP TABLE IF EXISTS `tb_historial_productos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tb_historial_productos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `productoEliminado` varchar(80) NOT NULL,
  `id_producto` varchar(10) NOT NULL,
  `fecha_eli` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_historial_productos`
--

LOCK TABLES `tb_historial_productos` WRITE;
/*!40000 ALTER TABLE `tb_historial_productos` DISABLE KEYS */;
INSERT INTO `tb_historial_productos` VALUES (1,'Se Creo el producto: silbato','Codigo: 50','2024-07-18 07:33:22 AM'),(2,'Se ilimino el producto: silbato','Codigo: 50','2024-07-18 07:35:01 AM'),(3,'Se Creo el producto: cepillo de ropa','Codigo: 22','2024-07-19 08:13:48 AM'),(4,'Se Creo el producto: cepillo de dientes','Codigo: 25','2024-07-19 09:22:46 AM'),(5,'Se ilimino el producto: cepillo de dientes','Codigo: 25','2024-07-19 09:40:23 AM'),(6,'Se Creo el producto: cepillo de dientes','Codigo: 25','2024-07-19 09:41:12 AM'),(7,'Se ilimino el producto: cepillo de dientes','Codigo: 25','2024-07-19 09:41:26 AM'),(8,'Se Creo el producto: cepillo de dientes','Codigo: 25','2024-07-19 09:41:54 AM'),(9,'Se ilimino el producto: cepillo de dientes','Codigo: 25','2024-07-19 09:42:08 AM'),(10,'Se Creo el producto: cepillo de dientes','Codigo: 25','2024-07-19 09:53:52 AM'),(11,'Se ilimino el producto: cepillo de dientes','Codigo: 25','2024-07-19 09:54:12 AM'),(12,'Se Creo el producto: cuto','Codigo: 19','2024-07-30 11:44:44 AM'),(13,'Se Creo el producto: prubea','Codigo: 23','2024-08-01 10:59:52 AM'),(14,'Se ilimino el producto: silbato','Codigo: 23','2024-08-04 01:02:53 AM'),(15,'Se Creo el producto: prueba','Codigo: 55','2024-08-05 08:31:56 PM'),(16,'Se ilimino el producto: prueba','Codigo: 55','2024-08-05 08:32:06 PM'),(17,'Se Creo el producto: prueba','Codigo: 55','2024-08-05 08:34:14 PM'),(18,'Se ilimino el producto: prueba','Codigo: 55','2024-08-05 08:34:21 PM'),(19,'Se Creo el producto: prueba','Codigo: 55','2024-08-05 08:35:08 PM'),(20,'Se ilimino el producto: prueba','Codigo: 55','2024-08-05 08:35:30 PM'),(21,'Se ilimino el producto: Prueba','Codigo: 05','2024-08-08 08:35:26 AM'),(22,'Se Creo el producto: prueba','Codigo: 05','2024-08-08 08:35:44 AM'),(23,'Se ilimino el producto: prueba','Codigo: 05','2024-08-08 08:36:34 AM'),(24,'Se Creo el producto: Prueba','Codigo: 05','2024-08-08 08:37:00 AM'),(25,'Se ilimino el producto: Prueba','Codigo: 05','2024-08-08 08:37:57 AM'),(26,'Se ilimino el producto: silbato','Codigo: 21','2024-08-11 07:59:26 AM'),(27,'Se ilimino el producto: cepillo de ropa','Codigo: 22','2024-08-11 07:59:29 AM'),(28,'Se ilimino el producto: cuto','Codigo: 19','2024-08-11 07:59:31 AM'),(29,'Se Creo el producto: Auriculares Auraluxe Harmony 360','Codigo: 01','2024-08-11 08:06:42 AM'),(30,'Se Creo el producto: Gorra Capitán Trendy Flex','Codigo: 2','2024-08-11 08:14:46 AM'),(31,'Se Creo el producto: Teclado TechStorm Quantum X','Codigo: 3','2024-08-11 08:17:53 AM'),(32,'Se Creo el producto: Juego de ollas Culinary Elite Pro Set','Codigo: 4','2024-08-11 08:20:15 AM'),(33,'Se Creo el producto: Auriculares  EchoWave Precision 100','Codigo: 5','2024-08-11 08:21:47 AM'),(34,'Se Creo el producto: Zapatillas Vortex Glide X','Codigo: 6','2024-08-11 08:33:55 AM'),(35,'Se Creo el producto: Xbox 360','Codigo: 7','2024-08-11 08:36:16 AM'),(36,'Se Creo el producto: PlayStation 5','Codigo: 8','2024-08-11 08:37:45 AM'),(37,'Se Creo el producto: Nevera FrostMaster Elite 500','Codigo: 9','2024-08-11 08:43:27 AM'),(38,'Se Creo el producto: Disfraz de Hulk ','Codigo: 10','2024-08-11 08:47:36 AM'),(39,'Se Creo el producto: silbato','Codigo: 15','2024-08-12 08:07:43 AM'),(40,'Se ilimino el producto: silbato','Codigo: 15','2024-08-12 08:09:27 AM');
/*!40000 ALTER TABLE `tb_historial_productos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_municipios`
--

DROP TABLE IF EXISTS `tb_municipios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tb_municipios` (
  `id_municipio` int(11) NOT NULL,
  `id_departamento` int(11) NOT NULL,
  `municipio` varchar(150) NOT NULL,
  PRIMARY KEY (`id_municipio`),
  KEY `id_departamento` (`id_departamento`),
  CONSTRAINT `tb_municipios_ibfk_1` FOREIGN KEY (`id_departamento`) REFERENCES `tb_departamentos` (`id_departamento`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_municipios`
--

LOCK TABLES `tb_municipios` WRITE;
/*!40000 ALTER TABLE `tb_municipios` DISABLE KEYS */;
INSERT INTO `tb_municipios` VALUES (95000,95,'San Jose del Guaviare'),(95001,95,'Retorno'),(95100,95,'Miraflores'),(95102,95,'Calamar');
/*!40000 ALTER TABLE `tb_municipios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_ofertas`
--

DROP TABLE IF EXISTS `tb_ofertas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tb_ofertas` (
  `idOferta` int(11) NOT NULL AUTO_INCREMENT,
  `oferta` varchar(150) NOT NULL,
  PRIMARY KEY (`idOferta`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_ofertas`
--

LOCK TABLES `tb_ofertas` WRITE;
/*!40000 ALTER TABLE `tb_ofertas` DISABLE KEYS */;
INSERT INTO `tb_ofertas` VALUES (3,'no hay oferta'),(8,'5%');
/*!40000 ALTER TABLE `tb_ofertas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_productos`
--

DROP TABLE IF EXISTS `tb_productos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tb_productos` (
  `id_producto` varchar(10) NOT NULL,
  `producto_nombre` varchar(80) DEFAULT NULL,
  `descripcion_producto` varchar(160) DEFAULT NULL,
  `caracteristicas_producto` varchar(500) DEFAULT NULL,
  `cantidades` int(11) DEFAULT NULL,
  `id_ofertas` int(11) DEFAULT NULL,
  `img` varchar(200) DEFAULT NULL,
  `precio` varchar(200) DEFAULT NULL,
  `color` varchar(150) NOT NULL,
  `fec_cre` varchar(150) DEFAULT NULL,
  `editado_produto` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`id_producto`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_productos`
--

LOCK TABLES `tb_productos` WRITE;
/*!40000 ALTER TABLE `tb_productos` DISABLE KEYS */;
INSERT INTO `tb_productos` VALUES ('01','Auriculares Auraluxe Harmony 360','¡Descubre los Auraluxe Harmony 360! Estos auriculares de última generación están diseñados para ofrecer una experiencia auditiva incomparable. Con la tecnología','Sonido Hi-Fi: Drivers de 40mm para un audio nítido y graves profundos.Cancelación de Ruido Activa: Reduce el ruido ambiental en un 95% para una experiencia inmersiva.Conectividad Bluetooth 5.3: Conexión estable y rápida, hasta 30 horas de batería continua.Comodidad Ergonómica: Almohadillas de memoria que se ajustan a la forma de tus oídos para un uso prolongado sin molestias.Control Táctil: Ajusta el volumen, cambia de pista y responde llamadas con un simple toque.Eleva tu experiencia ',25,0,'../../fotos/cascos.jpg','172.500,00','Blanco','2024-08-11 08:06:42 AM','2024-08-11 08:15:57 AM'),('10','Disfraz de Hulk ','Transforma tu fiesta con el Hulk Smash Deluxe Costume! Este disfraz ofrece una transformación impresionante y llena de fuerza.','Traje Completo: Incluye el icónico traje verde musculoso con detalles en 3D para un look auténtico y poderoso.\r\nMáscara Detallada: Máscara de latex con características realistas del rostro del Hulk, incluyendo cabello sintético.\r\nGuantes y Botas: Accesorios que complementan el disfraz, haciendo que tu transformación sea completa.\r\nCómodo y Ajustable: Material elástico que se adapta a diferentes tamaños y proporciona comodidad durante todo el evento.',15,0,'../../fotos/disfraz hulk.jpg','117.600,00','verde','2024-08-11 08:47:36 AM',NULL),('2','Gorra Capitán Trendy Flex','La Capitán Trendy Aura es la gorra que redefine el estilo urbano. Diseñada para destacar, combina tecnología y moda para llevar tu look al siguiente nivel.','Ajuste Personalizable: Cierre de velcro para un fit exacto y cómodo.Tela Breathable: Mezcla de lino y microfibra que mantiene tu cabeza fresca y ventilada.Visera Inteligente: Protección UV con absorción de impactos, ideal para tus días más activos.Estilo Futurista: Logo con detalles holográficos que cambian de color según la luz, y acabados en relieve que marcan la diferencia.',105,0,'../../fotos/gorra.jpg','105.000,00','Amarillo','2024-08-11 08:14:46 AM','2024-08-11 08:24:14 AM'),('3','Teclado TechStorm Quantum X','\r\nEl TechStorm Quantum X transforma tu experiencia de tecleo con un diseño que mezcla innovación y estilo. Ideal para gamers y profesionales que buscan lo mejor','Switches de Alta Respuesta: Mecánicos con retroalimentación táctil para una escritura rápida y precisa.\r\nRetroiluminación RGB: Personaliza cada tecla con una amplia gama de colores y efectos dinámicos.\r\nConstrucción Robusta: Chasis de aluminio y teclas duraderas para un rendimiento sólido y una larga vida útil.\r\nReposamuñecas Ergonómico: Comodidad prolongada con soporte acolchado para sesiones largas de escritura o juego.',40,0,'../../fotos/teclado.jpg','142.380,00','Negro','2024-08-11 08:17:53 AM',NULL),('4','Juego de ollas Culinary Elite Pro Set','Culinary Elite Pro Set, el juego de ollas que lleva tu cocina al siguiente nivel. Perfecto para chefs caseros que buscan calidad y rendimiento excepcionales.','Acero Inoxidable de Alta Calidad: Resistente y duradero, distribuye el calor de manera uniforme.\r\nTapa de Vidrio Temperado: Con salida de vapor y borde de acero inoxidable para una visión clara sin perder calor.\r\nMango Ergonómico: Mangos con diseño antideslizante y resistentes al calor para un manejo cómodo y seguro.\r\nCompatibilidad Universal: Adecuado para todo tipo de estufas, incluyendo inducción.',30,0,'../../fotos/juego de ollas.webp','450.000,00','Negro','2024-08-11 08:20:15 AM',NULL),('5','Auriculares  EchoWave Precision 100','Conquista el sonido con los EchoWave Precision 100. Estos auriculares con cable están diseñados para quienes buscan una experiencia auditiva inigualable y un es','Sonido de Alta Fidelidad: Drivers de 50mm para una claridad acústica excepcional y graves profundos.\r\nConexión de 3.5mm: Compatibilidad universal con todos tus dispositivos, desde teléfonos hasta computadoras.\r\nDiseño Ergonómico: Almohadillas de espuma con memoria y diadema ajustable para un ajuste cómodo durante horas.\r\nMicrófono Integrado: Controla tu música y atiende llamadas con un micrófono claro y accesible en el cable.',50,0,'../../fotos/auriculares.png','15.000,00','Negro','2024-08-11 08:21:47 AM',NULL),('6','Zapatillas Vortex Glide X','Las Vortex Glide X son las zapatillas que redefinen tu comodidad y estilo. Perfectas para cualquier ocasión, desde entrenamientos intensos hasta salidas casuale','Amortiguación Avanzada: Tecnología de absorción de impactos en la suela para una pisada suave y cómoda.\r\nMaterial Transpirable: Parte superior de malla técnica que mantiene tus pies frescos y secos.\r\nDiseño Ergonómico: Plantilla contorneada que se ajusta a la forma de tu pie para un soporte personalizado.\r\nSuela Antideslizante: Tracción optimizada para estabilidad en cualquier superficie.',25,0,'../../fotos/zapatillas.webp','207.000,00','Blanco con Negro','2024-08-11 08:33:55 AM',NULL),('7','Xbox 360','Disfruta la experiencia de gaming con el Xbox 360. Esta consola sigue siendo un clásico para jugadores de todas las edades.','Extensa Biblioteca de Juegos: Accede a una vasta colección de títulos, desde aventuras épicas hasta emocionantes shooters.\r\nXbox Live: Conéctate con amigos y jugadores de todo el mundo para partidas en línea y contenido descargable.\r\nReproductor de Medios: Disfruta de DVDs y música con opciones de entretenimiento versátiles.\r\nDiseño Compacto: Elegante y fácil de integrar en cualquier configuración de entretenimiento.',20,0,'../../fotos/xbox360.webp','446.250,00','negro','2024-08-11 08:36:16 AM',NULL),('8','PlayStation 5','Eleva tu experiencia de gaming con el PlayStation 5. La consola que redefine el entretenimiento interactivo con tecnología de vanguardia y un diseño futurista.','Gráficos Ultra HD: Procesador potente y tarjeta gráfica avanzada para imágenes nítidas y realistas en 4K.\r\nCarga Rápida: Disco SSD de alta velocidad que reduce los tiempos de carga y mejora el rendimiento.\r\nDualSense Controller: Mandos con retroalimentación háptica y gatillos adaptativos que ofrecen una inmersión sin precedentes.\r\nAudio 3D: Sonido envolvente que te sumerge en el corazón de la acción',15,0,'../../fotos/ps5.webp','1.150.000,00','Blanco','2024-08-11 08:37:45 AM',NULL),('9','Nevera FrostMaster Elite 500','Transforma tu cocina con la FrostMaster Elite 500. Esta nevera ofrece eficiencia y estilo, manteniendo tus alimentos frescos y organizados.','Tecnología de Enfriamiento Avanzada: Sistema de refrigeración de última generación que asegura una temperatura uniforme y eficiente.Diseño de Puerta Francesa: Elegante y funcional, con compartimientos de fácil acceso y estantes ajustables.Control de Temperatura Digital: Pantalla LED para ajustes precisos y monitoreo constante.Cajón de Congelación Rápida: Ideal para almacenar y mantener alimentos congelados a la perfección.',15,0,'../../fotos/nevera.webp','1.380.000,00','Negro','2024-08-11 08:43:27 AM','2024-08-11 08:43:47 AM');
/*!40000 ALTER TABLE `tb_productos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_respuestascomentarios`
--

DROP TABLE IF EXISTS `tb_respuestascomentarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tb_respuestascomentarios` (
  `idRespuesta` int(11) NOT NULL AUTO_INCREMENT,
  `idComentario` int(11) NOT NULL,
  `repuesta` varchar(250) NOT NULL,
  `idUsuario` int(11) NOT NULL,
  `fech_repuesta` varchar(150) NOT NULL,
  `editado` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`idRespuesta`),
  KEY `idComentario` (`idComentario`),
  KEY `idUsuario` (`idUsuario`),
  CONSTRAINT `tb_respuestascomentarios_ibfk_1` FOREIGN KEY (`idComentario`) REFERENCES `tb_comentarios` (`id_comentario`),
  CONSTRAINT `tb_respuestascomentarios_ibfk_2` FOREIGN KEY (`idUsuario`) REFERENCES `tb_usuarios` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_respuestascomentarios`
--

LOCK TABLES `tb_respuestascomentarios` WRITE;
/*!40000 ALTER TABLE `tb_respuestascomentarios` DISABLE KEYS */;
/*!40000 ALTER TABLE `tb_respuestascomentarios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_usuarios`
--

DROP TABLE IF EXISTS `tb_usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tb_usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(60) NOT NULL,
  `apellido` varchar(60) NOT NULL,
  `email` varchar(260) NOT NULL,
  `pasword` varchar(100) NOT NULL,
  `fecha_registro` varchar(50) NOT NULL,
  `cate_user` int(11) NOT NULL,
  `status_user` varchar(10) DEFAULT NULL,
  `foto_usuarios` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_usuarios`
--

LOCK TABLES `tb_usuarios` WRITE;
/*!40000 ALTER TABLE `tb_usuarios` DISABLE KEYS */;
INSERT INTO `tb_usuarios` VALUES (1,'mike','sanchez','mike@gmail.com','$2y$12$mUSwt.wc2rBxRwh5A7MsO.uKtqo3XhTxnYnFXFW01NyZJitdd10h2','2024-08-05 10:09:10 PM',0,'Activo','../../img_user/planeta-tierra-vista-desde-la-luna_1280x720_xtrafondos.com.jpg'),(2,'juan','Ramos','juan@gmail.com','$2y$12$NTm7Ax3sNLTS9RsSESRNxu9DR2Fof0OaU3uoZ6uw97.Hs/Dt8F6IC','2024-08-05 10:11:20 PM',0,'Inactivo','../../img/logo-icon-person.jpg'),(3,'pepito','perez','pepito@gmail.com','$2y$12$wunWT3AaPnKhqKB5ccNLNOqEtXzIra9HtL1K96t4di8VRUK492uTy','2024-08-05 10:11:51 PM',2,'Inactivo','../../img_user/perfil.jpg');
/*!40000 ALTER TABLE `tb_usuarios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_valoracion`
--

DROP TABLE IF EXISTS `tb_valoracion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tb_valoracion` (
  `id_valoracion` int(11) NOT NULL AUTO_INCREMENT,
  `id_producto` varchar(10) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `valoracion` varchar(100) NOT NULL,
  PRIMARY KEY (`id_valoracion`),
  KEY `id_producto` (`id_producto`),
  KEY `id_usuario` (`id_usuario`),
  CONSTRAINT `tb_valoracion_ibfk_1` FOREIGN KEY (`id_producto`) REFERENCES `tb_productos` (`id_producto`),
  CONSTRAINT `tb_valoracion_ibfk_2` FOREIGN KEY (`id_usuario`) REFERENCES `tb_usuarios` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_valoracion`
--

LOCK TABLES `tb_valoracion` WRITE;
/*!40000 ALTER TABLE `tb_valoracion` DISABLE KEYS */;
/*!40000 ALTER TABLE `tb_valoracion` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-08-12  8:10:58
