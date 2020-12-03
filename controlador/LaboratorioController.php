<?php
include '../modelo/Laboratorio.php';
$labo=new Laboratorio();
if($_POST['funcion']=='crear'){
    $nombre_laboratorio=$_POST['nombre_laboratorio'];
    $avatar='lab_avatar.jpg';
    $labo->crear($nombre_laboratorio,$avatar);
}
if($_POST['funcion']=='buscar'){
    $labo->buscar();
    $json=array();
    foreach ($laboratorio->objetos as $objeto){
        $json[]=array(
            'id'=>$objeto->idlaboratorio,
            'nombre'=>$objeto->nombre,
            'avatar'=>'../img/'.$objeto->avatar
        );
    }
    $jsonstring=json_encode($json);
    echo $jsonstring;
}
?>