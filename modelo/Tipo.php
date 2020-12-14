<?php
include 'conexion.php';
class Tipo{
    var $objetos;
    public function __construct(){
        $db=new conexion();
        $this->acceso=$db->pdo;
    }
    function crear($nombre){
        $sql="SELECT idtipoProducto from tipoproducto where caracteristica=:nombre";
        $query=$this->acceso->prepare($sql);
        $query->execute(array(':nombre'=>$nombre));
        $this->objetos=$query->fetchall();
        if(!empty($this->objetos)){
            echo 'noadd';
        }
        else{
            $sql="INSERT INTO tipoproducto(caracteristica) values (:nombre);";
            $query=$this->acceso->prepare($sql);
            $query->execute(array(':nombre'=>$nombre));
            echo 'add';
        }

    }

    function buscar(){
        if(!empty($_POST['consulta'])){
             $consulta=$_POST['consulta'];
             $sql="SELECT * FROM tipoproducto where caracteristica LIKE :consulta";
             $query = $this->acceso->prepare($sql);
             $query->execute(array(':consulta'=>"%$consulta%"));
             $this->objetos = $query->fetchall();
             return $this->objetos;

        }else{
       
            $sql="SELECT * FROM tipoproducto  WHERE caracteristica NOT LIKE ''  ORDER BY idtipoProducto LIMIT 25";
            $query = $this->acceso->prepare($sql);
            $query->execute();
            $this->objetos = $query->fetchall();
            return $this->objetos;


        }

    }
    function borrar($id){
        $sql="DELETE FROM tipoproducto WHERE idtipoproducto=:id";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id'=>$id));
        if(!empty($query->execute(array(':id'=>$id)))){
            echo'borrado';
        }
        else{
            echo'noborrado';
        }
    }
    function editar($nombre,$id_editado){
       
        $sql="UPDATE tipoproducto set caracteristica=:nombre where idtipoproducto=:id_editado";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id_editado'=>$id_editado,':nombre'=>$nombre));
        
        echo'editar';

    }
    function rellenar_tipos(){
        $sql="SELECT * FROM tipoproducto order by caracteristica ";
        $query=$this->acceso->prepare($sql);
        $query->execute();
        $this->objetos = $query->fetchall();
        return $this->objetos;
    }
}
?>