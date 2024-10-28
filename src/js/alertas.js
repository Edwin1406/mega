(function() {

    const alertaCotizador = document.querySelector('div .alerta');
    if(alertaCotizador) {
        setTimeout(() => {
            alertaCotizador.remove();
        }, 3000);
    }


})();