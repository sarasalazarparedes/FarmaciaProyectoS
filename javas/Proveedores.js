$(document).ready(function(){
    var funcion;



    $('#form-crear').submit(e=>{
        let nombre= $('#nombre').val();
        let telefono= $('#telefono').val();
        let correo= $('#ncorreo').val();
        let direccion= $('#direccion').val();
        funcion='crear';
        $.post('../controlador/ProveedorController.php',{nombre,telefono,correo,direccion,funcion},(response)=>{
             console.log(response);
        });
        e.preventDefault();

    });




});