<?php
include '../modelo/Laboratorio.php';
$labo=new Laboratorio();

if($_POST['funcion']=='crear'){
    $nombre_laboratorio=$_POST['nombre_laboratorio'];
    $avatar='lab_avatar.jpg';
    $labo->crear($nombre_laboratorio,$avatar);
}
if($_POST['funcion']=='editar'){
    echo('entro');
    $nombre_laboratorio=$_POST['nombre_laboratorio'];
    $id_editado=$_POST['id_editado'];
    $labo->editar($nombre_laboratorio,$id_editado);
} 
if($_POST['funcion']=='buscar'){
    $labo->buscar();
    $json=array();
    foreach ($labo->objetos as $objeto){
        $json[]=array(
            'id'=>$objeto->idlaboratorio,
            'nombre'=>$objeto->nombre,
            'avatar'=>'../img/lab/'.$objeto->avatar
        );
    }
    $jsonstring=json_encode($json);
    echo $jsonstring;
}
if($_POST['funcion']=='cambiar_logo'){
    $id=$_POST['id_logo_lab'];
    if(($_FILES['photo']['type']=='image/jpeg')||($_FILES['photo']['type']=='image/png')||($_FILES['photo']['type']=='image/gif')){
        $nombre=uniqid().'-'.$_FILES['photo']['name'];
        $ruta='../img/lab/'.$nombre;
         move_uploaded_file($_FILES['photo']['tmp_name'],$ruta);
        $labo->cambiar_logo($id,$nombre);
        foreach ($labo->objetos as $objeto) {
            if($objeto->avatar!='lab_avatar.jpg'){
                unlink('../img/lab/'.$objeto->avatar);
            }
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
if($_POST['funcion']=='borrar'){
   
    $id=$_POST['id'];
    $labo->borrar($id);
}
if($_POST['funcion']=="rellenar_laboratorios"){
    $labo->rellenar_laboratorios();
    $json =array();
    foreach ($labo->objetos as $objeto) {
        $json[]=array(
            'id'=>$objeto->idlaboratorio,
            'nombre'=>$objeto->nombre
        );

    }
    $jsonstring=json_encode($json);
    echo $jsonstring;
}

?>