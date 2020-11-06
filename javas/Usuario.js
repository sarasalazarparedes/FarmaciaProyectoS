$(document).ready(function () {
    var funcion='';
    var usuario = $('#usuario').val();
    var edit=false;
    buscar_usuario(usuario);
    function buscar_usuario(dato) {
        funcion='buscar_usuario';
        $.post('../controlador/UsuarioController.php',{dato,funcion},(response)=>{
           console.log(typeof response);
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

            console.log(typeof response);
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
            $('#telefonou').html(telefono);
            $('#residenciau').html(residenciau);
            $('#correou').html(correou);
            $('#adicionalu').html(adicionalu);

            

        }) 
    }
    //on evento de un click y ejecuta fun Sara
    $(document).on ('click','.edit',(e)=>{
        funcion='capturar_datos';
        edit=true;
        $.post('../controlador/UsuarioController.php',{funcion,usuario},(response)=>{
           // console.log(response);
            const usu = JSON.parse(response);
              $('#telefono').val(usu.telefono);
              $('#residenci').val(usu.residenciau);
              $('#corre').val(usu.correou);
              $('#adicional').val(usu.adicionalu);

              //console.log(usu.residenciau);
              //console.log(usu.correou);
              //console.log(usu.adicionalu);
              //console.log('#residenciau');
            
        })
    });
    //val captura dato
    $('#form-usuario').submit(e=>{
        if(edit==true){
            let telefono=$('#telefono').val();
            let residenciau=$('#residenci').val();
            let correou=$('#corre').val();
            let adicionalu=$('#adicional').val();
            funcion='editar_usuario';
            $.post('../controlador/UsuarioController.php',{usuario,funcion,telefono,residenciau,correou,adicionalu},(response)=>{
                console.log(response);
                if(response='editado'){
                    $('#editado').hide('slow');
                    $('#editado').show(1000);
                    $('#editado').hide(2000);
                    $('#form-usuario').trigger('reset');
                }
                edit=false;
                buscar_usuario(usuario);
               // console.log(telefono);
            })

        }else{
            $('#noeditado').hide('slow');
            $('#noeditado').show(1000);
            $('#noeditado').hide(2000);
           $('#form-usuario').trigger('reset');//campos del input en vacio

        }
        e.preventDefault();

    });

    $('#form-pass').submit(e=>{
        let oldpass=$('#oldpass').val();
        let newpass=$('#newpass').val();
        funcion='cambiar_contra';
        $.post('../controlador/UsuarioController.php',{usuario,funcion,oldpass,newpass},(response)=>{
            console.log(response);
            if(response=='updateeditado'){
                $('#update').hide('slow');
                $('#update').show(1000);
                $('#update').hide(2000);
                $('#form-pass').trigger('reset');


            }else{
                $('#noupdate').hide('slow');
                $('#noupdate').show(1000);
                $('#noupdate').hide(2000);
                $('#form-pass').trigger('reset');


            }
            
            
            
           
        })

        e.preventDefault();
       

    })

    



    
})