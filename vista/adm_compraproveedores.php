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
                            <h1 class="titulo_cp">Gestion Compras</h1>
                            <div class="datos_cp">
                                <div class="form-group row">
                                    <span>Proveedor: </span>
                                    <div class="input-group-append col-md-6">
                                        <input type="text" class="form-control" id="nombre" placeholder="Ingresa nombre">
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
                        <button id="agregar"class="agregar btn btn-success " style=" float:right">AGREGAR</button>
                       
                        <div class="row justify-content-between">
                            
                            
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
<script src="../javas/CompraPro.js"></script>

