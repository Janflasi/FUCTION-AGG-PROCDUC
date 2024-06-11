create database registar;
use registar;

select*from categoria;
select*from productos;
CREATE TABLE productos (
  id_producto INT NOT NULL AUTO_INCREMENT,
  nombre_producto VARCHAR(100) NOT NULL,
  precio DECIMAL(10,2) NOT NULL,
  impuesto INT DEFAULT NULL,
  stock INT DEFAULT NULL,
  id_categoria INT NOT NULL,
  imagen_producto VARCHAR(255) DEFAULT NULL, 
  PRIMARY KEY (id_producto),
  FOREIGN KEY (id_categoria) REFERENCES categoria(id_categoria)
);
ALTER TABLE productos
ADD COLUMN descuento DECIMAL(10,2),
ADD COLUMN descripcion TEXT;



CREATE TABLE categoria (
  id_categoria INT NOT NULL AUTO_INCREMENT,
  nombre_categoria VARCHAR(100) NOT NULL,
  PRIMARY KEY (id_categoria)
);

INSERT INTO categoria (nombre_categoria) VALUES ('Categoría 1'), ('Categoría 2'), ('Categoría 3');
DROP database registar;