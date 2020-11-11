<?php
Include 'conexion.php';
class Laboratorio{
    var $objetos;
    public function_construct(){
        $db=new conexion();
        $this->acceso=$bd-pdo;
    }
    function crear($nombre,$avatar){
        $sql="SELECT id_labratorio from laboratorio where nombre=:nombre";
        $query=$this->acceso->prepare($sql);
        $quey->execute(array(':nombre'=>$nombre));
        $this->objetos=$query->fetchall();
        if(!empty($this->objetos)){
            echo 'noadd';
        }
        else{
            $sql="INSERT INTO laboratorio(nombre,avatar) values(:nombre,:avatar);";
            $query=$this->acceso->prepare($sql);
            $query->execute(array(':nombre'=>$nombre,':avatar'=>$avatar));
            echo 'add';
        }

    }
}
?>