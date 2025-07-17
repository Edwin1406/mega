

<h2 class="dashboard__heading"> <?php echo $titulo ?> </h2>


<div class="dashboard__contenedor-boton">
    <a class="dashboard__boton" href="/admin/produccion/papel/consumo_general">
        <i class="fa-regular fa-eye"></i>
        REGISTRAR CONSUMO GENERAL
    </a>
</div>


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
let paginaActual = 1;
const porPagina = 10;

async function cargarApi(pagina = 1) {
    try {
        const url = `${location.origin}/admin/api/apiConsumoGeneral?pagina=${pagina}&limite=${porPagina}`;
        const resultado = await fetch(url);
        const respuesta = await resultado.json();

        paginaActual = pagina;

        if (respuesta.datos && respuesta.datos.length > 0) {
            mostrarTabla(respuesta.datos);
            crearPaginador(respuesta.total, paginaActual);
        } else {
            document.querySelector('.dashboard__formulario').innerHTML = '<p>No hay datos disponibles.</p>';
            document.querySelector('.tabla__contenedor').innerHTML = '';
        }
    } catch (e) {
        console.error('Error al cargar los datos:', e);
    }
}

function mostrarTabla(datos) {
    const contenedor = document.querySelector('.dashboard__formulario');
    contenedor.innerHTML = '';

    const tabla = document.createElement('table');
    tabla.classList.add('tabla');

    const thead = document.createElement('thead');
    thead.innerHTML = `
        <tr>
            <th>ID</th>
            <th>Tipo Máquina</th>
            <th>Total General</th>
            <th>Fecha de Creación</th>
        </tr>
    `;
    tabla.appendChild(thead);

    const tbody = document.createElement('tbody');
    datos.forEach(dato => {
        const fila = document.createElement('tr');
        fila.innerHTML = `
            <td>${dato.id}</td>
            <td>${dato.tipo_maquina}</td>
            <td>${dato.total_general}</td>
            <td>${dato.created_at}</td>
        `;
        tbody.appendChild(fila);
    });

    tabla.appendChild(tbody);
    contenedor.appendChild(tabla);
}

function crearPaginador(totalItems, paginaActual) {
    const totalPaginas = Math.ceil(totalItems / porPagina);
    const paginador = document.createElement('div');
    paginador.classList.add('paginador');

    for (let i = 1; i <= totalPaginas; i++) {
        const boton = document.createElement('button');
        boton.textContent = i;
        if (i === paginaActual) boton.classList.add('active');

        boton.addEventListener('click', () => {
            cargarApi(i);
        });

        paginador.appendChild(boton);
    }

    const contenedor = document.querySelector('.tabla__contenedor');
    contenedor.innerHTML = '';
    contenedor.appendChild(paginador);
}

document.addEventListener('DOMContentLoaded', () => {
    cargarApi();
});
</script>

