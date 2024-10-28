(function() {

    const alertaCotizador = document.querySelector('div .alerta');
    if(respuesta) {
        setTimeout(() => {
            alertaCotizador.remove();
        }, 3000);
    }


})();