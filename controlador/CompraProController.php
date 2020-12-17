<?php
include '../modelo/CompraPro.php';
include_once '../modelo/conexion.php';
$productop=new CompraPro();
session_start();
if($_POST['funcion']=='Crear'){
    $proveedor =$_POST['nombre'];
    $cantidad=$_POST['cantidad'];
    $presentacion=$_POST['presentacion'];
    $total = $_POST['total'];
    $producton = $_POST['producto'];
    $precio = $_POST['precio'];
    $laboratorio = $_POST['laboratorio'];
    date_default_timezone_set('America/La_Paz');
    $fecha=date('Y-m-d H:i:s');
    $productop->Crear($proveedor,$fecha,$producton,$cantidad,$precio,$laboratorio,$presentacion,$total);
    $productop->ultima_compra();
    foreach ($productop->objetos as $objeto) {
        $id_compra =$objeto->ultima_compra;
        
    }
    
    try {
        $db=new conexion(); 
        $conexion=$db->pdo;
        $conexion->beginTransaction();
        
            $subtotal=$cantidad*$precio;
            $conexion->exec("INSERT INTO compraproducto(cantidad,subtotal,compra_idcompra) values ('$cantidad','$subtotal','$id_compra') ");
            
            
        
        $conexion->commit();

        
    } catch (Exception $error) {
        
        $conexion->rollBack();
        $productop->borrar($id_compra);
        echo $error->getMessage();
    }
}


   
