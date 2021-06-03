CREATE DATABASE db_lines;

USE db_lines;

CREATE TABLE usuario/*Listo*/
(
    id int AUTO_INCREMENT NOT NULL,
    tipo_usuario char(3) NOT NULL,
    correo varchar(50) NOT NULL,
    contrasena varchar(60) NOT NULL,
    CONSTRAINT uq_correo UNIQUE (correo),
    CONSTRAINT pk_usuario PRIMARY KEY (id)
)ENGINE = InnoDB;

CREATE TABLE cliente/*Listo*/
(
    id int AUTO_INCREMENT NOT NULL,
    usuario_id int NOT NULL,
    tipo_cliente char(3) NOT NULL,
    nombre varchar(50) NOT NULL,
    sexo varchar(3) NULL,
    correo varchar(50) NOT NULL,
    telefono varchar(13) NULL,
    calle_numero varchar(60) NULL,
    colonia varchar(60) NULL,
    municipio varchar(60) NULL,
    codigo_postal char(5) NULL,
    saldo varchar(20) NOT NULL,
    CONSTRAINT uq_correo UNIQUE (correo),
    CONSTRAINT pk_cliente PRIMARY KEY (id),
    CONSTRAINT fk_cliente_usuario FOREIGN KEY (usuario_id) REFERENCES usuario (id)
)ENGINE = InnoDB;

CREATE TABLE pedido /*Listo*/
(
    id int AUTO_INCREMENT NOT NULL,
    fecha dateTime NOT NULL, 
    proveedor_id INT NOT NULL,
    descripcion varchar(255) NOT NULL,
    monto decimal(12,2) NOT NULL,
    CONSTRAINT pk_pedido PRIMARY KEY (id, fecha),
    CONSTRAINT fk_pedido_proveedor FOREIGN KEY (proveedor_id) REFERENCES proveedor (id)
)ENGINE = InnoDB;

CREATE TABLE opciones /*Listo*/
(
    id Int AUTO_INCREMENT NOT NULL,
    descripcion varchar(255) NOT NULL,
    CONSTRAINT pk_opciones PRIMARY KEY (id)
)ENGINE = InnoDB;


CREATE TABLE opciones_archivo /*Listo*/
(
    id Int AUTO_INCREMENT NOT NULL,
    fecha dateTime NOT NULL,
    opciones_id INT NOT NULL,
    archivo_id INT NOT NULL,
    CONSTRAINT pk_opcionArc PRIMARY KEY (id, fecha),
    CONSTRAINT fk_opcionArc_opc FOREIGN KEY (opciones_id) REFERENCES opciones(id),
    CONSTRAINT fk_opcionArc_arc FOREIGN KEY (archivo_id) REFERENCES archivo(id)
)ENGINE = InnoDB;

CREATE TABLE archivo /*Listo*/
(
    id Int AUTO_INCREMENT NOT NULL,
    cliente_id int NOT NULL,
    pedido_id int NOT NULL,
    nombre varchar(255) NOT NULL,
    tipo varchar(50) NOT NULL,
    tamano varchar(255) NOT NULL,
    fecha dateTime NOT NULL,
    CONSTRAINT pk_archivo PRIMARY KEY (id),
    CONSTRAINT fk_archivo_cliente FOREIGN KEY (cliente_id) REFERENCES cliente(id),
    CONSTRAINT fk_archivo_pedido FOREIGN KEY (pedido_id) REFERENCES pedido(id)
)ENGINE = InnoDB;

CREATE TABLE proveedor /*Listo*/
(
    id Int AUTO_INCREMENT NOT NULL,
    nombre varchar(255) NOT NULL,
    rfc char(13) NOT NULL,
    correo varchar(50) NOT NULL,
    telefono varchar(13) NOT NULL,
    calle_numero varchar(60) NOT NULL,
    colonia varchar(60) NOT NULL,
    municipio varchar(60) NOT NULL,
    codigo_postal char(5) NOT NULL,
    estado char(3) NOT NULL,
    ubicacion_maps char(255) NOT NULL,
    CONSTRAINT pk_proveedor PRIMARY KEY (id)
)ENGINE = InnoDB;

CREATE TABLE servicio /*Listo*/
(
    id int AUTO_INCREMENT NOT NULL,
    proveedor_id int NOT NULL,
    status char(3) NOT NULL,
    descripcion varchar(60) NOT NULL,
    precio_unitario decimal(12,2) NOT NULL,
    comision_menudeo decimal(12,2) NOT NULL,
    CONSTRAINT pk_servicio PRIMARY KEY (id),
    CONSTRAINT fk_servicio_proveedor FOREIGN KEY (proveedor_id) REFERENCES proveedor(id)
)ENGINE = InnoDB;

CREATE TABLE detalles /*Listo*/
(
    id int AUTO_INCREMENT NOT NULL,
    detalles varchar(255) NOT NULL,
    CONSTRAINT pk_detalles PRIMARY KEY (id)
)ENGINE = InnoDB;

CREATE TABLE servicio_detalles /*Listo*/
(
    id int AUTO_INCREMENT NOT NULL,
    fecha dateTime NOT NULL,
    servicio_id int NOT NULL,
    detalles_id int NOT NULL,
    CONSTRAINT pk_det_serv PRIMARY KEY (id, fecha),
    CONSTRAINT fk_serDet_servicio FOREIGN KEY (servicio_id) REFERENCES servicio(id),
    CONSTRAINT fk_serDet_detalles FOREIGN KEY (detalles_id) REFERENCES detalles(id)
)ENGINE = InnoDB;

CREATE TABLE adicional /*Listo*/
(
    id int AUTO_INCREMENT NOT NULL,
    descripcion varchar(255) NOT NULL,
    unidad char(4) NOT NULL,
    precio_mayoreo decimal(12,2) NOT NULL,
    cantidad_mayoreo decimal(12,2) NOT NULL,
    comision_mayoreo decimal(12,2) NOT NULL,
    CONSTRAINT pk_adicional PRIMARY KEY (id)
)ENGINE = InnoDB;

CREATE TABLE servicio_adicional /*Listo*/
(
    id int AUTO_INCREMENT NOT NULL,
    fecha dateTime NOT NULL,
    servicio_id int NOT NULL,
    adicional_id int NOT NULL,
    CONSTRAINT pk_det_serv PRIMARY KEY (id, fecha),
    CONSTRAINT fk_serAdi_servicio FOREIGN KEY (servicio_id) REFERENCES servicio(id),
    CONSTRAINT fk_serAdi_adicional FOREIGN KEY (adicional_id) REFERENCES adicional(id)
)ENGINE = InnoDB;

CREATE TABLE producto /*Listo*/
(
    id int AUTO_INCREMENT NOT NULL,
    proveedor_id int NOT NULL,
    descripcion varchar(255) NOT NULL,
    unidad char(4) NOT NULL,
    precio_unitario decimal(7,2) NOT NULL,
    precio_mayoreo decimal(7,2) NOT NULL,
    CONSTRAINT pk_producto PRIMARY KEY (id),
    CONSTRAINT fk_prod_prov FOREIGN KEY (proveedor_id) REFERENCES proveedor (id)
)ENGINE = InnoDB;


CREATE TABLE servicio_default 
(
    id int AUTO_INCREMENT NOT NULL,
    servicio_def varchar(60) NOT NULL,
    categoria varchar(30) NOT NULL,
    CONSTRAINT pk_servicio_default PRIMARY KEY (id)
)ENGINE = InnoDB;


CREATE TABLE servicioDef_proveedor /*Listo*/
(
    id int AUTO_INCREMENT NOT NULL,
    fecha dateTime NOT NULL,
    servicio_default_id int NOT NULL,
    proveedor_id int NOT NULL,
    status char(3) NOT NULL,
    SKU varchar(5) NOT NULL,
    descripcion varchar(60) NOT NULL,
    precio_unitario decimal(12,2) NOT NULL,
    comision_menudeo decimal(12,2) NOT NULL,
    CONSTRAINT pk_servDef_pro PRIMARY KEY (id, fecha),
    CONSTRAINT fk_serDefPro_servicioDef FOREIGN KEY (servicio_default_id) REFERENCES servicio_default(id),
    CONSTRAINT fk_serDefPro_proveedor FOREIGN KEY (proveedor_id) REFERENCES proveedor(id)
)ENGINE = InnoDB;


/*Modificaciones a las tablas*/

/*Agregar Servicio_id a Archvos*/

ALTER TABLE _ ADD CONSTRAINT _ FOREIGN KEY() REFERENCES X();

ALTER TABLE archivo ADD CONSTRAINT fk_archivo_servicio FOREIGN KEY(servicio_id) REFERENCES servicio(id);

ALTER TABLE archivo ADD CONSTRAINT fk_archivo_servicioDef_proveedor FOREIGN KEY (servicioDef_proveedor_id) REFERENCES servicioDef_proveedor(id);  

SELECT * FROM archivo INNER JOIN servicio ON archivo.servicio_id = servicio.id WHERE id='1' 
    
-- CREATE TRIGGER trigger_name
-- {BEFORE | AFTER} {INSERT | UPDATE| DELETE }
-- ON table_name FOR EACH ROW
-- trigger_body;

CREATE TRIGGER upload_file LATER 
    BEFORE UPDATE ON archivo
    FOR EACH ROW
INSERT INTO archivo SET
SET 


/*CUAL ES LA LÓGICA PARA PARA INSERTAR EL ARCHIVO
EL CLIENTE
1) SE CARGA EL ARCHIVO
2) SE SELECCIONAN LAS CARACTERISTICAS
3) SE ENVIA AL SERVIDOR
DENTRO DEL SERVIDOR
0) RECIBIR EL ARCHIVO Y LA INFORMACION ASOCIADA 
1) SE CREA EL PEDIDO (INSERT folio(pedido) dentro de la tabla pedido)
2) SE INSERTA EL ARCHIVO TOMANDO EL PEDIDO ANTERIORMENTE GENERADO Y SE TOMA EL SERVICIO_ID EN DONNDE VIENE EL P.U. DEL SERVICIO PARTICULAR
3) SE  GUARDA EL ARCHIVO EN BASE DE DATOS
4) SE ACTUALIZA EL MONTO 
*/

CREATE TRIGGER upload_file
ON archivo
AFTER UPDATE, INSERT,DELETE
AS
BEGIN
	UPDATE 	pedido
	SET 	Total = Total + Total_Detalles
	FROM 	(
			SELECT Factura AS Fct, SUM(Total) AS Total_Detalles  
			FROM	(
					SELECT Factura, Total  FROM Inserted
					UNION ALL
					SELECT Factura, -Total FROM Deleted
					) T
			GROUP BY Factura
			) A
	WHERE  Factura = Fct;
END;

INSERT INTO `servicio_default`(`id`, `servicio_def`, `categoria`) VALUES (NULL,'A01','SIZE_PAPER');
INSERT INTO `servicio_default`(`id`, `servicio_def`, `categoria`) VALUES (NULL,'A02','SIZE_PAPER');
INSERT INTO `servicio_default`(`id`, `servicio_def`, `categoria`) VALUES (NULL,'A03','SIZE_PAPER');
INSERT INTO `servicio_default`(`id`, `servicio_def`, `categoria`) VALUES (NULL,'A04','SIZE_PAPER');
INSERT INTO `servicio_default`(`id`, `servicio_def`, `categoria`) VALUES (NULL,'A05','SIZE_PAPER');
INSERT INTO `servicio_default`(`id`, `servicio_def`, `categoria`) VALUES (NULL,'A06','SIZE_PAPER');
INSERT INTO `servicio_default`(`id`, `servicio_def`, `categoria`) VALUES (NULL,'A07','SIZE_PAPER');
INSERT INTO `servicio_default`(`id`, `servicio_def`, `categoria`) VALUES (NULL,'A08','SIZE_PAPER');
INSERT INTO `servicio_default`(`id`, `servicio_def`, `categoria`) VALUES (NULL,'A09','SIZE_PAPER');
INSERT INTO `servicio_default`(`id`, `servicio_def`, `categoria`) VALUES (NULL,'A010','SIZE_PAPER')


INSERT INTO `serviciodef_proveedor`(`id`, `fecha`, `servicio_default_id`, `proveedor_id`, `status`, `precio_unitario`, `comision_menudeo`) 
VALUES (NULL, NOW(), 2, 1,'ACT',0.30, 0.06);

INSERT INTO `serviciodef_proveedor`(`id`, `fecha`, `servicio_default_id`, `proveedor_id`, `status`, `precio_unitario`, `comision_menudeo`) 
VALUES (NULL, NOW(), 3, 1,'ACT',0.35, 0.07);

INSERT INTO `serviciodef_proveedor`(`id`, `fecha`, `servicio_default_id`, `proveedor_id`, `status`, `precio_unitario`, `comision_menudeo`) 
VALUES (NULL, NOW(), 4, 1,'ACT',0.40, 0.08);

INSERT INTO `serviciodef_proveedor`(`id`, `fecha`, `servicio_default_id`, `proveedor_id`, `status`, `precio_unitario`, `comision_menudeo`) 
VALUES (NULL, NOW(), 1, 2,'ACT',0.35, 0.07);

INSERT INTO `serviciodef_proveedor`(`id`, `fecha`, `servicio_default_id`, `proveedor_id`, `status`, `precio_unitario`, `comision_menudeo`) 
VALUES (NULL, NOW(), 2, 2,'ACT',0.40, 0.08);
 
/*INNER JOIN*/
SELECT *  /*Lo que se quiere mostrar en pantalla*/
FROM table_A /*tabla origen*/
INNER JOIN table_B /*tabla a comparar*/
ON table_A.varA = table_B.varA /*variable en comun en ambas tablas*/
WHERE cond="x"; /*Condición que se cumpla en alguna de las tablas*/


/*Servicio Default por proveedor*/
SELECT servicio_default.id, servicio_default.servicio_def
FROM servicio_default
INNER JOIN serviciodef_proveedor
ON servicio_default.id = serviciodef_proveedor.servicio_default_id
WHERE proveedor_id=1 AND categoria='PRINT' AND status='ACT'
ORDER BY servicio_default.id;


SELECT sp.id, sp.fecha, sp.proveedor_id, sp.precio_unitario
FROM serviciodef_proveedor AS sp
WHERE proveedor_id = 2 AND sp.servicio_default_id = 3;



INSERT INTO archivo (id, cliente_id, pedido_id, servicio_id, nombre, tipo, tamano, color, orientacion, from_x, to_y,  fecha) 
VALUES (NULL, 1, 4250, 2, 'Segunda+Forma+Normal+2NF.pdf', 'application/pdf', 2, 12, 'LAN', 1212, 2500, NOW();
