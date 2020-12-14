<?php
include 'conexion.php';
class Laboratorio{
    var $objetos;
    public function __construct(){
        $db=new conexion();
        $this->acceso=$db->pdo;
    }
    function crear($nombre,$avatar){
        $sql="SELECT idlaboratorio from laboratorio where nombre=:nombre";
        $query=$this->acceso->prepare($sql);
        $query->execute(array(':nombre'=>$nombre));
        $this->objetos=$query->fetchall();
        if(!empty($this->objetos)){
            echo 'noadd';
        }
        else{
            $sql="INSERT INTO laboratorio(nombre,avatar) values(:nombre,:avatar);";
            $query=$this->acceso->prepare($sql);
            $query->execute(array(':nombre'=>$nombre,':avatar'=>$avatar));
            echo 'add-laboratorio';
        }

    }
    function cambiar_logo($id,$nombre){
        $sql="SELECT avatar FROM laboratorio where idlaboratorio=:id ";
        $query=$this->acceso->prepare($sql);
        $query->execute(array(':id'=>$id));
        $this->objetos = $query->fetchall();
        
            $sql="UPDATE laboratorio SET avatar=:nombre where idlaboratorio=:id ";
            $query=$this->acceso->prepare($sql);
            $query->execute(array(':id'=>$id,':nombre'=>$nombre));
        return $this->objetos;
        
    }
    function buscar(){
        if(!empty($_POST['consulta'])){
             $consulta=$_POST['consulta'];
             $sql="SELECT * FROM laboratorio where nombre LIKE :consulta";
             $query = $this->acceso->prepare($sql);
             $query->execute(array(':consulta'=>"%$consulta%"));
             $this->objetos = $query->fetchall();
             return $this->objetos;
            

        }else{
       
            $sql="SELECT * FROM laboratorio  WHERE nombre NOT LIKE ''  ORDER BY idlaboratorio ";
            $query = $this->acceso->prepare($sql);
            $query->execute();
            $this->objetos = $query->fetchall();
            return $this->objetos;


        }

    }
    function borrar($id){
        echo('llego');
        $sql="DELETE FROM laboratorio WHERE idlaboratorio=:id";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id'=>$id));
        if(!empty($query->execute(array(':id'=>$id)))){
            echo'borrado';
        }
        else{
            echo'noborrado';
        }
    }
    function editar($nombre_laboratorio,$id_editado){
        $sql="UPDATE laboratorio set nombre=:nombre_laboratorio where idlaboratorio=:id_editado";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id_editado'=>$id_editado,':nombre_laboratorio'=>$nombre_laboratorio));
        echo'edit';
    }
}
?>