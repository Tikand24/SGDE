var app = new Vue({
    el: '#app',
    data: {
        cenizario: {
            id: '',
            fallecido: '',
            comprador: '',
            numero: ''
        }
    },
    methods: {
        guardar: function() {
            this.$http.post('/administracion/cenizarios/guardar-cenizario',this.cenizario).then((response) => {
                if (response.body.estado == 'validador') {
                        jQuery.each(response.body.errors, function(i, value) {
                            toastr.warning(value)
                        })
                    } else {
                        if (response.body.estado == 'ok') {
                            if (response.body.tipo == 'update') {
                                toastr.success('Cenizario actualizado correctamente');
                            }
                            if (response.body.tipo == 'save') {
                                toastr.success('Cenizario creado correctamente');
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
    }
});