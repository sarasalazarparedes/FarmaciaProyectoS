<?php
session_start();
if ($_SESSION['tipousuario_idtipousuario'] == 1 || $_SESSION['tipousuario_idtipousuario'] == 3) {
  include_once 'layouts/header.php';
?>

  <title>Administrador | Gestion Ventas</title>
  <!-- Tell the browser to be responsive to screen width -->
  <?php
  include_once 'layouts/nav.php';
  ?>

  

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
     <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Gestion compras Proveedor</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="../vista/adm_catalogo.php">Home</a></li>
              <li class="breadcrumb-item active">Registro</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    
    <!-- Content Header (Page header) -->
    
    <section>
      <div class="container-fluid">
        <div class="card card-success">
          <div class="card-header">
            <h3 class="card-title">Registro</h3>

          </div>
          <div class="card-body">
            <table id="tabla_venta" class="display table table-hover text-nowrap" style="width:100%">
              <thead>
                <tr>
                  <th>Codigo</th>
                  <th>Fecha</th>
                  <th>cliente</th>
                  <th>Producto</th>
                  <th>Cantidad</th>
                   <th>Precio</th>
                   
                  
                   <th>Laboratorio</th>
                   <th>Presentacion</th>
                   
                   <th>Total</th>
                  
                </tr>
              </thead>
              <tbody>

              </tbody>

            </table>

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
} else {
  header('Location: ../index.php');
}
?>
<script src="../javas/datatables.js"></script>
<script src="../javas/Comprados.js"></script>