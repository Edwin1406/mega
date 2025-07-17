

<h2 class="dashboard__heading"> <?php echo $titulo ?> </h2>

<div class="dashboard__formulario"></div>
<div class="tabla__contenedor"></div>

<style>


.tabla {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
    font-family: Arial, sans-serif;
}

.tabla th,
.tabla td {
    padding: 12px;
    border: 1px solid #ccc;
    text-align: center;
}

.tabla th {
    background-color: #f4f4f4;
    font-weight: bold;
}

.tabla__contenedor {
    margin-top: 30px;
}

.paginador {
    display: flex;
    justify-content: center;
    margin-top: 20px;
    gap: 8px;
}

.paginador button {
    padding: 8px 12px;
    border: none;
    background-color: #007bff;
    color: white;
    cursor: pointer;
    border-radius: 4px;
}

.paginador button:hover {
    background-color: #0056b3;
}

.paginador button.active {
    background-color: #0056b3;
    font-weight: bold;
}


</style>




<script>
document.addEventListener('DOMContentLoaded', function () {
    cargarApi();
});

let datosGlobales = [];
let paginaActual = 1;
const porPagina = 10;

async function cargarApi() {
    try {
        const url = `${location.origin}/admin/api/apiConsumoGeneral`;
        const resultado = await fetch(url);
        const datos = await resultado.json();

        if (datos.length > 0) {
            datosGlobales = datos;
            mostrarPagina(paginaActual);
            crearPaginador(datos.length);
        } else {
            document.querySelector('.tabla__contenedor').innerHTML = '<p>No hay datos disponibles.</p>';
        }
    } catch (e) {
        console.error(e);
    }
}

function mostrarPagina(pagina) {
    const inicio = (pagina - 1) * porPagina;
    const fin = inicio + porPagina;
    const datosPagina = datosGlobales.slice(inicio, fin);

    const contenedor = document.querySelector('.dashboard__formulario');
    contenedor.innerHTML = ''; // Limpiar contenido anterior
    crearTabla(datosPagina);
}

function crearTabla(datos) {
    const tabla = document.createElement('table');
    tabla.classList.add('tabla');

    const encabezado = document.createElement('thead');
    encabezado.innerHTML = `
        <tr>
            <th>ID</th>
            <th>Tipo Máquina</th>
            <th>Total General</th>
            <th>Fecha de Creación</th>
        </tr>
    `;
    tabla.appendChild(encabezado);

    const cuerpo = document.createElement('tbody');
    datos.forEach(dato => {
        const fila = document.createElement('tr');
        fila.innerHTML = `
            <td>${dato.id}</td>
            <td>${dato.tipo_maquina}</td>
            <td>${dato.total_general}</td>
            <td>${dato.created_at}</td>
        `;
        cuerpo.appendChild(fila);
    });
    tabla.appendChild(cuerpo);

    document.querySelector('.dashboard__formulario').appendChild(tabla);
}

function crearPaginador(totalItems) {
    const totalPaginas = Math.ceil(totalItems / porPagina);
    const paginador = document.createElement('div');
    paginador.classList.add('paginador');

    for (let i = 1; i <= totalPaginas; i++) {
        const boton = document.createElement('button');
        boton.textContent = i;
        if (i === paginaActual) boton.classList.add('active');

        boton.addEventListener('click', () => {
            paginaActual = i;
            mostrarPagina(paginaActual);
            document.querySelectorAll('.paginador button').forEach(b => b.classList.remove('active'));
            boton.classList.add('active');
        });

        paginador.appendChild(boton);
    }

    // Limpiar y agregar al contenedor
    const contenedor = document.querySelector('.tabla__contenedor');
    contenedor.innerHTML = ''; // Limpiar anterior
    contenedor.appendChild(paginador);
}
</script>



