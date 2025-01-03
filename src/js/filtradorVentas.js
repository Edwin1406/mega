filtroVentas.addEventListener('input', function () {
    const filtro = this.value.toLowerCase();
    const filas = document.querySelectorAll('#tabla .table__tr');

    filas.forEach(fila => {
        const nombreCliente = fila.cells[0].textContent.toLowerCase();
        const nombreProducto = fila.cells[1].textContent.toLowerCase();
        const codigoProducto = fila.cells[2].textContent.toLowerCase();
        const estado = fila.cells[3].textContent.toLowerCase();

        if (
            nombreCliente.includes(filtro) || 
            nombreProducto.includes(filtro) || 
            codigoProducto.includes(filtro) || 
            estado.includes(filtro)
        ) {
            fila.style.display = '';
        } else {
            fila.style.display = 'none';
        }
    });
});
