$(document).ready(function(){
    let funcion="listar";
    $.post('../controlador/CompraPController',{funcion},(response)=>{
        console.log(JSON.parse(response));
    })
    let datatable=$('#tabla_venta').DataTable( {
        "ajax": {
            "url": "../controlador/CompraPController.php",
            "method": "POST",
            "data":{funcion:funcion}

        },
        "columns": [
            //idcompra,proveedor,fecha,producto,cantidad,precio,laboratorio,presentacion,total
            { "data": "idcompra" },
            { "data": "fecha" },
            { "data": "proveedor" },
            { "data": "producto" },
            { "data": "cantidad" },
            { "data": "precio" },
            { "data": "laboratorio" },
            { "data": "presentacion" },
            { "data": "total" },
            

            
           
        ],
        "language": espanol
    } );
    $('#tabla_venta tbody').on('click','.ver',function(){
        let datos = datatable.row($(this).parents()).data();
        let id= datos.idcompra;
        funcion="ver";
        $('#codigo_venta').html(datos.idcompra);
        $('#fecha').html(datos.fecha);
        $('#cliente').html(datos.cliente);
        $('#producto').html(datos.producto);
    
        $('#total').html(datos.total);
        $.post('../controlador//CompradosController.php',{funcion,id},(response)=>{
            console.log(response);
           let registros = JSON.parse(response);
           let template="";
           $('#registros').html(template);
           registros.forEach(registro => {
               template+=`
               <tr>
                   <td>${registro.cantidad}</td>
                   <td>${registro.precio}</td>
                   <td>${registro.producto}</td>
                   <td>${registro.concentrancion}</td>
                   <td>${registro.adicional}</td>
                   <td>${registro.laboratorio}</td>
                   <td>${registro.presentacion}</td>
                   <td>${registro.tipo}</td>
                   <td>${registro.cliente}</td>

               
               
               </tr>
               
               `;
               $('#registros').html(template);
               
           });

        })


    })

})

let espanol = {
   
    "processing": "Procesando...",
    "lengthMenu": "Mostrar _MENU_ registros",
    "zeroRecords": "No se encontraron resultados",
    "emptyTable": "Ningún dato disponible en esta tabla",
    "info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
    "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
    "infoFiltered": "(filtrado de un total de _MAX_ registros)",
    "search": "Buscar:",
    "infoThousands": ",",
    "loadingRecords": "Cargando...",
    "paginate": {
        "first": "Primero",
        "last": "Último",
        "next": "Siguiente",
        "previous": "Anterior"
    },
    "aria": {
        "sortAscending": ": Activar para ordenar la columna de manera ascendente",
        "sortDescending": ": Activar para ordenar la columna de manera descendente"
    },
    "buttons": {
        "copy": "Copiar",
        "colvis": "Visibilidad"
    }
}