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
            if (this.nombre.length == 0) {
                toastr.warning('El nombre del bautisado es requerido');
                return
            }
            if (this.padrino.length == 0 && this.madrina.length == 0) {
                toastr.warning('Digite el nombre del padrino o madrina');
                return
            }
            if (this.fechaNacimiento.length == 0 ) {
                toastr.warning('Seleccione la fecha de nacimiento');
                return
            }
            if (this.fechaBautismo.length == 0 ) {
                toastr.warning('Seleccione la fecha de bautizo');
                return
            }
            this.$http.post('/administracion/bautismos/guardar-bautismo', this.bautizado).then((response) => {
                if (response.body.estado == 'validador') {
                    jQuery.each(response.body.errors, function(i, value) {
                        toastr.warning(value)
                    })
                } else {
                    if (response.body.estado == 'ok') {
                        if (response.body.tipo == 'update') {
                            toastr.success('Bautizado actualizado correctamente');
                        }
                        if (response.body.tipo == 'save') {
                            toastr.success('Bautizado creado correctamente');
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
});