$(document).ready(function(){
    buscar_tip();
    var funcion;
    var edit=true;
    $('#form-crear-presentacion').submit(e=>{
        console.log('h');
        let nombre_presentacion=$('#nombre-presentaciones').val();
        let id_editado=$('#id_editar_pre').val();
        if(edit==true){
            funcion='crear';   
        }
        if(edit==false){
            funcion='editar';
            console.log(funcion);
        }
        $.post('../controlador/PresentacionController.php',{nombre_presentacion,id_editado,funcion},(response)=>{
            if(response=='add'){
                console.log (response);
                $('#add-pre').hide('slow');
                $('#add-pre').show(1000);
                $('#add-pre').hide(2000);
                $('#form-crear-presentacion').trigger('reset');
                buscar_tip();
            }
            if(response=='noadd'){
                $('#noadd-pre').hide('slow');
                $('#noadd-pre').show(1000);
                $('#noadd-pre').hide(2000);
                $('#form-crear-presentacion').trigger('reset');
            }
            if(response=='edit'){
                console.log (response);
                $('#edit-pre').hide('slow');
                $('#edit-pre').show(1000);
                $('#edit-pre').hide(2000);
                $('#form-crear-presentacion').trigger('reset');
                buscar_tip();
            }
            edit=false;
        });
        e.preventDefault();
    });
    function buscar_tip(consulta){
        funcion='buscar';
        $.post('../controlador/PresentacionController.php',{consulta,funcion},(response)=>{
            console.log(response);
            //const laboratorios = JSON.parse(JSON.stringify(response));
            //const laboratorios = response;
            const presentaciones = JSON.parse(response);
            let template='';
          
            presentaciones.forEach(presentacion => {
                template+=`
                <tr preId="${presentacion.id}" preNombre="${presentacion.nombre}">
                    <td>
                        <button class="editar-tip btn btn-success" title="Editar presentacion type="button" data-toggle="modal" data-target="#crearpresentacion"><i class="fas fa-pencil-alt"></i>
                        </button>
                        <button class="borrar-tip btn btn-danger" title="Eliminar presentacion"><i class="fas fa-trash-alt"></i>
                        </button>
                    </td>
                    <td>${presentacion.nombre} </td>
                </tr>
                `;
            });

            $('#presentaciones').html(template);
        })
    }
    $(document).on('keyup','#buscar-presentacion',function(){
        let valor =$(this).val();
        if(valor!=''){
            buscar_tip(valor);
        }
        else{
            buscar_tip();
        }
    })
 
    $(document).on('click','.borrar-presentacion',(e)=>{
        funcion="borrar";
        const elemento=$(this)[0].activeElement.parentElement.parentElement;
        const id=$(elemento).attr('preId');
        const nombre=$(elemento).attr('preNombre');
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
              confirmButton: 'btn btn-success',
              cancelButton: 'btn btn-danger mr-1'
            },
            buttonsStyling: false
          })
          swalWithBootstrapButtons.fire({
            title: 'Desea eliminar tipo:  '+nombre+'?',
            text: "No podrás revertir esto!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, borrar esto!',
            cancelButtonText: 'No, cancelar!',
            reverseButtons: true
          }).then((result) => {
            if (result.dismiss === Swal.DismissReason.confirmButton) {
                //console.log(id,funcion);
                $.post('../controlador/PresentacionController.php',{id,funcion},(response)=>{
                    console.log(id,funcion);
                    edit=false;
                    console.log(response);
                })
             } else if (result.dismiss === Swal.DismissReason.cancel)
            {
              swalWithBootstrapButtons.fire(
                'Cancelled',
                'Your imaginary file is safe :)',
                'error'
              )
            }
          })
    })
    $(document).on('click','.editar-pre',(e)=>{
        const elemento=$(this)[0].activeElement.parentElement.parentElement;
        const id=$(elemento).attr('preId');
        const nombre=$(elemento).attr('pre  Nombre');
        $('#id_editar_pre').val(id);
        $('#nombre-presentacion').val(nombre);
        edit=false;
    })
});