<?php
include 'conexion.php';
class Lote{
    var $objetos;
    public function __construct(){
        $db=new conexion();
        $this->acceso=$db->pdo;
    }
    function crear($id_producto,$proveedor,$stock,$vencimiento){
        $sql="INSERT INTO lote(stock,vencimiento,producto_idproducto,proveedor_idproveedor) values(:stock,:vencimiento,:id_producto,:id_proveedor);";
        $query=$this->acceso->prepare($sql);
        $query->execute(array(':stock'=>$stock,':vencimiento'=>$vencimiento,':id_producto'=>$id_producto,':id_proveedor'=>$proveedor));
        echo 'add'; 
    }
    function buscar(){
        if(!empty($_POST['consulta'])){
             $consulta=$_POST['consulta'];
             $sql = "SELECT idlote,stock,vencimiento,concentrancion,adicional,producto.nombre
              as prod_nom,laboratorio.nombre as lab_nom,tipoProducto.caracteristica as tip_nom, presentacion.tipo 
              as pre_nom,proveedor.nombre as proveedor,producto.avatar as logo from lote join proveedor 
              on proveedor_idproveedor=idproveedor join producto on producto_idproducto=idproducto join laboratorio 
              on laboratorio_idlaboratorio=idlaboratorio join tipoproducto on tipoproducto_idtipoproducto join presentacion 
              on presentacion_idpresentacion and producto.nombre  like :consulta   group by idlote ";
             $query = $this->acceso->prepare($sql);
             $query->execute(array(':consulta'=>"%$consulta%"));
             $this->objetos = $query->fetchall();
             return $this->objetos;
            

        }else{
       
            $sql = "SELECT idlote,stock,vencimiento,concentrancion,adicional,producto.nombre
            as prod_nom,laboratorio.nombre as lab_nom,tipoProducto.caracteristica as tip_nom, presentacion.tipo 
            as pre_nom,proveedor.nombre as proveedor,producto.avatar as logo from lote join proveedor 
            on proveedor_idproveedor=idproveedor join producto on producto_idproducto=idproducto join laboratorio 
            on laboratorio_idlaboratorio=idlaboratorio join tipoproducto on tipoproducto_idtipoproducto join presentacion 
            on presentacion_idpresentacion and producto.nombre not like '' group by idlote ";
            $query = $this->acceso->prepare($sql);
            $query->execute();
            $this->objetos = $query->fetchall();
            return $this->objetos;


        }

    }
    function editar($id,$stock){
        $sql="UPDATE lote SET stock=:stock where idlote=:id";
        $query=$this->acceso->prepare($sql);
        $query->execute(array(':id'=>$id,':stock'=>$stock));
        echo 'edit';
    }
    function borrar($id){
        $sql="DELETE FROM lote where idlote=:id";
        $query=$this->acceso->prepare($sql);
        $query->execute(array('id'=>$id));
        if(!empty($query->execute(array('id'=>$id)))){
            echo'borrado';
        }
        else{
            echo'noborrado';
        }
    }
}
?>