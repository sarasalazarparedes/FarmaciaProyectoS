$(document).ready(function(){
    buscar_pre();
    var funcion;
    var edit=false;
    $('#form-crear-presentacion').submit(e=>{
        let nombre_presentacion=$('#nombre-presentacion').val();
        let id_editado=$('#id_editar_pre').val();
        if(edit==false){
            funcion='crear';
            //e.preventDefault();
            //console.log (edit);
        }
        else{
            funcion='editar';
            console.log(nombre_presentacion+id_editado);
        }
        $.post('../controlador/PresentacionController.php',{nombre_presentacion,id_editado,funcion},(response)=>{
            console.log (response);
            if(response=='add'){
               
                $('#add-pre').hide('slow');
                $('#add-pre').show(1000);
                $('#add-pre').hide(2000);
                $('#form-crear-presentacion').trigger('reset');
                buscar_pre();
            }
            if(response=='noadd'){
                $('#noadd-pre').hide('slow');
                $('#noadd-pre').show(1000);
                $('#noadd-pre').hide(2000);
                $('#form-crear-presentacion').trigger('reset');
                buscar_pre();
            }
            if(response=='editar'){
                $('#edit-pre').hide('slow');
                $('#edit-pre').show(1000);
                $('#edit-pre').hide(2000);
                $('#form-crear-presentacion').trigger('reset');
                buscar_pre();
            }
            edit==false;
        });
        e.preventDefault();
    });
    function buscar_pre(consulta){
        funcion='buscar';
        $.post('../controlador/PresentacionController.php',{consulta,funcion},(response)=>{
           
            const presentaciones = JSON.parse(response);
            template='';
            

            presentaciones.forEach(presentacion => {
                template+=`
                <tr preId="${presentacion.id}" preNombre="${presentacion.nombre}">
                    <td>
                        <button class="editar-pre btn btn-success" title="Editar la presentacion" type="button" data-toggle="modal" data-target="#crearpresentaciones">
                            <i class="fas fa-pencil-alt"></i>
                        </button>
                        <button class="borrar-pre btn btn-danger" title="Eliminar presentacion">
                          <i class="fas fa-trash-alt"></i>
                        </button>
                    </td>
                    <td>${presentacion.nombre} </td>
                </tr>
                `;
            });

            $('#presentaciones').html(template);
        })
    }
    $(document).on('keyup','#buscar-presentaciones',function(){
        let valor =$(this).val();
        if(valor!=''){
            buscar_pre(valor);
        }
        else{
            buscar_pre();
        }
    })
    $(document).on('click','.borrar-pre',(e)=>{
        funcion='borrar';
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
                    edit==false;
                    //console.log(response);
                    buscar_pre();
                })
             } else if (result.dismiss === Swal.DismissReason.cancel)
            {
              swalWithBootstrapButtons.fire(
                'Cancelled',
                'Your imaginary file is safe :)',
                'error'
              )
              buscar_pre();
              
              

            }
          })
    })
    $(document).on('click','.editar-pre',(e)=>{
        const elemento=$(this)[0].activeElement.parentElement.parentElement;
        const id=$(elemento).attr('preId');
        const nombre=$(elemento).attr('preNombre');
        $('#id_editar_pre').val(id);
        $('#nombre-presentacion').val(nombre);
        edit=true;
        console.log(id+nombre);
    })
});