<?php
include 'conexion.php';
class Presentacion{
    var $objetos;
    public function __construct(){
        $db=new conexion();
        $this->acceso=$db->pdo;
    }
    function crear($nombre){
        $sql="SELECT idpresentacion from presentacion where tipo=:nombre";
        $query=$this->acceso->prepare($sql);
        $query->execute(array(':nombre'=>$nombre));
        $this->objetos=$query->fetchall();
        if(!empty($this->objetos)){
            echo 'noadd';
        }
        else{
            $sql="INSERT INTO presentacion (tipo) values(:nombre);";
            $query=$this->acceso->prepare($sql);
            $query->execute(array(':nombre'=>$nombre));
            echo 'add';
        }

    }
    
    function buscar(){
        if(!empty($_POST['consulta'])){
             $consulta=$_POST['consulta'];
             $sql="SELECT * FROM presentacion where tipo LIKE :consulta";
             $query = $this->acceso->prepare($sql);
             $query->execute(array(':consulta'=>"%$consulta%"));
             $this->objetos = $query->fetchall();
             return $this->objetos;
            

        }else{
       
            $sql="SELECT * FROM presentacion  WHERE tipo NOT LIKE ''  ORDER BY idpresentacion LIMIT 25";
            $query = $this->acceso->prepare($sql);
            $query->execute();
            $this->objetos = $query->fetchall();
            return $this->objetos;


        }

    }
    function borrar($id){
        echo('llego');
        $sql="DELETE FROM presentacion WHERE idpresentacion=:id";
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
        $sql="UPDATE presentacion  set tipo=:nombre where idpresentacion=:id_editado";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id_editado'=>$id_editado,':nombre'=>$nombre));
        echo'editar';

    }
    function rellenar_presentaciones(){
        $sql="SELECT * FROM presentacion order by tipo ";
        $query=$this->acceso->prepare($sql);
        $query->execute();
        $this->objetos = $query->fetchall();
        return $this->objetos;
    }
}
?>