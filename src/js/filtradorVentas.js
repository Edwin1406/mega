// Objetivo: Filtrar ventas en tiempo real
(function() {

    document.addEventListener('DOMContentLoaded', function() {
        // Verificar si el elemento con ID 'filtros_ventas' existe
        const filtroInput = document.querySelector('#filtros_ventas');
        if (filtroInput) {
            // Añadir el evento 'input' solo si el elemento existe
            filtroInput.addEventListener('input', function () {
                const filtro = this.value.toLowerCase();
                const filas = document.querySelectorAll('#tabla .table__tr');
    
                filas.forEach(fila => {
                    const codigo = fila.cells[0].textContent.toLowerCase();
                    const nombre = fila.cells[1].textContent.toLowerCase();
    
                    if (codigo.includes(filtro) || nombre.includes(filtro)) {
                        fila.style.display = '';
                    } else {
                        fila.style.display = 'none';
                    }
                });
            });
        } else {
            console.warn("El elemento con ID 'filtros_ventas' no se encontró en esta página.");
        }
    });
    
})();



