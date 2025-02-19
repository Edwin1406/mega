<h2 class="dashboard__heading"> <?php echo $titulo ?> </h2>

<button class="borrar">
    clear
</button>

<div class="dashboard__contenedor-boton">
    <a class="dashboard__boton" href="/admin/produccion/materia/corrugador/cartonera/dupla">
        <i class="fa-regular fa-eye"></i>
        SIGUIENTE
    </a>
</div>



<div class="dashboard__contenedor">
    <table class="table">
        <thead class="table__thead">
            <tr>
                <th scope="col" class="table__th">ID</th>
                <th scope="col" class="table__th">Material</th>
                <th scope="col" class="table__th">Flauta</th>
                <th scope="col" class="table__th">Papeles</th>
                <th scope="col" class="table__th">%</th>
                <th scope="col" class="table__th">Descripción Papeles</th>
            </tr>
        </thead>
        <tbody class="table__tbody">
            <!-- Las filas se agregarán aquí dinámicamente -->
        </tbody>
    </table>
</div>

<script>
async function consumirAPI() {
    const url = "https://megawebsistem.com/admin/api/apipapel";

    try {
        const response = await fetch(url);
        const data = await response.json();

        console.log("Datos recibidos de la API:", data); // Verificar la estructura de los datos

        const tbody = document.querySelector(".table__tbody");
        tbody.innerHTML = ""; // Limpiar antes de agregar nuevos datos

        // Asegurar que data es un array y tiene al menos un objeto
        if (Array.isArray(data) && data.length > 0) {
            data.forEach((item) => { // Recorrer todos los objetos en el array
                if (item.papeles && Array.isArray(item.papeles)) {
                    item.papeles.forEach((papel, index) => {
                        const row = document.createElement("tr");

                        if (index === 0) {
                            row.innerHTML = `
                                <td rowspan="${item.papeles.length}">${item.id}</td>
                                <td rowspan="${item.papeles.length}">${item.material}</td>
                                <td rowspan="${item.papeles.length}">${item.flauta}</td>
                                <td>${papel.codigo}</td>
                                <td>${papel.peso}</td>
                                <td>${papel.descripcion}</td>
                            `;
                        } else {
                            row.innerHTML = `
                                <td>${papel.codigo}</td>
                                <td>${papel.peso}</td>
                                <td>${papel.descripcion}</td>
                            `;
                        }

                        tbody.appendChild(row);
                    });
                }
            });
        } else {
            console.warn("La API no devolvió datos válidos.");
            tbody.innerHTML = "<tr><td colspan='6'>No hay datos disponibles</td></tr>";
        }
    } catch (error) {
        console.error("Error al obtener los datos:", error);
        document.querySelector(".table__tbody").innerHTML = 
            "<tr><td colspan='6'>Error al cargar los datos</td></tr>";
    }
}

// Llamar a la función para cargar los datos cuando la página se cargue
document.addEventListener("DOMContentLoaded", consumirAPI);

</script>
