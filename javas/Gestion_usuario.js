$(document).ready(function(){
  var tipo_us = $('#tipo_us').val();
  if(tipo_us==2){
    $('#button-crear').hide();
  }
  //console.log(tipo_us);
    buscar_datos();
    var funcion;
   function buscar_datos(consulta) {
      funcion='buscar_usuarios_adm';
      $.post('../controlador/UsuarioController.php',{consulta,funcion},(response)=>{
        const usuarios = JSON.parse(response);
        let template ='';
        usuarios.forEach(us=>{
            template+=`
            <div usuarioid="${us.id}" class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch">
            <div class="card bg-light">
              <div class="card-header text-muted border-bottom-0">
               ${us.tipo}
              </div>
              <div class="card-body pt-0">
                <div class="row">
                  <div class="col-7">
                    <h2 class="lead"><b>${us.nombre} ${us.apellido}</b></h2>
                    <p class="text-muted text-sm"><b>Sobre mi: </b>${us.adicionalu} </p>
                    <ul class="ml-4 mb-0 fa-ul text-muted">
                      
                      <li class="small"><span class="fa-li"><i class="fas fa-lg fa-id_card"></i></span> Cedula:${us.cedula}</li>
                      <li class="small"><span class="fa-li"><i class="fas fa-lg fa-birthday-cake"></i></span> Cedula:${us.edad}</li>
                      <li class="small"><span class="fa-li"><i class="fas fa-lg fa-building"></i></span> Residencia:${us.residenciau}</li>
                      <li class="small"><span class="fa-li"><i class="fas fa-lg fa-phone"></i></span> Telefono #: ${us.telefono}</li>
                      <li class="small"><span class="fa-li"><i class="fas fa-lg fa-at"></i></span> Correo: ${us.correou}</li>
                      
                      
                      </ul>
                      </div>
                      <div class="col-5 text-center">
                        <img src="${us.avatar}" alt="" class="img-circle img-fluid">
                      </div>
                    </div>
                  </div>
                  <div class="card-footer">
                    <div class="text-right">`;
                if (tipo_us == 3) {
                  if (us.tipo_us != 3) {
                    template += `
                        <button class="borrar-usuario btn btn-danger mr-1" type="button" data-toggle="modal" data-target="#confirmar">
                           <i class="fas fa-window-close mr-1"></i>Eliminar
                       </button>
                        
                        `;
                  }
  
                } else {
                  if (tipo_us == 1 && us.tipo_us != 1 && us.tipo_us != 3) {
                    template += `
                        <button class="borrar-usuario btn btn-danger" type="button" data-toggle="modal" data-target="#confirmar">
                           <i class="fas fa-window-close mr-1"></i>Eliminar
                       </button>
                        
                        `;
  
                  }
  
                }
                template += `
                  
                    </div>
                  </div>
                </div>
              </div>
                `;

        })
        $('#usuarios').html(template);
          });
      }
      $(document).on('keyup','#buscar',function(){
          let valor = $(this).val();
          if(valor!=""){
              buscar_datos(valor);
              console.log(valor);
  
          }else{
              buscar_datos();
              console.log(valor);
              
          }
  


      });

      $('#form-crear').submit(e=>{
        let nombre= $('#nombre').val();
        let apellido= $('#apellido').val();
        let edad= $('#edad').val();
        let dni= $('#dni').val();
        let pass= $('#pass').val();
        funcion='crear_usuario';
        $.post('../controlador/UsuarioController.php',{nombre,apellido,edad,dni,pass,funcion},(response)=>{
         if(response=='add'){
          $('#add').hide('slow');
          $('#add').show(1000);
          $('#add').hide(2000);
          $('#form-crear').trigger('reset');
          buscar_datos();

         }else{
          $('#noadd').hide('slow');
          $('#noadd').show(1000);
          $('#noadd').hide(2000);
          $('#form-crear').trigger('reset');

         }
        });
        e.preventDefault();


      });

      $(document).on('click','.borrar-usuario',(e)=>{
        const elemento= $(this)[0].activeElement.parentElement.parentElement.parentElement.parentElement;
        const id=$(elemento).attr('usuarioid');
        //console.log(id);
        funcion='borrar_usuario';
        $('#id_user').val(id);
        $('#funcion').val(funcion);


      });
      $('#form-confirmar').submit(e=>{
        let pass=$('#oldpass').val();
        let id_usuario=$('#id_user').val();
        funcion =$('#funcion').val();
        console.log(pass);
        console.log(id_usuario);
        console.log(funcion);
        $.post('../controlador/UsuarioController.php',{pass,id_usuario,funcion},(response)=>{
          if(response=='borrado'){
            $('#confirmado').hide('slow');
            $('#confirmado').show(1000);
            $('#confirmado').hide(2000);
            $('#form-confirmar').trigger('reset');
            
  
           }else{
            $('#no').hide('slow');
            $('#no').show(1000);
            $('#no').hide(2000);
            $('#form-confirmar').trigger('reset');
  
           }
           buscar_datos();
        });
        e.preventDefault();
        

      });
      
    })