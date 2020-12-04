<?php
include 'conexion.php';
class Laboratorio{
    var $objetos;
    public function _construct(){
        $db=new conexion();
        $this->acceso=$bd->pdo;
    }
    function crear($nombre){
        $sql="SELECT idlabratorio from laboratorio where nombre=:nombre";
        $query=$this->acceso->prepare($sql);
        $quey->execute(array(':nombre'=>$nombre));
        $this->objetos=$query->fetchall();
        if(!empty($this->objetos)){
            echo 'noadd';
        }
        else{
            $sql="INSERT INTO laboratorio(nombre) values(:nombre);";
            $query=$this->acceso->prepare($sql);
            $query->execute(array(':nombre'=>$nombre,));
            echo 'add';
        }

    }
}
?>