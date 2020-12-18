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
    function venta_dia_vendedor($idusuario){
        $sql="SELECT SUM(total) as venta_dia_vendedor FROM venta where usuario_idusuario=:idusuario and date(fecha)=date(curdate())";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':idusuario'=>$idusuario));
        $this->objetos = $query->fetchall();
        return $this->objetos;
    }
    function venta_diaria(){
        $sql="SELECT SUM(total) as venta_diaria FROM venta where date(fecha)=date(curdate())";
        $query = $this->acceso->prepare($sql);
        $query->execute();
        $this->objetos = $query->fetchall();
        return $this->objetos;

    }
    function venta_mensual(){
        $sql="SELECT ROUND(sum(total),1) as venta_mensual FROM venta where year(fecha)=year(curdate()) and month(fecha)=month(curdate())";
        $query = $this->acceso->prepare($sql);
        $query->execute();
        $this->objetos = $query->fetchall();
        return $this->objetos;

    }
    function venta_anual(){
        $sql="SELECT ROUND(sum(total),1) as venta_anual FROM venta where year(fecha)=year(curdate()) and month(fecha)=month(curdate())";
        $query = $this->acceso->prepare($sql);
        $query->execute();
        $this->objetos = $query->fetchall();
        return $this->objetos;

    }
}