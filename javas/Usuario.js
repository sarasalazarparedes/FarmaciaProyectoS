$(document).ready(function () {
    var funcion='';
    var usuario = $('#usuario').val();
    buscar_usuario(usuario);
    function buscar_usuario(dato) {
        funcion='buscar_usuario';
        $.post('../controlador/UsuarioController.php',{dato,funcion},(response)=>{
           //console.log(typeof response);
           console.log(response);

            let nombre='';
            let apellido='';
            let edad='';
            let cedula='';
            let tipo='';
            let telefono='';
            let residenciau='';
            let correou='';
            let adicionalu='';
            //const usu = JSON.parse(response);
            const usu = JSON.parse(response);
            //<--console.log(typeof response);
            nombre+=`${usu.nombre}`;
            apellido+=`${usu.apellido}`;
            edad+=`${usu.edad}`;
            cedula+=`${usu.cedula}`;
            tipo+=`${usu.tipo}`;
            telefono+=`${usu.telefono}`;
            residenciau+=`${usu.residenciau}`;
            correou+=`${usu.correou}`;
            adicionalu+=`${usu.adicionalu}`;
            $('#nombreu').html(nombre);
            $('#apellidou').html(apellido);
            $('#edad').html(edad);
            $('#cedulau').html(cedula);
            $('#tipousuario_idtipousuario').html(tipo);
            $('#telefonoU').html(telefono);
            $('#residenciau').html(residenciau);
            $('#correou').html(correou);
            $('#adicionalu').html(adicionalu);

            

        }) 
    }   
})