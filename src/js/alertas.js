(function() {

    const respuesta = document.querySelector('div .alerta');
    if(respuesta) {
        setTimeout(() => {
            respuesta.remove();
        }, 3000);
    }


})();