$(document).ready(function(){
    let funcion="listar";
    $.post('../controlador/VentaController.php',{funcion},(response)=>{
        console.log(JSON.parse(response));
    })
    let datatable=$('#tabla_venta').DataTable( {
        "ajax": {
            "url": "../controlador/VentaController.php",
            "method": "POST",
            "data":{funcion:funcion}

        },
        "columns": [
            //idventa,fecha,cliente,dni,total
            { "data": "idventa" },
            { "data": "fecha" },
            { "data": "cliente" },
            { "data": "dni" },
            { "data": "total" },
            { "data": "vendedor" },
            {"defaultContent": `<button class="ver btn btn-success" type="button" data-toggle="modal" data-target="#vista_venta"><i class="fas fa-search"></i></button>`}
        ],
        "language": espanol
    } );
    $('#tabla_venta tbody').on('click','.ver',function(){
        let datos = datatable.row($(this).parents()).data();
        let id= datos.idventa;
        funcion="ver";
        $('#codigo_venta').html(datos.idventa);
        $('#fecha').html(datos.fecha);
        $('#cliente').html(datos.cliente);
        $('#dni').html(datos.dni);
        $('#vendedor').html(datos.vendedor);
        $('#total').html(datos.total);
        $.post('../controlador//VentaProductoController.php',{funcion,id},(response)=>{
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
                   <td>${registro.subtotal}</td>

               
               
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