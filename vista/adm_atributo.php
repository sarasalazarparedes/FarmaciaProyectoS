<?php
session_start();
if($_SESSION['tipousuario_idtipousuario']==1){
    include_once 'layouts/header.php';
?>

  <title>Administrador | Atributo

  </title>
  <!-- Tell the browser to be responsive to screen width -->
  <?php
  include_once 'layouts/nav.php';
  ?>
  <div class="modal fade" id="crearlaboratorio" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidder="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="card card-success">
                    <div class="card-header">
                        <h3 class="card-title">Crear Laboratorio</h3>
                        <button data-dismiss="modal" aria-label="close" class="close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="alert alert-success text-center" id="add-laboratorio" style='display:none;'>
                            <span><i class="fas fa-check m-1"></i>Se agrego correctamente</span> 
                        </div>
                    <div class="alert alert-danger text-center" id="noadd-laboratorio" style='display:none;'>
                        <span><i class="fas fa-check m-1"></i>El laboratorio ya existe</span> 
                    </div>
                    <form id="form-crear-laboratorio">
                        <div class="form-group">
                            <label for="nombre-laboratorio">Nombre</label>
                            <input id="nombre-laboratorio" type="text" class="form-control" placeholder="Ingrese nombre" required>
                        </div>
                    </div>
                    <div class="card-footer">
                    <button type="submit" class="btn bg-gradient-primary float-right m-1">Crear</button>
                    <button type="button" data-dismiss="modal" class="btn btn-outline-secondary  float-right m-1">Cerrar</button>
                    </form>
                    </div>
                </div>
    
            </div>
        </div>
  </div>
  <div class="modal fade" id="creartipo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidder="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="card card-success">
                    <div class="card-header">
                        <h3 class="card-title">Crear Tipo</h3>
                        <button data-dismiss="modal" aria-label="close" class="close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="alert alert-succes text-center" id="add" style='display:none;'>
                            <span><i class="fas fa-check m-1"></i>Se agrego ocrectamente</span> 
                        </div>
                    <div class="alert alert-danger text-center" id="noadd" style='display:none;'>
                        <span><i class="fas fa-check m-1"></i>El DNI ya esxite</span> 
                    </div>
                    <form id="form-crear-tipo">
                        <div class="form-group">
                            <label for="nombre-tipo">Nombre</label>
                            <input id="nombre-tipo" type="text" class="form-control" placeholder="Ingrese nombre" required>
                        </div>
                    </div>
                    <div class="card-footer">
                    <button type="submit" class="btn bg-gradient-primary float-right m-1">Crear</button>
                    <button type="button" data-dismiss="modal" class="btn btn-outline-secondary  float-right m-1">Close</button>
                    </form>
                    </div>
                </div>
    
            </div>
        </div>
  </div>
  <div class="modal fade" id="crearpresentacion" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidder="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="card card-success">
                    <div class="card-header">
                        <h3 class="card-title">Crear Presentacion</h3>
                        <button data-dismiss="modal" aria-label="close" class="close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="alert alert-succes text-center" id="add" style='display:none;'>
                            <span><i class="fas fa-check m-1"></i>Se agrego ocrectamente</span> 
                        </div>
                    <div class="alert alert-danger text-center" id="noadd" style='display:none;'>
                        <span><i class="fas fa-check m-1"></i>El DNI ya esxite</span> 
                    </div>
                    <form id="form-crear-presentacion">
                        <div class="form-group">
                            <label for="nombre-presentacion">Nombre</label>
                            <input id="nombre-presentacion" type="text" class="form-control" placeholder="Ingrese nombre" required>
                        </div>
                    </div>
                    <div class="card-footer">
                    <button type="submit" class="btn bg-gradient-primary float-right m-1">Crear</button>
                    <button type="button" data-dismiss="modal" class="btn btn-outline-secondary  float-right m-1">Close</button>
                    </form>
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
            <h1>Gestion atributos</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Gestion Atributos</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid"> 
            <div class="row">
                <div class="col-md-12">
                    <div class="card"> 
                        <div class="card-header">
                            <ul class="nav nav_pills">
                                <li class="nav-item"> <a href="#laboratorio" class="nav-link active" data-toggle="tab"> Laboratorio</a></li>
                                <li class="nav-item"> <a href="#tipo" class="nav-link" data-toggle="tab"> Tipo</a></li>
                                <li class="nav-item"> <a href="#presentacion" class="nav-link" data-toggle="tab"> Presentacion</a></li>
                            </ul>
                        </div>
                        <div class="card-body">
                            <div class="tab-content" >
                                <div class="tab-pane active"id='laboratorio' >
                                    <div class="card card-success">
                                        <div class="card-header">
                                            <div class="card-title">Buscar laboratorio <button type="button" data-toggle="modal" data-target="#crearlaboratorio" class="btn bg-gradient-primary btn-sm m-2">Crear Laboratorio</button></div>
                                            <div class="input-group">
                                                <input id="buscar-laboratorio" type="text" class="form-control float-left" placeholder="Ingrese nombre">
                                                <div class="input-group-append">
                                                <button class="btn btn-default"><i class="fas fa-search"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body p-0">
                                            <table class="table table-over text-nowrap">
                                                <thead class="table-success">
                                                <tr>
                                                <th>Laboratorio</th>
                                                <th>Logo</th>
                                                <th>Accion</th>
                                                </tr>
                                                </thead>
                                                <tbody class="table-active" id="laboratorios">

                                                </tbody>
                                            </table>
                                        </div>

                                        <div class="card-footer"></div>
                                    </div>
                                </div>
                                <div class="tab-pane" id='tipo'>
                                    <div class="card card-success">
                                        <div class="card-header">
                                            <div class="card-title">Buscar tipo<button type="button" data-toggle="modal" data-target="#creartipo" class="btn bg-gradient-primary btn-sm m-2">Crear tipo</button></div>
                                            <div class="input-group">
                                                <input id="buscar-tipo" type="text" class="form-control float-left" placeholder="Ingrese nombre">
                                                <div class="input-group-append">
                                                <button class="btn btn-default"><i class="fas fa-search"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body"></div>
                                        <div class="card-footer"></div>
                                    </div>
                                </div>
                                <div class="tab-pane" id='presentacion'>
                                    <div class="card card-success">
                                        <div class="card-header">
                                            <div class="card-title">Buscar presentacion<button type="button" data-toggle="modal" data-target="#crearpresentacion" class="btn bg-gradient-primary btn-sm m-2">Crear presentacion</button></div>
                                            <div class="input-group">
                                                <input id="buscar-presentacion" type="text" class="form-control float-left" placeholder="Ingrese nombre">
                                                <div class="input-group-append">
                                                <button class="btn btn-default"><i class="fas fa-search"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body"></div>
                                        <div class="card-footer"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                    
                        </div>
                    </div>    
                </div>
            
            </div>
        </div> 
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<?php
include_once 'layouts/footer.php';
}else{
    header ('Location: ../index.php');
}
?>
<script src="../javas/Laboratorio.js"></script>