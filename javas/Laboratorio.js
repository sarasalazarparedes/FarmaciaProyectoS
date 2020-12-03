$(document).ready(function(){
    buscar_lab();
    var funcion;
    $('#form-crear-laboratorio').submit(e=>{
        let nombre_laboratorio=$('#nombre-laboratorio').val();
        funcion='crear';
        $.post('../controlador/LaboratorioController.php',{nombre_laboratorio,funcion},(response)=>{
             console.log (response);
            if(response=='add-laboratorio'){
                console.log (response);
                $('#add-laboratorio').hide('slow');
                $('#add-laboratorio').show(1000);
                $('#add-laboratorio').hide(2000);
                $('#form-crear-laboratorio').trigger('reset');
            }
            else{
                $('#noadd-laboratorio').hide('slow');
                $('#noadd-laboratorio').show(1000);
                $('#noadd-laboratorio').hide(2000);
                $('#form-crear-laboratorio').trigger('reset');
            }
        });
        e.preventDefault();
    });
    function buscar_lab(consulta){
        funcion='buscar';
        $.post('../controlador/LaboratorioController.php',{consulta,funcion},(response)=>{
            const laboratorios=JSON.parse(response);
            let template='';
            laboratorios.forEach(laboratorio => {
                template+=`
                <tr>
                    <td>${laboratorio.nombre} </td>
                    <td>
                        <img src="${laboratorio.avatar}" class="img-fluid rounded" witd="70" heigth="70">
                    </td>
                   
                
                </tr>
                `;
            });
            $('#laboratorios').html(template);
        })
    }
    $(document).on('keyup','#buscar-laboratorio',function(){
        let valor =$(this).val();
        if(valor!=''){
            buscar_lab(valor);
        }
        else{
            buscar_lab();
        }
    })
});