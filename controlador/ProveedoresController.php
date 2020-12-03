<?php
include '../modelo/Proveedor.php';
$proveedor= new Proveedor();
if($_POST['funcion']=='crear'){
    $nombre=$_POST['nombre'];
    $telefono=$_POST['telefono'];
    $correo=$_POST['correo'];
    $direcion=$_POST['direccion'];
    $avatar='proveedores.png';

    $proveedor->crear($nombre,$telefono,$correo,$direccion,$avatar);
}


?>