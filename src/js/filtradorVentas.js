document.addEventListener('DOMContentLoaded', function () {
    const filtroVentas = document.querySelector('#filtros_ventas');
    if (filtroVentas) {
        filtroVentas.addEventListener('input', function () {
            const filtro = this.value.toLowerCase().trim();
            const filas = document.querySelectorAll('#tabla .table__tr');

            filas.forEach(fila => {
                const nombreCliente = fila.cells[0].textContent.toLowerCase();
                const nombreProducto = fila.cells[1].textContent.toLowerCase();
                const codigoProducto = fila.cells[2].textContent.toLowerCase();
                const estado = fila.cells[3].textContent.toLowerCase();

                console.log({ nombreCliente, nombreProducto, codigoProducto, estado });

                if (
                    nombreCliente.includes(filtro) || 
                    nombreProducto.includes(filtro) || 
                    codigoProducto.includes(filtro) || 
                    estado.includes(filtro)
                ) {
                    fila.style.display = ''; // Mostrar fila
                } else {
                    fila.style.display = 'none'; // Ocultar fila
                }
            });
        });
    }
});
