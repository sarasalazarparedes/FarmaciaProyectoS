<?php
include 'conexion.php';
class Producto{
    var $objetos;
    public function __construct(){
        $db=new conexion();
        $this->acceso=$db->pdo;
    }
    function crear($nombre,$concentracion,$adicional,$precio,$laboratorio,$tipo,$presentacion,$avatar){
        $sql="SELECT idproducto from producto where nombre=:nombre and concentrancion=:concentracion and adicional=:adicional and precio=:precio and laboratorio_idlaboratorio=:laboratorio and tipoproducto_idtipoproducto=:tipo and presentacion_idpresentacion=:presentacion ";
        $query=$this->acceso->prepare($sql);
        $query->execute(array(':nombre'=>$nombre,':concentracion'=>$concentracion,':adicional'=>$adicional,':precio'=>$precio,':laboratorio'=>$laboratorio,':tipo'=>$tipo,':presentacion'=>$presentacion));
        $this->objetos=$query->fetchall();
        
        if(!empty($this->objetos)){
            echo 'noadd';
        }
        else{
            $sql="INSERT INTO producto(nombre,concentrancion,adicional,precio,avatar,laboratorio_idlaboratorio,tipoProducto_idtipoProducto,presentacion_idpresentacion) values(:nombre,:concentracion,:adicional,:precio,:avatar,:laboratorio,:tipo,:presentacion);";
            $query=$this->acceso->prepare($sql);
            $query->execute(array(':nombre'=>$nombre,':concentracion'=>$concentracion,':adicional'=>$adicional,':precio'=>$precio,':laboratorio'=>$laboratorio,':tipo'=>$tipo,':presentacion'=>$presentacion,':avatar'=>$avatar));
            echo 'add';
        }

    }
    function buscar(){
        if(!empty($_POST['consulta'])){
             $consulta=$_POST['consulta'];
             $sql="SELECT idproducto,producto.nombre as nombre,concentracion,adicional,precio,laboratorio.nombre as laboratorio,tipoProducto.caracteristica as tipo,
             presentacion.tipo as presentacion,producto.avatar as avatar
             from producto
             join laboratorio on laboratorio_idlaboratorio
             join tipo_productoon tipoPoducto_idtipoProducto=
             join presentacion on presentacion_idpresentacion  and producto.nombre like :consulta limit 25";
             $query = $this->acceso->prepare($sql);
             $query->execute(array(':consulta'=>"%$consulta%"));
             $this->objetos = $query->fetchall();
             return $this->objetos;
            

        }else{
       
            $sql="SELECT idproducto,producto.nombre as nombre,concentracion,adicional,precio,laboratorio.nombre as laboratorio,tipoProducto.caracteristica as tipo,
             presentacion.tipo as presentacion,producto.avatar as avatar
             from producto
             join laboratorio on laboratorio_idlaboratorio
             join tipo_productoon tipoPoducto_idtipoProducto=
             join presentacion on presentacion_idpresentacion  and producto.nombre not like '' limit 25";
            $query = $this->acceso->prepare($sql);
            $query->execute();
            $this->objetos = $query->fetchall();
            return $this->objetos;


        }

    }
    
    
}
?>