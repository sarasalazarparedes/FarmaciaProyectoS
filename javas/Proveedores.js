$(document).ready(function(){
    var funcion;
     buscar_prov();
    $('#form-crear').submit(e=>{
        let nombre= $('#nombre').val();
        let telefono= $('#telefono').val();
        let correo= $('#correo').val();
        let direccion= $('#direccion').val();
        funcion='crear';
        $.post('../controlador/ProveedoresController.php',{nombre,telefono,correo,direccion,funcion},(response)=>{
            //console.log(response);
             if(response=='add'){
                $('#add-prov').hide('slow');
                $('#add-prov').show(1000);
                $('#add-prov').hide(2000);
                $('#form-crear').trigger('reset');

             }
             if(response=='noadd'){
                $('#noadd-prov').hide('slow');
                $('#noadd-prov').show(1000);
                $('#noadd-prov').hide(2000);
                $('#form-crear').trigger('reset');

             }
        });
        e.preventDefault();

    });
    function buscar_prov(consulta){
        funcion='buscar';
        $.post('../controlador/ProveedoresController.php',{consulta,funcion},(response)=>{
            const proveedores = JSON.parse(response);
            let template ='';
            proveedores.forEach(proveedor => {
                 template+=`
                 <div provId="${proveedor.id}"provNombre="${proveedor.nombre}"provTelefono="${proveedor.telefono}"provCorreo="${proveedor.correo}"provDireccion="${proveedor.direccion}"provAvatar="${proveedor.avatar}" class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch">
              <div class="card bg-light">
                <div class="card-header text-muted border-bottom-0">
                  <h1 class="badge badge-warning">Proveedor</h1>
                </div>
                <div class="card-body pt-0">
                  <div class="row">
                    <div class="col-7">
                      <h2 class="lead"><b>${proveedor.nombre}</b></h2>
                     
                      <ul class="ml-4 mb-0 fa-ul text-muted">
                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-building"></i></span> dirrecion: ${proveedor.direccion}</li>
                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-phone"></i></span> Telefono #: ${proveedor.telefono}</li>
                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-at"></i></span> Correo : ${proveedor.correo}</li>
                      </ul>
                    </div>
                    <div class="col-5 text-center">
                      <img src="${proveedor.avatar}" alt="" class="img-circle img-fluid">
                    </div>
                  </div>
                </div>
                <div class="card-footer">
                  <div class="text-right">
                    <button class="avatar btn btn-sm btn-info" title="Editar logo" type="button" data-toggle="modal" data-target="#cambiologo">
                      <i class="fas fa-image"></i> Editar Logo
                    </button>
                    <button class="editar btn btn-sm btn-success" title="Editar proveedor">
                      <i class="fas fa-pencil-alt"></i> Editar Proveedor
                    </button>
                    <button class="borrar btn btn-sm btn-danger" title="Borrar proveedor">
                      <i class="fas fa-trash-alt"></i> Borrar proveedor
                    </button>
                    
                    </a>
                  </div>
                </div>
              </div>
            </div>
                 `;
                
            });
            $('#proveedores').html(template);
             
        });
        
    }
    $(document).on('keyup','#buscar_proveedor',function(){
        let valor=$(this).val();
        if(valor!=''){
            buscar_prov(valor);
        }else{
            buscar_prov();
        }
        
    });
    $(document).on('click','.avatar',(e)=>{
        funcion="cambiar_logo";
        const elemento= $(this)[0].activeElement.parentElement.parentElement.parentElement.parentElement;
        const id = $(elemento).attr('provId');
        //console.log(id);
        const nombre = $(elemento).attr('provNombre');
        const avatar = $(elemento).attr('provAvatar');
        $('#logoactual').attr('src',avatar);
        $('#nombre_logo').html(nombre);
        $('#id_logo_prov').val(id);
        $('#funcion').val(funcion);
        $('#avatar').val(avatar);

       

    });
    $('#form-logo').submit(e=>{
        let formData = new FormData($('#form-logo')[0]);
        $.ajax({
            url:'../controlador/ProveedoresController.php',
            type:'POST',
            data: formData,
            cache: false,
            processData: false,
            contentType:false
        }).done(function(response){
            const json = JSON.parse(response);
            if(json.alert=='edit'){
                $('#logoactual').attr('src',json.ruta);
                $('#edit-prov').hide('slow');
                $('#edit-prov').show(1000);
                $('#edit-prov').hide(2000);
                $('#form-logo').trigger('reset');
                
                buscar_prov();
               

            }else{
                $('#noedit-prov').hide('slow');
                $('#noedit-prov').show(1000);
                $('#noedit-prov').hide(2000);
                $('#form-logo').trigger('reset');

            }
          
            

        });
        e.preventDefault();
    });

    





});