$(document).ready(function () {
    var funcion='';
    var usuario = $('#usuario').val();
    buscar_usuario(usuario);
    function buscar_usuario(dato) {
        funcion='buscar_usuario';
        $.post('../controlador/UsuarioController.php',{dato,funcion},(response)=>{
           //console.log(typeof response);
           //console.log(response);

            let nombre='';
            let apellido='';
            let edad='';
            let cedula='';
            let tipo='';
            let telefono='';
            let residencia='';
            let correo='';
            let adicional='';
            //const usu = JSON.parse(response);
            const usu = JSON.parse(response);
            //<--console.log(typeof response);
            nombre+=`${usu.nombre}`;
            apellido+=`${usu.apellido}`;
            edad+=`${usu.edad}`;
            cedula+=`${usu.cedula}`;
            tipo+=`${usu.tipo}`;
            telefono+=`${usu.telefono}`;
            residencia+=`${usu.residencia}`;
            correo+=`${usu.correo}`;
            adicional+=`${usu.adicional}`;
            $('#nombreu').html(nombre);
            console.log(usu.nombre);

        }) 
    }   
})