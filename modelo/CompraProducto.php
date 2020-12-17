<?php
include 'conexion.php';
class CompraProducto{
    var $objetos;
    public function __construct(){
        $db=new conexion();
        $this->acceso=$db->pdo;
    }
    
    function ver($id){
        $sql="SELECT precio,cantidad,producto.nombre as producto,concentrancion,adicional,laboratorio.nombre as laboratorio,presentacion.tipo as presentacion,
        tipoproducto.caracteristica as tipo,subtotal
         FROM ventaproducto 
        JOIN producto on producto_idproducto = idproducto and venta_idventa=:id
        join laboratorio on laboratorio_idlaboratorio=idlaboratorio
        join tipoproducto on tipoproducto_idtipoproducto=idtipoproducto
        join presentacion on presentacion_idpresentacion=idpresentacion ";
        $query = $this->acceso->prepare($sql);
        $query->execute(array('id'=>$id));
        $this->objetos = $query->fetchall();
        
        return $this->objetos;
    }
}