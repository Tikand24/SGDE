var app = new Vue({
    el: '#app',
    data: {
        tipoEdicion: '',
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
            celebrante: '',
            anotacion: '',
            anotaciones: {}
        }
    },
    methods: {
        guardar: function() {
            if (this.tipoEdicion == 'true') {
                this.$http.post('/administracion/bautismos/actualizar-bautismo-decreto', this.bautizado).then((response) => {
                    if (response.body.estado == 'validador') {
                        jQuery.each(response.body.errors, function(i, value) {
                            toastr.warning(value)
                        })
                    } else {
                        if (response.body.estado == 'ok') {
                            if (response.body.tipo == 'update') {
                                toastr.options.onHidden = function() {
                                    location.href = "/administracion/bautismos";
                                }
                                toastr.success('Bautizado actualizado por decreto correctamente');
                            }
                            if (response.body.tipo == 'save') {
                                toastr.options.onHidden = function() {
                                    location.href = "/administracion/bautismos";
                                }
                                toastr.success('Bautizado creado correctamente');
                            }
                        }
                    }
                }, (error) => {
                    toastr.error(error.status + ' ' + error.statusText + ' (' + error.url + ')');
                });
            } else {
                this.$http.post('/administracion/bautismos/actualizar-bautismo-sistema', this.bautizado).then((response) => {
                    if (response.body.estado == 'validador') {
                        jQuery.each(response.body.errors, function(i, value) {
                            toastr.warning(value)
                        })
                    } else {
                        if (response.body.estado == 'ok') {
                            if (response.body.tipo == 'update') {
                                toastr.options.onHidden = function() {
                                    location.href = "/administracion/bautismos";
                                }
                                toastr.success('Bautizado actualizado por sistema correctamente');

                            }
                            if (response.body.tipo == 'save') {
                                toastr.options.onHidden = function() {
                                    location.href = "/administracion/bautismos";
                                }
                                toastr.success('Bautizado creado correctamente');
                            }
                        }
                    }
                }, (error) => {
                    console.log(error);
                    toastr.error(error.status + ' ' + error.statusText + ' (' + error.url + ')');
                });
            }
        },
        getBautizado: function() {
            this.$http.post('/administracion/bautismos/buscar-bautizado', {
                id: $('#data').val()
            }).then((response) => {
                this.bautizado = {
                    id: response.body.bautizado.id,
                    nombre: response.body.bautizado.nombre,
                    libro: response.body.bautizado.libro,
                    folio: response.body.bautizado.folio,
                    partida: response.body.bautizado.partida,
                    padre: response.body.bautizado.nom_padre,
                    madre: response.body.bautizado.nom_madre,
                    abueloPaterno: response.body.bautizado.abuelo_paterno,
                    abuelaPaterna: response.body.bautizado.abuela_paterna,
                    abueloMaterno: response.body.bautizado.abuelo_materno,
                    abuelaMaterna: response.body.bautizado.abuela_materna,
                    padrino: response.body.bautizado.nom_padrino,
                    madrina: response.body.bautizado.nom_madrina,
                    fechaNacimiento: response.body.bautizado.fecha_nacimiento,
                    ciudadNacimiento: response.body.bautizado.cod_ciudad_nac_baut,
                    fechaBautismo: response.body.bautizado.fecha_bautismo,
                    celebrante: response.body.bautizado.cod_celebrante,
                    anotaciones: response.body.anotaciones
                };

                $('#celebrante').val(response.body.bautizado.cod_celebrante).prop('selected', true);
                $('#ciudadNacimiento').val(response.body.bautizado.cod_ciudad_nac_baut).prop('selected', true);
                $("#ciudadNacimiento").trigger("chosen:updated");
                $("#celebrante").trigger("chosen:updated");
            }, (error) => {
                toastr.error(error.status + ' ' + error.statusText + ' (' + error.url + ')');
            });
        }
    },
    mounted() {
        entorno = this;
        entorno.getBautizado();
        entorno.tipoEdicion = $('#tipoEdicion').val();
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