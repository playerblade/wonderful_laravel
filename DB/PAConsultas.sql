show procedure status;

DROP PROCEDURE listarEstudiantes;

-- 1. Listar aquellas categoorias que tegan mas de 10 productos. 
DELIMITER /
CREATE PROCEDURE listaDeCategoriasQueTenganMasDe(IN numero int(15))

BEGIN 
    select c.nombre as Categoria, count(p.nombre) as cantidadProducto
    from categoria c inner join producto p
    on c.idCategoria = p.idCategoria
    group by c.nombre
    having count(p.nombre)>numero
    order by  p.nombre;
END/

CALL listaDeCategoriasQueTenganMasDe(10)/

-- 2. Listar aquellos cajeros cuyo monto de ventas sea mayor a 1500 Bs en la fecha 14 Septiembre del 2019.

DELIMITER /
CREATE PROCEDURE CajerosCuyoMontoDeVenta(IN fechaDia int(10),
                                         IN fechaMes int(10),
                                         IN fechaAnio int(10),
                                         IN montoVentaMayorA int(10))
BEGIN
    select concat_ws(' ',u.apellidoPaterno,u.apellidoMaterno,u.segundoNombre,u.primerNombre) as Cajero, 
       sum(p.montoTotalPedido)as MontoDeVenta
    from rol r inner join usuario u
    on r.idRol = u.idRol 
    inner join pedido p
    on u.idUsuario = p.idUsuarioCajero
    and day(p.fechaHoraOrdenPedido) = fechaDia
    and month(p.fechaHoraOrdenPedido) = fechaMes
    and year(p.fechaHoraOrdenPedido) = fechaAnio
    group by u.idUsuario
    having sum(p.montoTotalPedido) > montoVentaMayorA;
END /

CALL CajerosCuyoMontoDeVenta(14,09,2019,1500)/

-- 3. lista de la cantidad de pedidos con su nombre y categoria
DROP PROCEDURE NameProductCategoriaYCantidadPedido;
DELIMITER /
CREATE PROCEDURE NameProductCategoriaYCantidadPedido(IN nombreCategoria VARCHAR(25))
BEGIN
    select c.nombre as Categoria, p.nombre as Producto, d.cantidad AS CantidadPedido
    from categoria c INNER JOIN producto p
    ON c.idCategoria = p.idCategoria
    INNER JOIN detallePedido d
    ON p.idProducto = d.idProducto
    HAVING c.nombre = nombreCategoria
    order by p.nombre;
END/
DELIMITER /
CALL NameProductCategoriaYCantidadPedido('Refresco Natural')/
CALL NameProductCategoriaYCantidadPedido('Helado')/
CALL NameProductCategoriaYCantidadPedido('Hamburguesa')/
CALL NameProductCategoriaYCantidadPedido('Platos')/

-- 4. Insertar Cliente
DELIMITER /
CREATE PROCEDURE InsertarCliente (
    IN idSucursal INT(11),
    IN ci VARCHAR(15),
    IN nit VARCHAR(15),
    IN primerNombre VARCHAR(15),
    IN segundoNombre VARCHAR(15),
    IN apellidoPaterno VARCHAR(15),
    IN apellidoMaterno VARCHAR(15)
)
BEGIN
 
    INSERT INTO cliente(idSucursal, ci,nit,primerNombre,segundoNombre,apellidoPaterno,apellidoMaterno) 
    VALUES (idSucursal, ci,nit,primerNombre,segundoNombre,apellidoPaterno,apellidoMaterno);

    SELECT * FROM cliente;

END/

CALL InsertarCliente(1,'7505704','112233445','Maria','Luz','Lorena','Mendez')/


