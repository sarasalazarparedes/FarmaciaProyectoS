<?php
session_start();
if($_SESSION['tipousuario_idtipousuario']==1 || $_SESSION['tipousuario_idtipousuario']==3 ){
    include_once 'layouts/header.php';
?>

  <title>Administrador | Editar datos</title>
  <!-- Tell the browser to be responsive to screen width -->
  <?php
  include_once 'layouts/nav.php';
  ?>
<div class="modal fade" id="crearusuario" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
         <div class="card card-success">
             <div class="card-header">
                 <h3 class="card-title">Crear producto</h3>
                 <button data-dismiss="modal" aria-label="close" class="close">
                    <span aria-hidden="true">&times;</span>
                    </button>
               </div>    
                    <div class="card-body">
                       <div class="alert alert-success text-center" id="add" style='display:none'>
                            <span><i class="fas fa-check m-1"></i>Se creo Exitosamente</span>
                         </div>
                         <div class="alert alert-danger text-center" id="noadd" style='display:none'>
                              <span><i class="fas fa-times m-1"></i> Error, ya existe el producto</span>
                           </div>

                 <form id="form-crear-producto">
                     <div class="form-group">
                         <label for="nombre">Nombre</label>
                         <input id="nombre"type="text" class="form-control"placeholder="Ingrese nombre" required>
                         
                     </div>
                     <div class="form-group">
                         <label for="concentracion">Concentracion</label>
                         <input id="concentracion"type="text" class="form-control"placeholder="Ingrese concentracion" required>
                         
                     </div>
                     <div class="form-group">
                         <label for="adicional">Adicional</label>
                         <input id="adicional"type="text" class="form-control"placeholder="Ingrese informacion adicional" >
                         
                     </div>
                     <div class="form-group">
                         <label for="precio">Precio</label>
                         <input id="precio"type="number" class="form-control" value='1' placeholder="Ingrese precio" required>
                         
                     </div>
                     <div class="form-group">
                         <label for="laboratorio">Laboratorio</label>
                        <select name="laboratorio" id="laboratorio" class="form-control"></select>
                     </div>
                     <div class="form-group">
                         <label for="tipo">Tipo</label>
                        <select name="tipo" id="tipo" class="form-control"></select>
                         
                     </div>
                     <div class="form-group">
                         <label for="presentacion">Presentacion</label>
                        <select name="presentacion" id="presentacion" class="form-control"></select>
                         
                     </div>
                     <div class="card-footer">
                         <button type="submit"class="btn bg-gradient-purple float-right m-2">Guardar</button>
                         <button type="button" data-dismiss="modal"class="btn bg-gradient-danger float-right m-2">Cerrar</button>
                 </form>
             </div>
         </div>  
     </div>

     
    </div>
  </div>
</div>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Gestion Producto  <button type="button" id="button-crear" data-toggle="modal" data-target="#crearusuario" class="btn bg-gradient-primary ml-2">Crear producto</button></h1>
              </div>
                <div class="col-sm-6">
                   <ol class="breadcrumb float-sm-right">
                     <li class="breadcrumb-item"><a href="../vista/adm_catalogo.php">Home</a></li>
                     <li class="breadcrumb-item active">Gestion Producto</li>
                 </ol>
            </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <section>
    <div class="container-fluid">
        <div class="card card-success">
            <div class="card-header">
            <h3 class="card-title">Buscar Producto</h3>
            <div class="input-group">
                <input type="text" id="buscar-producto"class="form-control float-left" placeholder="Ingrese nombre de producto">
                <div class="input-group-append">
                    <button class="btn btn-default"><i class="fas fa-search"></i></button>
                </div>
            </div>
            </div>
            <div class="card-body">
              <div id="productos" class="row d-flex align-items-lg-stretch">

            
              </div>
            </div>
            <div class="card-footer">
               
            
            </div>
        </div>
    </div>
    
   </section>
</div>
<!-- ./wrapper -->

<?php
include_once 'layouts/footer.php';
}else{
    header ('Location: ../index.php');
}
?>
<script src="../javas/Producto.js"></script>
