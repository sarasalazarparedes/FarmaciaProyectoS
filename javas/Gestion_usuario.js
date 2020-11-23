$(document).ready(function(){
    buscar_datos();
    var funcion;
     function buscar_datos(consulta) {
        funcion='buscar_usuarios_adm';
        $.post('../controlador/UsuarioController.php',{consulta,funcion},(response)=>{
          const usuarios = JSON.parse(response);
          let template ='';
          usuarios.forEach(us=>{
              template+=`
              <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch">
              <div class="card bg-light">
                <div class="card-header text-muted border-bottom-0">
                 ${us.tipo}
                </div>
                <div class="card-body pt-0">
                  <div class="row">
                    <div class="col-7">
                      <h2 class="lead"><b>${us.nombre} ${usuario.apellido}</b></h2>
                      <p class="text-muted text-sm"><b>Sobre mi: </b>${usuario.adicionalu} </p>
                      <ul class="ml-4 mb-0 fa-ul text-muted">
                        
                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-id_card"></i></span> Cedula:${usuario.cedula}</li>
                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-birthday-cake"></i></span> Cedula:${usuario.edad}</li>
                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-building"></i></span> Residencia:${usuario.residenciau}</li>
                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-phone"></i></span> Telefono #: ${usuario.telefono}</li>
                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-at"></i></span> Correo: ${usuario.correou}</li>
                        
                        

                      </ul>
                    </div>
                    <div class="col-5 text-center">
                      <img src="${us.avatar}" alt="" class="img-circle img-fluid">
                    </div>
                  </div>
                </div>
                <div class="card-footer">
                  <div class="text-right">
                     <button class="btn btn-danger">
                         <i class="fas fa-window-close mr-1"></i>Eliminar

                     </button>
                
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
       
    
})