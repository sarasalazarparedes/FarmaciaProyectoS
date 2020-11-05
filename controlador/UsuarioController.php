<?php
include_once '../modelo/usuario.php';
$us = new Usuario();
if($_POST['funcion']=='buscar_usuario'){
    $json=array();
    $us->obtener_datos($_POST['dato']);
    foreach ($us->objetos as $objeto ) {
        $json[]=array(
            'nombre'=> $objeto->nombreu,
            'apellido'=> $objeto->apellidou,
            'edad'=> $objeto->edad,
            'cedula'=> $objeto->cedulau,
            'tipo'=> $objeto->nombre_tipo,
            'telefono'=> $objeto->telefonou,
            'residenciau'=> $objeto->residenciau,
            'correou'=> $objeto->correou,
            'adicionalu'=> $objeto->adicionalu
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

    echo $telefono;
    

}

?>