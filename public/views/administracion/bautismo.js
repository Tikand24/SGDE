var app = new Vue({
    el: '#app',
    data: {
        message: 'Hello Vue!',
        bautizado: {
            id: '',
            nombre: '',
            libro: '',
            folio: '',
            partida: '',
            padre: '',
            madre: '',
            abueloPaterno: '',
            abuelaPaterna: '',
            abueloMaterno: '',
            abuelaMaterna: '',
            padrino: '',
            madrina: '',
            fechaNacimiento: '',
            ciudadNacimiento: '',
            fechaBautismo: '',
            celebrante: ''
        }
    },
    methods: {
        guardar: function() {
            this.$http.post('/administracion/guardar-bautismo',this.bautizado).then((response) => {
                if (response.body.estado == 'validador') {
                        jQuery.each(response.body.errors, function(i, value) {
                            toastr.warning(value)
                        })
                    } else {
                        if (response.body.estado == 'ok') {
                            if (response.body.tipo == 'update') {
                                toastr.success('Paciente actualizado correctamente');
                            }
                            if (response.body.tipo == 'save') {
                                toastr.success('Paciente creado correctamente');
                            }
                        }
                    }
                console.log('Bien');
                console.log(response.body);
            }, (error) => {
                toastr.error(error.status + ' ' + error.statusText + ' (' + error.url + ')');
                console.log('Mal');
                console.log(error);
            });
        }
    },
    mounted() {
        entorno = this;
        $('#fechaNacimiento').datetimepicker({
            format: 'YYYY-MM-DD',
            maxDate: moment().format("YYYY-MM-DD")
        }).on('dp.change', function(e) {
            entorno.bautizado.fechaNacimiento = $('#fechaNacimiento').val();
        });
        $('#fechaBautismo').datetimepicker({
            format: 'YYYY-MM-DD',
            maxDate: moment().format("YYYY-MM-DD")
        }).on('dp.change', function(e) {
            entorno.bautizado.fechaBautismo = $('#fechaBautismo').val();
        });
        $("#ciudadNacimiento").chosen({
            width: "100%"
        }).change(function() {
            entorno.bautizado.ciudadNacimiento = $('#ciudadNacimiento').val();
        });
        $("#celebrante").chosen({
            width: "100%"
        }).change(function() {
            entorno.bautizado.celebrante = $('#celebrante').val();
        });
    }
})
$(document).ready(function() {
    console.log('Activo');
    /*$('#btnEnviar').click(function() {
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
            error: function(data) {
                console.log(data);
                console.log(data.responseText);
            }
        });
    });*/
});