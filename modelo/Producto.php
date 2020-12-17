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
    function editar($id,$nombre,$concentracion,$adicional,$precio,$laboratorio,$tipo,$presentacion){
        $sql="SELECT idproducto from producto where idproducto!=:id  and nombre=:nombre  and concentrancion=:concentracion and adicional=:adicional and precio=:precio and laboratorio_idlaboratorio=:laboratorio and tipoproducto_idtipoproducto=:tipo and presentacion_idpresentacion=:presentacion ";
        $query=$this->acceso->prepare($sql);
        $query->execute(array(':id'=>$id,':nombre'=>$nombre,':concentracion'=>$concentracion,':adicional'=>$adicional,':precio'=>$precio,':laboratorio'=>$laboratorio,':tipo'=>$tipo,':presentacion'=>$presentacion));
        $this->objetos=$query->fetchall();
        if(!empty($this->objetos)){
            echo 'noedit';
        }
        else{
            $sql="UPDATE producto set nombre=:nombre, concentrancion=:concentracion , adicional=:adicional  , laboratorio_idlaboratorio=:laboratorio, tipoproducto_idtipoproducto=:tipo , presentacion_idpresentacion=:presentacion,precio=:precio where idproducto=:id;";
            $query=$this->acceso->prepare($sql);
            $query->execute(array(':id'=>$id,':nombre'=>$nombre,':concentracion'=>$concentracion,':adicional'=>$adicional,':precio'=>$precio,':laboratorio'=>$laboratorio,':tipo'=>$tipo,':presentacion'=>$presentacion));
            echo 'edit';
        }

    }
    function buscar(){
        if(!empty($_POST['consulta'])){
             $consulta=$_POST['consulta'];
             $sql="SELECT idproducto,producto.nombre as nombre,concentrancion,adicional,precio, laboratorio.nombre as laboratorio,tipoproducto.caracteristica as tipo,
             presentacion.tipo as presentacion,producto.avatar as avatar,laboratorio_idlaboratorio, tipoproducto_idtipoproducto,presentacion_idpresentacion 
             from producto
             join laboratorio on laboratorio_idlaboratorio
             join tipoproducto on tipoproducto_idtipoproducto
             join presentacion on presentacion_idpresentacion  and producto.nombre like :consulta group by idproducto";
             $query = $this->acceso->prepare($sql);
             $query->execute(array(':consulta'=>"%$consulta%"));
             $this->objetos = $query->fetchall();
             return $this->objetos;
            

        }else{
       
            $sql="SELECT idproducto, producto.nombre as nombre,concentrancion,adicional,precio,laboratorio.nombre as laboratorio,tipoproducto.caracteristica as tipo,
             presentacion.tipo as presentacion,producto.avatar as avatar,laboratorio_idlaboratorio, tipoproducto_idtipoproducto,presentacion_idpresentacion
             from producto
             join laboratorio on laboratorio_idlaboratorio
             join tipoproducto on tipoproducto_idtipoproducto
             join presentacion on presentacion_idpresentacion  and producto.nombre not like '' group by idproducto";
            $query = $this->acceso->prepare($sql);
            $query->execute();
            $this->objetos = $query->fetchall();
            return $this->objetos;


        }

    }
    function borrar($id){
        $sql="DELETE FROM producto where idproducto=:id";
        $query=$this->acceso->prepare($sql);
        $query->execute(array('id'=>$id));
        if(!empty($query->execute(array('id'=>$id)))){
            echo'borrado';
        }
        else{
            echo'noborrado';
        }
    }
    function cambiar_logo($id,$nombre){
      
        
            $sql="UPDATE producto SET avatar=:nombre where idproducto=:id ";
            $query=$this->acceso->prepare($sql);
            $query->execute(array(':id'=>$id,':nombre'=>$nombre));
        
    }
    function obtener_stock($id){
        $sql = "SELECT SUM(stock) as total FROM lote where producto_idproducto=:id";
        $query=$this->acceso->prepare($sql);
        $query->execute(array('id'=>$id)); 
        $this->objetos = $query->fetchall();
        return $this->objetos;
    }
    function buscar_id($id){
        $sql="SELECT idproducto, producto.nombre as nombre,concentrancion,adicional,precio,laboratorio.nombre as laboratorio,tipoproducto.caracteristica as tipo,
        presentacion.tipo as presentacion,producto.avatar as avatar,laboratorio_idlaboratorio, tipoproducto_idtipoproducto,presentacion_idpresentacion
        from producto
        join laboratorio on laboratorio_idlaboratorio
        join tipoproducto on tipoproducto_idtipoproducto
        join presentacion on presentacion_idpresentacion where idproducto=:id";
       $query = $this->acceso->prepare($sql);
       $query->execute(array(':id'=>$id));
       $this->objetos = $query->fetchall();
       return $this->objetos;

    }
}
?>