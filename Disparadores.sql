DELIMITER //
CREATE TRIGGER tr_updCantidadEgreso AFTER INSERT ON detalle_egreso
FOR EACH ROW BEGIN
UPDATE articulos SET cantidad = cantidad - NEW.cantidad
WHERE articulos.codigo = NEW.cod_articulo;
END
//
DELIMITER ;