$(document).ready(function(){
  var funcion;
  buscar_producto();
  var edit=false;
  $('.select2').select2();
  rellenar_tipos();
  rellenar_presentaciones();
  rellenar_laboratorios();
  rellenar_proveedores();
  function rellenar_proveedores() {
    funcion='rellenar_proveedores';
    $.post('../controlador/ProveedoresController.php',{funcion},(response)=>{
        const proveedores=JSON.parse(response);
        console.log(response);
        let template='';
        proveedores.forEach(proveedor => {
            template+=`
            <option value="${proveedor.id}">${proveedor.nombre}</option>
            `;
        });
        $('#proveedor').html(template);
    })
}
  function rellenar_laboratorios() {
      funcion='rellenar_laboratorios';
      $.post('../controlador/LaboratorioController.php',{funcion},(response)=>{
          const laboratorios=JSON.parse(response);
          console.log(response);
          let template='';
          laboratorios.forEach(laboratorio => {
              template+=`
              <option value="${laboratorio.id}">${laboratorio.nombre}</option>
              `;
          });
          $('#laboratorio').html(template);
      })
  }
  function rellenar_tipos(){
      funcion="rellenar_tipos";
      $.post('../controlador/TipoController.php',{funcion},(response)=>{
          const tipos=JSON.parse(response);
          let template='';
          tipos.forEach(tipo => {
              template+=`
              <option value="${tipo.id}">${tipo.nombre}</option>
              `;
          });
          $('#tipo').html(template);
      })

  }
  function rellenar_presentaciones(){
      funcion="rellenar_presentaciones";
      $.post('../controlador/PresentacionController.php',{funcion},(response)=>{
          const presentaciones=JSON.parse(response);
          let template='';
          presentaciones.forEach(presentacion => {
              template+=`
              <option value="${presentacion.id}">${presentacion.nombre}</option>
              `;
          });
          $('#presentacion').html(template);
      })
  }
  $('#form-crear-producto').submit(e=>{
    let id= $('#id_edit_prov').val();
      let nombre=$('#nombre').val();
      let concentracion=$('#concentracion').val();
      let adicional=$('#adicional').val();
      let precio=$('#precio').val();
      let laboratorio=$('#laboratorio').val();
      let tipo=$('#tipo').val();
      let presentacion=$('#presentacion').val();
      
      funcion="crear";
      console.log(nombre+concentracion+adicional+precio+laboratorio+tipo+presentacion);
      $.post('../controlador/ProductoController.php',{funcion,nombre,concentracion,adicional,precio,laboratorio,tipo,presentacion,id},(response)=>{
        if(edit==true){
          funcion='editar';
        }else{
          funcion='crear';
        }
        console.log(response);
          if(response=='add'){
              $('#add').hide('slow');
              $('#add').show(1000);
              $('#add').hide(2000);
              $('#form-crear-producto').trigger('reset');
              buscar_producto();
          }
          else{
              $('#noadd').hide('slow');
              $('#noadd').show(1000);
              $('#noadd').hide(2000);
              $('#form-crear-producto').trigger('reset');
          }
          edit=false;
      });
      e.preventDefault();

  })
  function buscar_producto(consulta){
      funcion='buscar';
      $.post('../controlador/ProductoController.php',{consulta,funcion},(response)=>{
          const productos = JSON.parse(response);
          console.log(response);
          let template='';
          productos.forEach(producto => {
              template+=`
              <div prodId="${producto.id}" prodStock="${producto.stock}" prodNombre="${producto.nombre}" prodPrecio="${producto.precio}" prodConcentracion="${producto.concentracion}" prodAdicional="${producto.adicional}" prodLaboratorio="${producto.laboratorio}" prodTipo="${producto.tipo}" prodPresentacion="${producto.presentacion}" prodAvatar="${producto.avatar}"class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch">
              <div class="card bg-light">
                <div class="card-header text-muted border-bottom-0">
                  <i class="fas fa-lg fa-cubes mr-1"> </i>${producto.stock}
                </div>
                <div class="card-body pt-0">
                  <div class="row">
                    <div class="col-7">
                      <h2 class="lead"><b>${producto.nombre}</b></h2>
                     
                      <ul class="ml-4 mb-0 fa-ul text-muted">
                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-mortar-pestle"></i></span> Concentracion: ${producto.concentracion}</li>
                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-prescription"></i></span> Adicional #: ${producto.adicional}</li>
                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-flask"></i></span> Laboratorio: ${producto.laboratorio}</li>
                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-copyright"></i></span> Tipo: ${producto.tipo}</li>
                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-prescription"></i></span> Presentacion: ${producto.presentacion}</li>
                      </ul>
                    </div>
                    <div class="col-5 text-center">
                      <img src="${producto.avatar}" alt="" class="img-circle img-fluid">
                    </div>
                  </div>
                </div>
                <div class="card-footer">
                  <div class="text-right">
                    <button class="avatar btn btn-sm bg-teal" title="Editar logo" type="button" data-toggle="modal" data-target="#cambiologo">
                      <i class="fas fa-image"></i> Editar Logo
                    </button>
                    <button class="editar btn btn-sm btn-success" title="Editar producto"type="button" data-toggle="modal" data-target="#crearusuario">
                      <i class="fas fa-pencil-alt"></i> Editar producto
                    </button>
                    <button class="lote btn btn btn-sm btn-primary" title="Agregar"type="button" data-toggle="modal" data-target="#crearlote"  >
                      <i class="fas fa-plus-square"></i> Agregar
                    </button>
                    <button class="borrar btn btn-sm btn-danger" title="Borrar producto">
                      <i class="fas fa-trash-alt"></i> Borrar producto
                    </button>
                  </div>
                </div>
              </div>
            </div>
             
            `;
                
          });
          $('#productos').html(template);
             
        });
        
    }
  $(document).on('keyup','#buscar-producto',function(){
      let valor=$(this).val();
      if(valor!=""){
          buscar_producto(valor);
      }
      else{
          buscar_producto();
      }
  });
  $(document).on('click','.editar',(e)=>{
  
      const elemento=$(this)[0].activeElement.parentElement.parentElement.parentElement.parentElement;
      const id=$(elemento).attr('prodId');
      const nombre=$(elemento).attr('prodNombre');
      //console.log(id+nombre);
      const concentracion=$(elemento).attr('prodConcentracion');
      const adicional=$(elemento).attr('prodAdicional');
      const precio=$(elemento).attr('prodPrecio');
      const laboratorio=$(elemento).attr('prodLaboratorio');
      const tipo=$(elemento).attr('prodTipo');
      const presentacion=$(elemento).attr('prodPresentacion');
      console.log(id+''+laboratorio);
      $('#id_edit_prod').val(id);
      $('#nombre').val(nombre);
      $('#concentracion').val(concentracion);
      $('#adicional').val(adicional);
      $('#precio').val(precio);
      $('#laboratorio').val(laboratorio).trigger('change');
      $('#tipo').val(tipo).trigger('change');
      $('#presentacion').val(presentacion).trigger('change');
      edit=true;
    })
    //const elemento=$(this)[0].activeElement.parentElement.parentElement.parentElement.parentElement;
    $(document).on('click','.borrar',(e)=>{
      funcion="borrar";
      const elemento=$(this)[0].activeElement.parentElement.parentElement.parentElement.parentElement;
      const id=$(elemento).attr('prodId');
      const nombre=$(elemento).attr('prodNombre');
      const avatar=$(elemento).attr('prodAvatar');
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
              $.post('../controlador/ProductoController.php',{id,funcion},(response)=>{
                edit=false;
                if(response='borrado'){
                  'el producto ya fue eliminado',
                  'success'
                }
                console.log(id,funcion);
                  edit==false;
                  console.log(response);
                  buscar_producto();
              })
           } else if (result.dismiss === Swal.DismissReason.cancel)
          {
            swalWithBootstrapButtons.fire(
              'Cancelled',
              'Your imaginary file is safe :)',
              'error'
            )
            buscar_producto();
            
            

          }
        })
  })
  $(document).on('click','.avatar',(e)=>{
    funcion="cambiar_avatar";
    const elemento= $(this)[0].activeElement.parentElement.parentElement.parentElement.parentElement;
    const id = $(elemento).attr('prodId');
    const nombre = $(elemento).attr('prodNombre');
    const avatar = $(elemento).attr('prodAvatar');
    $('#logoactual').attr('src',avatar);
    $('#nombre_logo').html(nombre);
    $('#id_logo_prod').val(id);
    $('#funcion').val(funcion);
    $('#avatar').val(avatar);

});
$(document).on('click','.lote',(e)=>{
  const elemento= $(this)[0].activeElement.parentElement.parentElement.parentElement.parentElement;
  const id = $(elemento).attr('prodId');
  const nombre = $(elemento).attr('prodNombre');

  $('#id_lote_prod').val(id);
  $('#nombre_producto_lote').html(nombre);

});
$('#form-logo').submit(e=>{
  let formData = new FormData($('#form-logo')[0]);
  $.ajax({
      url:'../controlador/ProductoController.php',
      type:'POST',
      data: formData,
      cache: false,
      processData: false,
      contentType:false
  }).done(function(response){
    console.log(response);
      const json = JSON.parse(response);
      if(json.alert=='edit'){
        $('#logoactual').attr('src',json.ruta);
        $('#edit').hide('slow');
        $('#edit').show(1000);
        $('#edit').hide(2000);
        $('#form-logo').trigger('reset');
        buscar_producto();
       

    }else{
        $('#noedit').hide('slow');
        $('#noedit').show(1000);
        $('#noedit').hide(2000);
        $('#form-logo').trigger('reset');

    }
      

  });
  e.preventDefault();
});
$('#form-crear-lote').submit(e=>{
let id_producto=$('#id_lote_prod').val();
console.log(id_producto);
let proveedor=$('#proveedor').val();
console.log(proveedor);
let stock=$('#stock').val();
let vencimiento=$('#vencimiento').val();
funcion="crear";
$.post('../controlador/LoteController.php',{funcion,vencimiento,stock,proveedor,id_producto},(response)=>{
  $('#add-lote').hide('slow');
  $('#add-lote').show(1000);
  $('#add-lote').hide(2000);
  $('#form-crear-lote').trigger('reset');
  buscar_producto();
});
e.preventDefault();
})
})