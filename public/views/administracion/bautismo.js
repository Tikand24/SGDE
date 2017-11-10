$(document).ready(function() {
    console.log('Activo');
    $('#btnEnviar').click(function() {
        $.ajax({
            url: 'http://127.0.0.1:8000/administracion/guardar-bautismo',
            type: 'post',
            data: {
                nombre: $('#nombreBautisado').val(),
                libro: $('#libro').val(),
                folio: $('#folio').val(),
                partida: $('#partida').val(),
                nom_padre: $('#nombrePadre').val(),
                nom_madre: $('#nombreMadre').val(),
                abuelo_paterno: $('#nombreAbueloPaterno').val(),
                abuela_paterna: $('#nombreAbuelaPaterna').val(),
                abuelo_materno: $('#nombreAbueloMaterno').val(),
                abuela_materna: $('#nombreAbuelaMaterna').val(),
                nom_padrino: $('#nombrePadrino').val(),
                nom_madrina: $('#nombreMadrina').val(),
                fecha_nacimiento: $('#fechaNacimiento').val(),
                cod_ciudad_nac_baut: $('#ciudadNacimiento').val(),
                fecha_bautismo: $('#fechaBautismo').val(),
                cod_celebrante: $('#celebrante').val()
            },
            success: function(data) {
                console.log(data);
            },
            error:function(data){
            	console.log(data);
            	console.log(data.responseText);
            }
        });
    });
});