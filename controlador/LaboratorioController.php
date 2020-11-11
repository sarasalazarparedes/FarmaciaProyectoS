<?php
include '../modelo/Laboratorio.php'
$laboratorio=new Laboratorio();
if($_POST['funcion']=='crear'){
    $nombre=$_POST['nombre_laboratorio'];
    $avatar='lab_avatar.jpg';
    $laboratorio->crear($nombre,$avatar);
    
}
?>