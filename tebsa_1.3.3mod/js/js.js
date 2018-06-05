function confirdelar(nob){	
    
    var mensaconfir = confirm("¿Desea eliminar?");
    
    
    if (mensaconfir == true){

        $.ajax({
           type:"POST",
           url:"eli.php",
           dataType:"HTML",
           data:{
                x: nob.id
            },
             success:function(datos){
                     $('#condel').html(datos)
             },
          error: function ( jqXHR, textStatus, errorThrown ){
                  alert (errorThrown);
             }

    })

    }
}