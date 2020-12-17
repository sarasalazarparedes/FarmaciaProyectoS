<?php
include '../modelo/Venta.php';
include_once '../modelo/conexion.php';
$venta = new Venta();
session_start();
$vendedor= $_SESSION['usuario'];
if($_POST['funcion']=='registrar_compra'){
    $total = $_POST['total'];
    $nombre = $_POST['nombre'];
    $dni = $_POST['dni'];
    $productos= json_decode($_POST['json']);
    date_default_timezone_set('America/La_Paz');
    $fecha=date('Y-m-d H:i:s');
    $venta->Crear($nombre,$dni,$total,$fecha,$vendedor);
    $venta->ultima_venta();
    foreach ($venta->objetos as $objeto) {
        $id_venta =$objeto->ultima_venta;
        
    }
    try {
        $db=new conexion(); 
        $conexion=$db->pdo;
        $conexion->beginTransaction();
        foreach ($productos as $prod) {
            $cantidad= $prod->cantidad;
            while ($cantidad!=0){
                $sql="SELECT * FROM lote where vencimiento =(SELECT MIN(vencimiento) FROM lote where producto_idproducto=:id) and producto_idproducto=:id";
                $query = $conexion->prepare($sql);
                $query->execute(array(':id'=>$prod->id));
                $lote = $query->fetchall();
                foreach ($lote as $lote) {
                    if($cantidad<$lote->stock){
                        $sql="INSERT INTO  detalle (cantidad,vencimiento,id_det_lote,id_det_prod,lote_id_prov,venta_idventa) values ('$cantidad','$lote->vencimiento','$lote->idlote','$prod->id','$lote->proveedor_idproveedor','$id_venta')";
                        $conexion->exec($sql);
                        $conexion->exec("UPDATE lote SET stock= stock-'$cantidad' where idlote='$lote->idlote'");
                        $cantidad=0;
                    }
                    if($cantidad==$lote->stock){
                        $sql="INSERT INTO  detalle (cantidad,vencimiento,id_det_lote,id_det_prod,lote_id_prov,venta_idventa) values ('$cantidad','$lote->vencimiento','$lote->idlote','$prod->id','$lote->proveedor_idproveedor','$id_venta')";
                        $conexion->exec($sql);
                        $conexion->exec("DELETE FROM lote where idlote='$lote->idlote'");
                        $cantidad=0;
                    }
                    if($cantidad>$lote->stock){
                        $sql="INSERT INTO  detalle (cantidad,vencimiento,id_det_lote,id_det_prod,lote_id_prov,venta_idventa) values ('$lote->stock','$lote->vencimiento','$lote->idlote','$prod->id','$lote->proveedor_idproveedor','$id_venta')";
                        $conexion->exec($sql);
                        $conexion->exec("DELETE FROM lote where idlote='$lote->idlote'");
                        $cantidad=$cantidad-$lote->stock;
                    }
                }

            }
            $subtotal=$prod->cantidad*$prod->precio;
            $conexion->exec("INSERT INTO ventaproducto(cantidad,subtotal,producto_idproducto,venta_idventa) values ('$prod->cantidad','$subtotal','$prod->id','$id_venta') ");
            
            
        }
        $conexion->commit();

        
    } catch (Exception $error) {
        
        $conexion->rollBack();
        $venta->borrar($id_venta);
        echo $error->getMessage();
    }
    
}