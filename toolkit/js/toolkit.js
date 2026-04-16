var url_ajax = " /wp-admin/admin-ajax.php"; 

function tk_del_to_cart(idp) {
    $.ajax({
        'type': "POST",
        'dataType': 'html',
        'url': url_ajax,
        'data': { 'action': "tk_del_to_cart", 'idp': idp },
        'success': function (data) { 
            $("#ajax_global").html(data); 
        }
    });
}

function tk_add_to_cart(idp, direct, route_s3) {   
    //if($(".formatos_descarga").prop('checked') == true){ 
        if( (idp!="")&&(idp>0) ){
            console.log("idp", idp); 
            console.log("direct", direct); 
            console.log("tk_add_to_cart");   
            console.log(route_s3);
            if (direct == "1") {
                //alert("hey wait!!!");
                $("#ajax_global").html("<h1>DESCARGANDO...</h1>"); 
                $("#btn_dwn__single_"+idp+"").html("Descargando..."); 
                $(".btn-agregar").addClass("activo");
            }
            $.ajax({
                'type': "POST",
                'dataType': 'html',
                'url': url_ajax,
                'data': { 'action': "tk_add_to_cart", 'idp': idp, 'direct': direct, 'route_s3': route_s3 },
                'success': function (data) { 
                    $("#ajax_global").html(data); 
                }
            });
            /*
            $.post( "/apps/toolkit/sitio/wp-admin/admin-ajax.php", { action: "tk_add_to_cart", idp: idp }, function( data ) {
                $("#ajax_global").html( data );
            });
            */   
        }
    //} else {
        // alert("Debes selecciona un Idioma y Formato a descargar");
    // }
}

function tk_descarga() { 
    if ($("#acepto").is(':checked')) {
        $("#ajax_global").html("<h1>Descargando...</h1>");  
        $("#btn-descarga").html("Descargando..."); 
        $.ajax({
            'type': "POST",
            'dataType': 'html',
            'url': url_ajax,
            'data': { 'action': "tk_descarga" },
            'success': function (data) { 
                $("#ajax_global").html(data); 
                $("#btn-descarga").html("DESCARGAR"); 
            }
        });
    } else {
        $("#ajax_descarga").html("<ul><li>Debes aceptar los términos y condiciones de uso para continuar</li></ul>");  
    }
}

function oculta_btn(id) {
    //$("#"+id+"").hide();
}

$('.filtros select').on('change', function () {  
    var select_temas = $('#select_temas').val();
    var select_categorias = $('#select_categorias').val();
    var select_idiomas = $('#select_idiomas').val();
    window.location.href = "http://"+window.location.host+"/resultados/?tema="+select_temas+"&categoria="+select_categorias+"&idioma="+select_idiomas+""; 
});

$("#tk_form_actualizar_permisos").submit(function(e) {
    e.preventDefault();
    var formu = $(this);
    var acepto = $("#tk_form_actualizar_permisos #acepto").is(':checked');
    var correo = $("#tk_form_actualizar_permisos #correo").is(':checked');
    formu.find('.ajax_results').html('');

    if ( acepto && correo ) {
        var id_form = formu.attr("id");
        var formData  = new FormData(document.getElementById(id_form));
        formu.find('.btn-enviar-modal').hide();

        $.ajax({
            type: 'POST',
            url: url_ajax,
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: function(data) {
                if( data.ok ) {
                    $("#modal_actualizar_permisos").css("display", "none");
                } else {
                    formu.find('.ajax_results').html('Debe aceptar ambas condiciones');
                }
            }
        });
    } else {
        formu.find('.ajax_results').html('Debe aceptar ambas condiciones');
    }
}); 