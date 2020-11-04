<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>loging</title>
    <link href="https://fonts.googleapis.com/css2?family=Mukta:wght@600&family=Poppins:wght@700&display=swap" rel="stylesheet">
    <link rel="stylesheet"type= "text/css" href="css/style.css">
    <link rel="stylesheet"type= "text/css" href="css/css/all.min.css">
</head>
<?php
session_start();
if(!empty($_SESSION['tipousuario_idtipousuario'])){
    header('Location: controlador/loginController.php');//si existe

}else{//no
    session_destroy();
?>
<body>
    <img class="wave"src="img/wave.png" alt="">  
    <div class="contenedor">
       <div  class="img">
           <img src="img/farma.svg" alt="">
       </div>
        <div class="contenido-login">
            <form action="controlador/loginController.php" method="post">
              <img src="img/usu.png" alt="">
              <h2>Farmacia Stephanie</h2>
              <div class="input-div dni">
                 <div class="i">
                     <i class="fas fa-user"></i>
                 </div>
                 <div class="div">
                     <h5>Cedula de identidad</h5>
                     <input type="text" name="user" class="input">
                 </div>
              </div>
              <div class="input-div pass">
                  <div class="i">
                      <i class="fas fa-lock"></i>
                  </div>
                  <div class="div">
                       <h5>Contrasena</h5>
                       <input type="password" name="pass" class="input">
                  </div>
              </div>
              <input type="submit" class="btn" value ="Iniciar Sesion">
            </form>
        </div>
    </div>
</body>
<script src="javas/login.js"></script>
</html>
<?php
}
?>