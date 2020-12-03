<?php
include_once '../modelo/usuario.php';
$us = new Usuario();
session_start();
$usuario=$_SESSION['usuario'];
if($_POST['funcion']=='buscar_usuario'){
    $json=array();
    $fecha_actual = new DateTime();
    $us->obtener_datos($_POST['dato']);
    foreach ($us->objetos as $objeto ) {
        $nacimiento = new DateTime($objeto->edad);
        $edad = $nacimiento->diff($fecha_actual);
        $edad_years = $edad->y;
        $json[]=array(
            'nombre'=> $objeto->nombreu,
            'apellido'=> $objeto->apellidou,
            'edad'=> $edad_years,
            'cedula'=> $objeto->cedulau,
            'tipo'=> $objeto->nombre_tipo,
            'telefono'=> $objeto->telefonou,
            'residenciau'=> $objeto->residenciau,
            'correou'=> $objeto->correou,
            'adicionalu'=> $objeto->adicionalu,
            'avatar'=>'../img/'.$objeto->avatar
        );
 
    }
    $jsonstring = json_encode($json[0]);
    echo $jsonstring;

}

if($_POST['funcion']=='capturar_datos'){
    $json=array();
    $usuario=$_POST['usuario'];
    $us->obtener_datos($usuario);
    foreach ($us->objetos as $objeto ) {
        $json[]=array(
            'telefono'=> $objeto->telefonou,
            'residenciau'=> $objeto->residenciau,
            'correou'=> $objeto->correou,
            'adicionalu'=> $objeto->adicionalu
        );
 
    }
    $jsonstring = json_encode($json[0]);
    echo $jsonstring;

}

if($_POST['funcion']=='editar_usuario'){
    $usuario=$_POST['usuario'];
    $telefono=$_POST['telefono'];
    $residenciau=$_POST['residenciau'];
    $correou=$_POST['correou'];
    $adicionalu=$_POST['adicionalu'];
    $us->editar($usuario,$telefono,$residenciau,$correou,$adicionalu);
    echo'editado';
}

if($_POST['funcion']=='cambiar_contra'){
    $usuario=$_POST['usuario'];
    $oldpass=$_POST['oldpass'];
    $newpass=$_POST['newpass'];
    $us->cambiar_contra($usuario,$oldpass,$newpass);
    
    echo'editado';
}

if($_POST['funcion']=='cambiar_foto'){
    if(($_FILES['photo']['type']=='image/jpeg')||($_FILES['photo']['type']=='image/png')||($_FILES['photo']['type']=='image/gif')){
        $nombre=uniqid().'-'.$_FILES['photo']['name'];
         //echo $nombre;
        $ruta='../img/'.$nombre;
         move_uploaded_file($_FILES['photo']['tmp_name'],$ruta);
        $us->cambiar_foto($usuario,$nombre);
        foreach ($us->objetos as $objeto) {
            unlink('../img/'.$objeto->avatar);
        }
        $json= array();
        $json[]=array(
            'ruta'=>$ruta,
            'alert'=>'edit'

        );
        $jsonstring = json_encode($json[0]);
    echo $jsonstring;
    }else{
        $json= array();
        $json[]=array(
            'alert'=>'noedit'
        );
        $jsonstring = json_encode($json[0]);
        echo $jsonstring;
    }

}
if($_POST['funcion']=='buscar_usuarios_adm'){
    $json=array();
    $fecha_actual = new DateTime();
    $us->buscar();
    foreach ($us->objetos as $objeto ) {
        $nacimiento = new DateTime($objeto->edad);
        $edad = $nacimiento->diff($fecha_actual);
        $edad_years = $edad->y;
        $json[]=array(
            'id'=> $objeto->idusuario,
            'nombre'=> $objeto->nombreu,
            'apellido'=> $objeto->apellidou,
            'edad'=> $edad_years,
            'cedula'=> $objeto->cedulau,
            'tipo'=> $objeto->nombre_tipo,
            'telefono'=> $objeto->telefonou,
            'residenciau'=> $objeto->residenciau,
            'correou'=> $objeto->correou,
            'adicionalu'=> $objeto->adicionalu,
            'avatar'=>'../img/'.$objeto->avatar,
            'tipo_us'=>$objeto->tipousuario_idtipousuario
        );
 
    }
    $jsonstring = json_encode($json);
    echo $jsonstring;

}
if($_POST['funcion']=='crear_usuario'){
    $nombre=$_POST['nombre'];
    $apellido=$_POST['apellido'];
    $edad=$_POST['edad'];
    $dni=$_POST['dni'];
    $pass=$_POST['pass'];
    $tipo=2;
    $avatar='farmacias_default.jpeg';
    $us->crear($nombre,$apellido,$edad,$dni,$pass,$tipo,$avatar);
    

}
if($_POST['funcion']=='borrar_usuario'){
    $pass=$_POST['pass'];
    $id_borrado=$_POST['usuario'];
    $us->borrar($pass,$id_borrado,$usuario);
}
    
    






?>
