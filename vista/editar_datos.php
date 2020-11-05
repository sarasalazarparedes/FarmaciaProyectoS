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


<!-- Modal -->
<div class="modal fade" id="cambiocontra" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Cambiar Password</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="text-center">
            <img src="../img/avatar.png"class="profile-user-img img-fluid img-circle">
        </div>
        <div class="text-center">
           <b>
             <?php
                echo $_SESSION['nombreu']
             ?>
          </b>
        </div>
        <form id="form-pass">
        <dib class="input-group mb-3">
             <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-unlock-alt"></i></span>
             </div>
             <input id="oldpass"type="password" class="form-control" placeholder="Ingrese contrasena actual">
        </dib> 

        <dib class="input-group mb-3">
             <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-lock"></i></span>
             </div>
             <input id="newpass"type="text" class="form-control" placeholder="Ingrese contrasena nueva">
        </dib> 



        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Cerra</button>
        <button type="submit" class="btn bg-gradient-primary">Guardar</button>
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
            <h1>Datos Personales</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="../vista/adm_catalogo.php">Home</a></li>
              <li class="breadcrumb-item active">Datos Personales</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
<section>
    <div class="content">
        <div class="container-fluid">
            <div class= " row">
                <div class="col-md-3">
                    <div class="card card-success card-outline"><!--lineas puestas-->
                        <div class="card-body box-profile">
                            <div class="text-center">
                                <img src="../img/avatar.png" class="profile-user-img img-fluid img-circle">
                            </div>
                            <input id="usuario"type="hidden" value="<?php echo $_SESSION['usuario']?>">
                                <h3 id="nombreu" class="profile-username text-center text-success">Nombre</h3>
                                <p id="apellidou" class="text-muted text-center">Apellidos</p>
                                <ul class="list-group list-group-unbordered mb-3">
                                    <li class="list-group-item">
                                        <b style="color:#0B7300">Edad</b><a id="edad" class="float-right">12</a>
                                    </li>
                                    <li class="list-group-item">
                                    <b style="color:#0B7300">Cedula</b><a id="cedulau" class="float-right">12</a>
                                    </li>
                                    <li class="list-group-item">

                                        <b style="color:#0B7300">Tipo Usuario</b>
                                         <span id="tipousuario_idtipousuario" class="float-right badge badge-primary">Administrador</span>
                                    </li>
                                    <button data-toggle="modal" data-target="#cambiocontra" type="button" class="btn btn-block btn-outline-warning btn-sm">Cambiar password</button>
                                </ul>
                         </div>
                      </div>
                        <div class="card card-success">
                             <div class ="card-header">
                             <h3 class =card-title>Sobre mi</h3>
                             </div>
                             <div class ="card-body">
                                <strong style="color: #0B7300 ">
                                  <i class=" fas fa-phone mr-1"></i> Telefono
                                </strong> 
                                <p id="telefonou" class="text-muted">5151561515</p>
                                <strong style="color: #0B7300 ">
                                  <i class=" fas fa-map-marked-alt mr-1"></i> Residencia
                                </strong> 
                                <p id="residenciau"class="text-muted">0</p>
                                <strong style="color: #0B7300 ">
                                  <i class=" fas fa-at mr-1"></i> Correo
                                </strong> 
                                <p id="correou" class="text-muted">5151561515</p>
                                <strong style="color: #0B7300 ">
                                  <i class=" fas fa-pencil-alt mr-1"></i> Informacion Adicional
                                </strong> 

                                <p id="adicionalu" class="text-muted">5151561515</p>
                                <button class="edit btn btn-block bg-gradient-danger">Editar</button>
                             </div>
                             <div class="card-footer">
                             <p class="text-muted">Click si desea editar</p>
                             </div>
                            </div>
                    
                            </div>
                <div class="col-md-9">
                   <div class="card card-success">
                       <div class="card-header">
                       <h3 class="card-title">Editar datos personales</h3>
                       </div>
                       <div class="card-body">
                       <div class="alert alert-success text-center" id="editado" style='display:none'>
                       <span><i class="fas fa-check m-1"></i>Edtado</span>
                       
                       </div>
                       <div class="alert alert-danger text-center" id="noeditado" style='display:none'>
                       <span><i class="fas fa-times m-1"></i> no Edtado</span>
                       
                       </div>
                           <form id='form-usuario' class="form-horizontal">
                               <div class="form-group row ">
                                  <label for="telefono" class="col-sm-2 col-form-label">Telefono</label>
                                  <div class="col-sm-10">
                                     <input type="number" id="telefono" class="form-control">
                                 </div>
                               </div> 

                               <div class="form-group row ">
                                  <label for="residenciau" class="col-sm-2 col-form-label">Residencia</label>
                                  <div class="col-sm-10">
                                     <input type="text" id="residenci" class="form-control">
                                 </div>
                               </div>  

                               <div class="form-group row ">
                                  <label for="correou" class="col-sm-2 col-form-label">Correo</label>
                                  <div class="col-sm-10">
                                     <input type="text" id="corre" class="form-control">
                                 </div>
                               </div>   

                               <div class="form-group row ">
                                  <label for="adicionalu" class="col-sm-2 col-form-label">Informacion Adicional</label>
                                  <div class="col-sm-10">
                                     <textarea class="form-control" id="adicional" cols="30" rows="10"></textarea>
                                 </div>
                               </div>
                               <div class="form-group row">
                                   <div class="offset-sm-2 col-sm-10 float-right">
                                      <button class="btn btn-block btn-outline-success">Guardar</button>
                                   </div>
                               
                               </div>    
                           </form>
                       </div>
                       <div class="card-footer">
                           <p class="text-muted">Estos datos se guardaran y se editaran</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>
</section>
<!-- ./wrapper -->

<?php
include_once 'layouts/footer.php';
}else{
    header ('Location: ../index.php');
}
?>
<script src="../javas/Usuario.js"></script>
