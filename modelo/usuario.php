<?php
include_once 'conexion.php';
class Usuario{
    var $objetos;
    public function __construct(){
        $db=new conexion();
        $this->acceso=$db->pdo;
    }
    function loguearse($dni,$pass){
        $sql="SELECT * FROM usuario where cedulaU=:dni and contra= :pass";
        $query=$this->acceso->prepare($sql);
        $query->execute(array(':dni'=>$dni,':pass'=>$pass));
        $this->objetos= $query->fetchall();
        return $this ->objetos;
    }
    function obtener_datos($id){
        $sql="SELECT * FROM usuario u,tipousuario t where u.tipoUsuario_idtipoUsuario=t.idtipoUsuario and idusuario=:id";
        $query=$this->acceso->prepare($sql);
        $query->execute(array(':id'=>$id));
        $this->objetos= $query->fetchall();
        return $this ->objetos;
    }
    function editar($usuario,$telefono,$residencia,$correo,$adiciona){
        $sql="UPDATE usuario SET telefonoU=:telefono,residenciaU=:residencia,correoU=:correou,adicionaU=:adicionalu where idusuario=:usuario";
        $query=$this->acceso->prepare($sql);
        $query->execute(array(':usuario'=>$usuario,':telefono'=>$telefono,':residenciau'=>$residenciau,':correou'=>$correou,':adicionalu'=>$adicionalu));
    }
}


?>