<?php
session_start();
if ($_SESSION['tipousuario_idtipousuario'] == 1 || $_SESSION['tipousuario_idtipousuario'] == 3) {
  include_once 'layouts/header.php';
?>

  <title>Administrador | Pagina

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
            <h1>Catalogo</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Catalogo</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->

      </section>
    <div class="container-fluid">
      <div class="card card-danger">
        <div class="card-header">
          <h3 class="card-title">Lotes en riesgo</h3>
         
        </div>
        <div class="card-body p-0 table-responsive">
          <table class="table table-hover text-nowrap">
            <thead class="table-success">
              <tr>
                <th>Codigo Producto</th>
                <th>Producto</th>
                <th>stock</th>
                <th>Laboratorio</th>
                <th>Presetacion</th>
                <th>Proveedor</th>
                <th>Mes</th>
                <th>Dias</th>
              </tr>
            </thead>
            <tbody id="lotes" class="table-active">

            </tbody>
          </table>
         
        </div>
        <div class="card-footer">
        </div>
      </div>
    </div>
    </section>

    </section>
    <div class="container-fluid">
      <div class="card card-success">
        <div class="card-header">
          <h3 class="card-title">Buscar Producto</h3>
          <div class="input-group">
            <input type="text" id="buscar-producto" class="form-control float-left" placeholder="Ingrese nombre de producto">
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

<?php
  include_once 'layouts/footer.php';
} else {
  header('Location: ../index.php');
}
?>
<script src="../javas/Catalogo.js"></script>
<script src="../javas/Carrito.js"></script>