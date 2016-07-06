SELECT * FROM clase;
SELECT * FROM producto_lote;
SELECT * FROM parte_entrada_detalle;
SELECT * FROM detalle_venta;
SELECT * FROM venta;
SELECT * FROM detalle_venta;
SELECT * FROM logs order by id desc;
SELECT * FROM config;
SELECT * FROM users;
SELECT * FROM clientes;
SELECT * FROM proveedores;
SELECT * FROM categoria;
SELECT * FROM productos;
SELECT * FROM kardex;
-- ###############
DESC detalle_venta;
DESC venta;
DESC config;
DESC logs;
DESC kardex;
DESC marca;
DESC parte_entrada_detalle;
DESC parte_entrada;
DESC producto_lote;
DESC productos;
DESC proveedores;


INSERT INTO `config`
(`empresa`,`ruc`,`direccion`,`serie_boleta`,`correlativo_boleta`,`serie_factura`,`correlativo_factura`)
VALUES('Chocolates Linaje','20102187277','Los Olivos',1,100,1,200);

INSERT INTO `users` VALUES (1,'Dxny','De la Cruz','42968274','dany@delacruz.pe','admin','ddelacruz','SMP','Programador','970750078','','$2y$10$WIhNGOCvWqFIjSZCOlkJRuPA45WjBMJ/LegatjDMQud7KbMknV2n6','GWeKFxuU2J5mdPWv7rA0EO58zWUB806NPGNOi98nrRc9LSuo6y0LOFWbpgX6','2015-10-09 22:21:58','2015-10-10 18:19:36')

