<?php
include '../modelo/Presentacion.php';
$presentacion=new Presentacion();

if($_POST['funcion']=='crear'){
    $nombre=$_POST['nombre_presentacion'];
    $presentacion->crear($nombre);
}
if($_POST['funcion']=='editar'){
    echo('entro');
    $nombre_laboratorio=$_POST['nombre_presentacion'];
    $id_editado=$_POST['id_editado'];
    $presentacion->editar($nombre_laboratorio,$id_editado);
    echo($nombre_laboratorio+$id_editado);
}
if($_POST['funcion']=='buscar'){
    $presentacion->buscar();
    $json=array();
    foreach ($presentacion->objetos as $objeto){
        $json[]=array(
            'id'=>$objeto->idpresentacion,
            'nombre'=>$objeto->tipo
        );
    }
    $jsonstring=json_encode($json);
    echo $jsonstring;
}
if($_POST['funcion']=="borrar"){
    echo("llego");
    $id=$_POST['id'];
    $presentacion->borrar($id);
}
if($_POST['funcion']=="rellenar_presentaciones"){
    $presentacion->rellenar_presentaciones();
    $json =array();
    foreach ($presentacion->objetos as $objeto) {
        $json[]=array(
            'id'=>$objeto->idpresentacion,
            'nombre'=>$objeto->tipo
        );

    }
    $jsonstring=json_encode($json);
    echo $jsonstring;
}

?>