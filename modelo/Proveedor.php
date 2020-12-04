<?php
include 'conexion.php';
class Proveedor{
    var $objetos;
    public function __construct(){
        $db=new conexion();
        $this->acceso=$db->pdo;
    }
    function crear($nombre,$telefono,$correo,$direccion,$avatar){
        $sql="SELECT idproveedor from proveedor where nombre=:nombre";
        $query=$this->acceso->prepare($sql);
        $query->execute(array(':nombre'=>$nombre));
        $this->objetos=$query->fetchall();
        if(!empty($this->objetos)){
            echo 'noadd';
        }
        else{
            $sql="INSERT INTO proveedor(nombre,telefono,correo,direccion,avatar) values(:nombre,:telefono,:correo,:direccion,:avatar);";
            $query=$this->acceso->prepare($sql);
            $query->execute(array(':nombre'=>$nombre,':telefono'=>$telefono,':correo'=>$correo,':direccion'=>$direccion,':avatar'=>$avatar));
            echo 'add';
        }

    }
    function buscar(){
        if(!empty($_POST['consulta'])){
             $consulta=$_POST['consulta'];
             $sql="SELECT * FROM proveedor where nombre LIKE :consulta";
             $query = $this->acceso->prepare($sql);
             $query->execute(array(':consulta'=>"%$consulta%"));
             $this->objetos = $query->fetchall();
             return $this->objetos;
            

        }else{
       
            $sql="SELECT * FROM proveedor WHERE nombre NOT LIKE '' ";
            $query = $this->acceso->prepare($sql);
            $query->execute();
            $this->objetos = $query->fetchall();
            return $this->objetos;


        }

    }
    function cambiar_logo($id,$nombre){
            $sql="UPDATE proveedor SET avatar=:nombre where idproveedor=:id ";
            $query=$this->acceso->prepare($sql);
            $query->execute(array(':id'=>$id,':nombre'=>$nombre));
    
        
    }
}
?>