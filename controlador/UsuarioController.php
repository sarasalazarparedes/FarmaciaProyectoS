<?php
include_once '../modelo/usuario.php';
$usuario = new Usuario();
if($_POST['funcion']=='buscar_usuario'){
    $json=array();
    $usuario->obtener_datos($_POST['dato']);
    foreach ($usuario->objetos as $objeto ) {
        $json[]=array(
            'nombre'=> $objeto->nombreu,
            'apellido'=> $objeto->apellidou,
            'edad'=> $objeto->edad,
            'cedula'=> $objeto->cedulau,
            'tipo'=> $objeto->nombre_tipo,
            'telefono'=> $objeto->telefonou,
            'residenciaU'=> $objeto->residenciau,
            'correoU'=> $objeto->correou,
            'adicionalU'=> $objeto->adicionalu
        );
 
    }
    $jsonstring = json_encode($json[0]);
    echo $jsonstring;

}

?>