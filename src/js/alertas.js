(function() {

    document.addEventListener('DOMContentLoaded', function() {
        const respuesta = document.querySelector('aside .dashboard__sidebar');
        if (respuesta) {
            respuesta.remove();
        } else {
            console.log('Elemento no encontrado');
        }
    });
    
})();