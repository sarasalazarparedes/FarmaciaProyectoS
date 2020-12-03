<?php
Include 'conexion.php';
class Laboratorio{
    var $objetos;
    public function __construct(){
        $db=new conexion();
        $this->acceso=$db->pdo;
    }
    function crear($nombre_laboratorio,$avatar){
        $sql="SELECT idlaboratorio from laboratorio where nombre=:nombre_laboratorio";
        $query=$this->acceso->prepare($sql);
        $query->execute(array(':nombre_laboratorio'=>$nombre_laboratorio));
        $this->objetos=$query->fetchall();
        if(!empty($this->objetos)){
            echo 'noadd-laboratorio';
        }
        else{
            $sql="INSERT INTO laboratorio(nombre,avatar) values(:nombre_laboratorio,:avatar);";
            $query=$this->acceso->prepare($sql);
            $query->execute(array(':nombre_laboratorio'=>$nombre_laboratorio,':avatar'=>$avatar));
            echo 'add-laboratorio';
        }

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
            $sql="SELECT * FROM laboratorio  WHERE nombre NOT LIKE '' ORDER BY idlaboratorio LIMIT 25 ";
            $query = $this->acceso->prepare($sql);
            $query->execute();
            $this->objetos = $query->fetchall();
            return $this->objetos;


        }

    }
}
?>