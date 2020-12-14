$(document).ready(function(){
    buscar_producto();
    function buscar_producto(consulta) {
        funcion="buscar";
        $.post('../controlador/ProductoController.php',{consulta,funcion},(response)=>{
            const productos = JSON.parse(response);
            let template='';
            productos.forEach(producto =>{
                template=`
                <div proId="${producto.id}" proNombre="${producto.nombre} producto="${$producto.precio}" producto="${$producto.concentracion}" producto="${$producto.adicional}"></div>
                <div class= card bg-light>
                    <div class="card-header text-muted border-bottom-0 ">
                       <i class="fas fa-lg fa-cubes mr-1"></i>${producto.stock}
                    </div>   
                    <div class="card-body pt-0">
                        <div class="row">
                           <div class="col-7">
                             <h2 class="lead"><b>${producto.nombre}</b></h2>
                             <h4 class="lead"><b><i class="fas fa-lg fa-dollar-sign mr-1"></i>${producto.precio}</b></h4>

                             <ul class="ml-4 mb-0 fa-ul text-mutes">
                                <li class="small"><span class="fa-li"><i class="fas fa-lg fa-mortar-pestle"></i></span> Concentracion: ${producto.concentracion}</li>
                                <li class="small"><span class="fa-li"><i class="fas fa-lg fa-mortar-pestle"></i></span> Concentracion: ${producto.concentracion}</li>
                                <li class="small"><span class="fa-li"><i class="fas fa-lg fa-mortar-pestle"></i></span> Concentracion: ${producto.concentracion}</li>
                                <li class="small"><span class="fa-li"><i class="fas fa-lg fa-mortar-pestle"></i></span> Concentracion: ${producto.concentracion}</li>
                             </ul>
                `
            })

        });
        
    }


})