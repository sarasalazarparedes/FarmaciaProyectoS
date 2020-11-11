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
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Cambiar foto</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="text-center">
            <img id="avatar1"src="../img/avatar.png"class="profile-user-img img-fluid img-circle">
        </div>
        <div class="text-center">
           <b>
             <?php
                echo $_SESSION['nombreu']
             ?>
          </b>
     </div> 

     <div class="alert alert-success text-center" id="edit" style='display:none'>
           <span><i class="fas fa-check m-1"></i>Se cambio la imagen Exitosamente</span>
     </div>
      <div class="alert alert-danger text-center" id="noedit" style='display:none'>
            <span><i class="fas fa-times m-1"></i> La imagen no logro modifiarse</span>
     </div>

        <form id="form-photo"entype="multipart/form-data">
        <div class="input-group mb-3 ml-5 mt-2">
             <input type="file" name="photo" class="input-group">  
             <input type="hidden" name="funcion" value="cambiar_foto">  
        </div> 
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Cerra</button>
        <button type="submit" class="btn bg-gradient-primary">Guardar</button>
        </form>
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
    
   </section>
</div>
<!-- ./wrapper -->

<?php
include_once 'layouts/footer.php';
}else{
    header ('Location: ../index.php');
}
?>
<script src="../javas/Usuario.js"></script>
