<?php
session_start();
if ($_SESSION['tipousuario_idtipousuario'] == 1 || $_SESSION['tipousuario_idtipousuario'] == 3) {
    include_once 'layouts/header.php';
?>

    <title>Administrador | Compra

    </title>
    <!-- Tell the browser to be responsive to screen width -->
    <?php
    include_once 'layouts/nav.php';
    ?>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Compra</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Compra</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->

        </section>

        <section>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-success">
                    <div class="card-header">
                    </div>
                    <div class="card-body p-0">
                        <header>
                            <div class="logo_cp">
                                <img src="../img/logo.png" width="100" height="100">
                            </div>
                            <h1 class="titulo_cp">SOLICITUD DE COMPRA</h1>
                            <div class="datos_cp">
                                <div class="form-group row">
                                    <span>Proveedor: </span>
                                    <div class="input-group-append col-md-6">
                                        <input type="text" class="form-control" id="cliente" placeholder="Ingresa nombre">
                                    </div>
                                </div>
                               
                                <div class="form-group row">
                                    <span>Nombre Producto: </span>
                                    <div class="input-group-append col-md-6">
                                        <input type="text" class="form-control" id="producto" placeholder="Ingresa prodcuto">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <span>Cantidad: </span>
                                    <div class="input-group-append col-md-6">
                                        <input type="number" class="form-control" id="cantidad" placeholder="Ingresa cantidad">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <span>precio: </span>
                                    <div class="input-group-append col-md-6">
                                        <input type="number" class="form-control" id="precio" placeholder="Ingresa precio unitario">
                                    </div>
                                </div>
                            
                                <div class="form-group row">
                                    <span>Laboratorio: </span>
                                    <div class="input-group-append col-md-6">
                                        <input type="text" class="form-control select2" style="width:100%" id="laboratorio" placeholder="Ingrese laboratorio">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <span>Presentacion: </span>
                                    <div class="input-group-append col-md-6">
                                        <input type="text" class="form-control select2" style="width:100%" id="presentacion" placeholder="Ingrese presentacion">
                                    </div>
                                </div>
                            </div>
                        </header>
                        <button id="actualizar"class="btn btn-success">Actualizar</button>
                        <div id="cp"class="card-body p-0">
                            <table class="compra table table-hover text-nowrap">
                                <thead class='table-success'>
                                    <tr>
                                        <th scope="col">Numero</th>
                                        <th scope="col">Prodcuto</th>
                                        <th scope="col">Precio</th>
                                        
                                        <th scope="col">Laboratorio</th>
                                        <th scope="col">Presentacion</th>
                                        <th scope="col">Cantidad</th>
                                        <th scope="col">Sub Total</th>
                                        <th scope="col">Eliminar</th>
                                    </tr>
                                </thead>
                                <tbody id="lista-compra" class='table-active'>
                                    
                                </tbody>
                            </table>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="card card-default">
                                        <div class="card-header">
                                            <h3 class="card-title">
                                            <i class="fas fa-dollar-sign"></i>
                                            Calculo 1
                                            </h3>
                                        </div>
                                        <div class="card-body">
                                            
                                            <div class="info-box mb-3 bg-info">
                                                <span class="info-box-icon"><i class="fas fa-tag"></i></span>
                                                <div class="info-box-content">
                                                    <span class="info-box-text text-left ">Total</span>
                                                    <span class="info-box-number" id="total_sin_descuento">12</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="card card-default">
                                        <div class="card-header">
                                            <h3 class="card-title">
                                            <i class="fas fa-bullhorn"></i>
                                            Calculo 2
                                            </h3>
                                        </div>
                                        <div class="card-body">
                                            <div class="info-box mb-3 bg-danger">
                                                <span class="info-box-icon"><i class="fas fa-comment-dollar"></i></span>
                                                <div class="info-box-content">
                                                    <span class="info-box-text text-left ">DESCUENTO</span>
                                                    <input id="descuento"type="number" min="1" placeholder="Ingrese descuento" class="form-control">
                                                </div>
                                            </div>
                                            <div class="info-box mb-3 bg-info">
                                                <span class="info-box-icon"><i class="ion ion-ios-cart-outline"></i></span>
                                                <div class="info-box-content">
                                                    <span class="info-box-text text-left ">TOTAL</span>
                                                    <span class="info-box-number" id="total">12</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                        <div class="row justify-content-between">
                            
                            <div class="col-xs-12 col-md-4">
                                <a href="#" class="btn btn-success btn-block" id="procesar-compra">Realizar compra</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
        

        
        
    </div>

<?php
    include_once 'layouts/footer.php';
} else {
    header('Location: ../index.php');
}
?>

