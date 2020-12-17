$(document).ready(function(){
    const subtotales=0;
   calcularTotal();
    $(document).on('click','#agregar',(e)=>{
        //const elemento= $(this)[0].activeElement.parentElement.parentElement.parentElement.parentElement;
        let nombre = $('#nombre').val();
        let producto= $('#producto').val();
        let  cantidad=$('#cantidad').val();
        let  precio=$('#precio').val();
        let  laboratorio=$('#laboratorio').val();
        
        let  presentacion=$('#presentacion').val();
        let total= cantidad*precio;
       
        funcion='Crear';
        //productop
        
        console.log( nombre +' '+producto+' '+cantidad+' '+precio+' '+laboratorio+' '+presentacion+' '+total);
        $.post('../controlador/CompraProController.php',{funcion,nombre,producto,cantidad,precio,laboratorio,presentacion,total},(response)=>{
            console.log(response);
            let template_co='';
               let json= JSON.parse(response);
               
               template_co=`
               <tr >
               <td>${json.nombre}</td>
               <td>${json.producto}</td>
               <td>${json.cantidad}</td>
               <td>${json.precio}</td>
               <td>${json.laboratorio}</td>
               <td>${json.presentacion}</td>
               <td>${json.total}</td>
               <td><button class="borrar-producto btn btn-danger"><i class="fas fa-times-circle"></i></button></td>
  
          </tr>
          `;
          $('#lista-comprapro').append(template_co);
        });  
          e.preventDefault();
        //Contar_producto()
  
    })
    
    
    $('#cc').keyup((e)=>{
        let id,cantidad,productos,montos,precio;
        producto= $(this)[0].activeElement.parentElement.parentElement;
        id= $(producto).attr('prodId');
        precio= $(producto).attr('prodPrecio');
        cantidad= producto.querySelector('input').value;
        montos= document.querySelectorAll('.subtotales');
        
        productos.forEach(function(prod,indice) {
            if(prod.id === id){
                prod.cantidad = cantidad;
                prod.precio = precio;
                montos[indice].innerHTML=`<h5>${cantidad*productos[indice].precio}</h5>`;

            }
            
        });
        
        calcularTotal();

    })
    function calcularTotal() {
        let productos,total_sin_descuento,pago,vuelto,descuento,precio,cantidad;
        let total=0;
       

        precio=$('#precio').val();
       cantidad=$('#cantidad').val();
            let subtotal_producto = Number(precio * cantidad);
            total = total +subtotal_producto;
            
        
        pago=$('#pago').val();
        descuento=$('#descuento').val();
        //console.log(total);
        total_sin_descuento=parseFloat(total).toFixed(2);
        total=total-descuento;
        vuelto=pago-total;

      
        $('#total_sin_descuento').html(total_sin_descuento);
        $('#total').html(total.toFixed(2));
        $('#vuelto').html(vuelto.toFixed(2));



        
    }
});