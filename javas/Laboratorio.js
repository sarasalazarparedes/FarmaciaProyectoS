$(document).ready(function(){
    buscar_lab();
    var funcion;
    var edit=false;
    $('#form-crear-laboratorio').submit(e=>{
        let nombre_laboratorio=$('#nombre-laboratorio').val();
        let id_editado=$('#id_editar_lab').val();
        console.log (edit);
        console.log(nombre_laboratorio,id_editado);
        if(edit==false){
            funcion='crear';

            //console.log (edit);
        }
        else{
            funcion='editar';
            //console.log(nombre_laboratorio+id_editado);
        }
        /*else{
            funcion='editar';
            console.log(funcion);
            console.log('no');
            console.log(nombre_laboratorio,id_editado);
            console.log (edit);
        }*/
        $.post('../controlador/LaboratorioController.php',{nombre_laboratorio,id_editado,funcion},(response)=>{
            if(response=='add-laboratorio'){
                console.log (response);
                $('#add-laboratorio').hide('slow');
                $('#add-laboratorio').show(1000);
                $('#add-laboratorio').hide(2000);
                $('#form-crear-laboratorio').trigger('reset');
                buscar_lab();
            }
            if(response=='noadd'){
                $('#noadd-laboratorio').hide('slow');
                $('#noadd-laboratorio').show(1000);
                $('#noadd-laboratorio').hide(2000);
                $('#form-crear-laboratorio').trigger('reset');
            }
            if(response=='edit'){
                $('#editl').hide('slow');
                $('#editl').show(1000);
                $('#editl').hide(2000);
                $('#form-crear-laboratorio').trigger('reset');
                buscar_lab();
            }
            edit==false;
        });
        e.preventDefault();
    });
    function buscar_lab(consulta){
        funcion='buscar';
        $.post('../controlador/LaboratorioController.php',{consulta,funcion},(response)=>{
            //console.log(response);
            //const laboratorios = JSON.parse(JSON.stringify(response));
            //const laboratorios = response;
            const laboratorios = JSON.parse(response);
            let template='';
           // console.log(laboratorios);
            //console.log(laboratorio);
            
            
            laboratorios.forEach(laboratorio => {
              // console.log(laboratorio);
                template+=`
                <tr labId="${laboratorio.id}" labNombre="${laboratorio.nombre}"labAvatar="${laboratorio.avatar}">
                    <td>
                        <button class="avatar btn btn-info" title="Cambiar logo de laboratorio" type="button" data-toggle="modal" data-target="#cambiologo" >
                              <i class="far fa-image"></i>
                        </button>
                        <button class="editar btn btn-success" title="Editar el laboratorio type="button" data-toggle="modal" data-target="#crearlaboratorio">
                             <i class="fas fa-pencil-alt"></i>
                        </button>
                        <button class="borrar btn btn-danger" title="Eliminar laboratorio">
                             <i class="fas fa-trash-alt"></i>
                        </button>
                    </td>
                    <td>
                        <img src="${laboratorio.avatar}" class="img-fluid rounded" width="70" heigth="70">
                    </td>
                    <td>${laboratorio.nombre} </td>
                </tr>
                `;
            });

            $('#laboratorios').html(template);
        })
    }
    $(document).on('keyup','#buscar-laboratorio',function(){
        let valor =$(this).val();
        if(valor!=''){
            buscar_lab(valor);
        }
        else{
            buscar_lab();
        }
    })
    $(document).on('click','.avatar',(e)=>{
        funcion="cambiar_logo";
        const elemento=$(this)[0].activeElement.parentElement.parentElement;
        const id=$(elemento).attr('labId');
        const nombre=$(elemento).attr('labNombre');
        const avatar=$(elemento).attr('labAvatar');
        $('#logoactual').attr('src',avatar);
        $('#nombre_logo').html(nombre);
        $('#funcion').val(funcion);
        $('#id_logo_lab').val(id);
    })
    $('#form-logo').submit(e=>{
        let formData = new FormData($('#form-logo')[0]);
        $.ajax({
            url:'../controlador/LaboratorioController.php',
            type:'POST',
            data:formData,
            cache:false,
            processData:false,
            contentType:false
        }).done(function(response){ 
            const json=$.parseJSON(response);
            if(json.alert=='edit'){
                $('#logoactual').attr('src',json.ruta);
                $('#form-logo').trigger('reset');
                $('#edit').hide('slow');
                $('#edit').show(1000);
                $('#edit').hide(2000);
                buscar_lab();

            }
            else{
                console.log('no');
                $('#noedit').hide('slow');
                $('#noedit').show(1000);
                $('#noedit').hide(2000);
            }
        });
        e.preventDefault();
    })
    $(document).on('click','.avatar',(e)=>{
        funcion="cambiar_logo";
        const elemento=$(this)[0].activeElement.parentElement.parentElement;
        const id=$(elemento).attr('labId');
        const nombre=$(elemento).attr('labNombre');
        const avatar=$(elemento).attr('labAvatar');
        $('#logoactual').attr('src',avatar);
        $('#nombre_logo').html(nombre);
        $('#funcion').val(funcion);
        $('#id_logo_lab').val(id);
    })
    $(document).on('click','.borrar',(e)=>{
        funcion="borrar";
        const elemento=$(this)[0].activeElement.parentElement.parentElement;
        const id=$(elemento).attr('labId');
        const nombre=$(elemento).attr('labNombre');
        const avatar=$(elemento).attr('labAvatar');
        console.log(id+nombre+avatar);
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
              confirmButton: 'btn btn-success',
              cancelButton: 'btn btn-danger mr-1'
            },
            buttonsStyling: false
          })
          swalWithBootstrapButtons.fire({
            title: 'Desea eliminar laboratorio:  '+nombre+'?',
            text: "No podrás revertir esto!",
            imageUrl:''+avatar+'',
            imageWidth:100,
            imageHeight:100,
            showCancelButton: true,
            confirmButtonText: 'Yes, borrar esto!',
            cancelButtonText: 'No, cancelar!',
            reverseButtons: true
          }).then((result) => {
            if (result.dismiss === Swal.DismissReason.confirmButton) {
                //console.log(id,funcion);
                $.post('../controlador/LaboratorioController.php',{id,funcion},(response)=>{
                    console.log(id,funcion);
                    edit==false;
                    console.log(response);
                    buscar_lab();
                })
             } else if (result.dismiss === Swal.DismissReason.cancel)
            {
              swalWithBootstrapButtons.fire(
                'Cancelled',
                'Your imaginary file is safe :)',
                'error'
              )
              buscar_lab();
              
              

            }
          })
    })
    $(document).on('click','.editar',(e)=>{
        buscar_lab();
        const elemento=$(this)[0].activeElement.parentElement.parentElement;
        const id=$(elemento).attr('labId');
        const nombre=$(elemento).attr('labNombre');
        $('#id_editar_lab').val(id);
        $('#nombre-laboratorio').val(nombre);
        edit=true;
        buscar_lab();
    })
});