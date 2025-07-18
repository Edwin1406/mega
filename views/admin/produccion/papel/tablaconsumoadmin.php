

<h2 class="dashboard__heading"> <?php echo $titulo ?> </h2>




<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>





<style>


.tabla {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
    font-family: Arial, sans-serif;
}

.swal-wide {
    width: 800px !important;
    font-size: 2rem;
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
    flex-wrap: wrap;
}

.paginador button {
    padding: 8px 12px;
    border: none;
    background-color: #007bff;
    color: white;
    cursor: pointer;
    border-radius: 4px;
    transition: background-color 0.2s;
}

.paginador button:hover {
    background-color: #0056b3;
}

.paginador button.active {
    background-color: #0056b3;
    font-weight: bold;
}

/* editar boton  */
button.btn-editar {
    padding: 8px 12px;
    border: none;
    background-color: #28a745;
    color: white;
    cursor: pointer;
    border-radius: 4px;
    transition: background-color 0.2s;
}

button.btn-editar:hover {
    background-color: #218838;
}

/* eliminar boton  */
button.btn-eliminar {
    border: none;
    background-color: #dc3545;
    color: white;
    cursor: pointer;
    border-radius: 4px;
    transition: background-color 0.2s;
}

button.btn-eliminar:hover {
    background-color: #c82333;
}

.dashboard__sidebar {
            /* Suponiendo que el contenedor tiene la clase .barra-lateral */
            display: none;
        }






</style>
<div class="dashboard__formulario"></div>
<div class="tabla__contenedor"></div>





<script>
let paginaActual = 1;
const porPagina = 10;

async function cargarApi(pagina = 1) {
    try {
        const url = `${location.origin}/admin/api/apiConsumoTablaPaginador?pagina=${pagina}&limite=${porPagina}`;
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
            <th>Acciones</th>
        </tr>
    `;
    tabla.appendChild(thead);

    const tbody = document.createElement('tbody');
    datos.forEach(dato => {
        const fila = document.createElement('tr');

        const deshabilitar = dato.accion === 0 ? 'disabled' : '';

        fila.innerHTML = `
            <td>${dato.id}</td>
            <td>${dato.tipo_maquina}</td>
            <td>${dato.total_general}</td>
            <td>${dato.created_at}</td>         
            <td>
                <button class="btn-editar" data-id="${dato.id}">Editar</button>
                <button class="btn-eliminar" data-id="${dato.id}" ${deshabilitar}>Eliminar</button>
            </td>
        `;
        tbody.appendChild(fila);
    });

    tabla.appendChild(tbody);
    contenedor.appendChild(tabla);
}

// Botón editar
document.addEventListener('click', function(e) {
    if (e.target.classList.contains('btn-editar') && !e.target.disabled) {
        const id = e.target.getAttribute('data-id');
        window.location.href = `/admin/produccion/papel/editarconsmoadmin?id=${id}`;
    }
});

// Botón eliminar
// botón eliminar con POST
document.addEventListener('click', function(e) {
    if (e.target.classList.contains('btn-eliminar') && !e.target.disabled) {
        const id = e.target.getAttribute('data-id');
        if (confirm('¿Estás seguro de que deseas eliminar este registro?')) {
            fetch('/admin/produccion/papel/eliminar_consumo', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: `id=${encodeURIComponent(id)}`
            })
            .then(response => {
                if (response.ok) {
                    Swal.fire({
                        title: 'Éxito',
                        text: 'Registro eliminado correctamente.',
                        icon: 'success',
                        confirmButtonText: 'Aceptar'
                    });
                    cargarApi(paginaActual); // recarga la tabla
                } else {
                    alert('Error al eliminar el registro.');
                }
            })
            .catch(error => {
                console.error('Error en la solicitud:', error);
                alert('Ocurrió un error inesperado.');
            });
        }
    }
});


function crearPaginador(totalItems, paginaActual) {
    const totalPaginas = Math.ceil(totalItems / porPagina);
    if (totalPaginas <= 1) return;

    const paginador = document.createElement('div');
    paginador.classList.add('paginador');

    // Botón anterior
    if (paginaActual > 1) {
        const btnAnterior = document.createElement('button');
        btnAnterior.textContent = 'Anterior';
        btnAnterior.addEventListener('click', () => cargarApi(paginaActual - 1));
        paginador.appendChild(btnAnterior);
    }

    // Botones de páginas
    for (let i = 1; i <= totalPaginas; i++) {
        const boton = document.createElement('button');
        boton.textContent = i;
        if (i === paginaActual) boton.classList.add('active');
        boton.addEventListener('click', () => cargarApi(i));
        paginador.appendChild(boton);
    }

    // Botón siguiente
    if (paginaActual < totalPaginas) {
        const btnSiguiente = document.createElement('button');
        btnSiguiente.textContent = 'Siguiente';
        btnSiguiente.addEventListener('click', () => cargarApi(paginaActual + 1));
        paginador.appendChild(btnSiguiente);
    }

    const contenedor = document.querySelector('.tabla__contenedor');
    contenedor.innerHTML = '';
    contenedor.appendChild(paginador);
}

document.addEventListener('DOMContentLoaded', () => {
    cargarApi();
});
</script>
