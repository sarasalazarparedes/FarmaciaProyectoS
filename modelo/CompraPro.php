<?php
include 'conexion.php';
class CompraPro{
    var $objetos;
    public function __construct(){
        $db=new conexion();
        $this->acceso=$db->pdo;
    }
    function Crear($proveedor,$fecha,$producto,$cantidad,$precio,$laboratorio,$presentacion,$total){
        $sql="INSERT INTO compra (proveedor,fecha,producto,cantidad,precio,laboratorio,presentacion,total)  values (:proveedor,:fecha,:producto,:cantidad,:precio,:laboratorio,:presentacion,:total)";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':proveedor'=>$proveedor,':fecha'=>$fecha,':producto'=>$producto,':cantidad'=>$cantidad,':precio'=>$precio,':laboratorio'=>$laboratorio,':presentacion'=>$presentacion,':total'=>$total));
       
        
    }
    function ultima_venta(){
        $sql="SELECT MAX(idcompra) as ultima_compra FROM compra";
        $query = $this->acceso->prepare($sql);
        $query->execute();
        $this->objetos = $query->fetchall();
        return $this->objetos;
    }
    function borrar($id_compra){
        $sql="DELETE FROM compra where idcompra=:id_compra";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id_compra'=>$id_compra));

    }
}