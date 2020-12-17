<?php
include 'conexion.php';
class Venta{
    var $objetos;
    public function __construct(){
        $db=new conexion();
        $this->acceso=$db->pdo;
    }
    function Crear($nombre,$dni,$total,$fecha,$vendedor){
        $sql="INSERT INTO venta (fecha,cliente,dni,total,usuario_idusuario)  values (:fecha,:cliente,:dni,:total,:usuario_idusuario)";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':fecha'=>$fecha,':cliente'=>$nombre,':dni'=>$dni,':total'=>$total,':usuario_idusuario'=>$vendedor));
       
        
    }
    function ultima_venta(){
        $sql="SELECT MAX(idventa) as ultima_venta FROM venta ";
        $query = $this->acceso->prepare($sql);
        $query->execute();
        $this->objetos = $query->fetchall();
        return $this->objetos;
    }
    function borrar($id_venta){
        $sql="DELETE FROM venta where idventa=:id_venta";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id_venta'=>$id_venta));

    }
    function buscar(){
        $sql="SELECT idventa,fecha,cliente,dni,total, CONCAT(usuario.nombreU,' ',usuario.apellidoU) as vendedor FROM venta join usuario on usuario_idusuario=idusuario";
        $query = $this->acceso->prepare($sql);
        $query->execute();
        $this->objetos = $query->fetchall();
        return $this->objetos;
    }
}