<?php
session_start();
if($_SESSION['tipousuario_idtipousuario']==1){
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
                 <h3 class="card-title">Crear usuario</h3>
                 <button data-dismiss="modal" aria-label="close" class="close">
                    <span aria-hidden="true">&times;</span>
                 
                 </button>
             </div>
             <div class="card-body">
                 <form id="form-crear">
                     <div class="form-group">
                         <label for="nombre">Nombres</label>
                         <input id="nombre"type="text" class="form-control"placeholder="Ingrese nombre" required>
                         
                     </div>
                     <div class="form-group">
                         <label for="apellido">Apellidos</label>
                         <input id="apellido"type="text" class="form-control"placeholder="Ingrese apellido" required>
                         
                     </div>
                     <div class="form-group">
                         <label for="edad">Nacimiento</label>
                         <input id="edad"type="date" class="form-control"placeholder="Ingrese fecha de nacimiento" required>
                         
                     </div>
                     <div class="form-group">
                         <label for="dni">cedula Identidad</label>
                         <input id="dni"type="text" class="form-control"placeholder="Ingrese cedula" required>
                         
                     </div>
                     <div class="form-group">
                         <label for="pass">Password</label>
                         <input id="pass"type="password" class="form-control"placeholder="Ingrese password" required>
                         
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
            <h1>Gestion Usuarios  <button type="button" data-toggle="modal" data-target="#crearusuario" class="btn bg-gradient-primary ml-2">Crear usuario</button></h1>
            
              </div>
                <div class="col-sm-6">
                   <ol class="breadcrumb float-sm-right">
                     <li class="breadcrumb-item"><a href="../vista/adm_catalogo.php">Home</a></li>
                     <li class="breadcrumb-item active">Gestion usuario</li>
                 </ol>
            </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <section>
    <div class="container-fluid">
        <div class="card card-success">
            <div class="card-header">
            <h3 class="card-title">Buscar Usuario</h3>
            <div class="input-group">
                <input type="text" id="buscar"class="form-control float-left" placeholder="Ingrese nombre de usuario">
                <div class="input-group-append">
                    <button class="btn btn-default"><i class="fas fa-search"></i></button>
                </div>
            </div>
            </div>
            <div class="card-body">
              <div id="usuarios" class="row d-flex align-items-lg-stretch">

            
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
<script src="../javas/Gestion_usuario.js"></script>
