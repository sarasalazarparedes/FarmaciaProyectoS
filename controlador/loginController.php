<?php
include_once "../modelo/usuario.php";
session_start();
$user =$_POST['user'];
$pass =$_POST['pass'];
$Usuario = new usuario();

//foreach($Usuario->objetos as $objeto){
   // print_r($objeto);
//}
if(!empty( $_SESSION['tipousuario_idtipousuario'])){//si  un usuario em curso se direcciona
    
    switch ($_SESSION['tipousuario_idtipousuario']) {
        case 1:
            header ('Location: ../vista/adm_catalogo.php');
            break;
        
        case 2:
            header ('Location: ../vista/tec_catalogo.php');
            break;
    }

}else{
    $Usuario-> loguearse($user,$pass);
    if(!empty($Usuario-> objetos)){
        foreach($Usuario->objetos as $objeto){
            $_SESSION['usuario']=$objeto-> idusuario;
            $_SESSION['tipousuario_idtipousuario']=$objeto-> tipousuario_idtipousuario;
            $_SESSION['nombreu']=$objeto-> nombreu;
            
        }
        switch ($_SESSION['tipousuario_idtipousuario']) {
            case 1:
                header ('Location: ../vista/adm_catalogo.php');
                break;
            
            case 2:
                header ('Location: ../vista/tec_catalogo.php');
                break;
        }
    
    
    }else{
        header ('Location: ../index.php');
    }

}

?>