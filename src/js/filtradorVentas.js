document.addEventListener('DOMContentLoaded', function () {
    // Objetivo: Filtrar ventas en tiempo real
    (function() {
        // Filtro en tiempo real
        const filtroVentas = document.querySelector('#filtros_ventas');
        if (filtroVentas) {
            filtroVentas.addEventListener('input', function () {
                const filtro = this.value.toLowerCase();
                const filas = document.querySelectorAll('#tabla .table__tr');

                filas.forEach(fila => {
                    const codigo = fila.cells[0].textContent.toLowerCase();
                    const nombre = fila.cells[1].textContent.toLowerCase();

                    console.log(codigo, nombre);

                    if (codigo.includes(filtro) || nombre.includes(filtro)) {
                        fila.style.display = '';
                    } else {
                        fila.style.display = 'none';
                    }
                });
            });
        }

    })();
});
