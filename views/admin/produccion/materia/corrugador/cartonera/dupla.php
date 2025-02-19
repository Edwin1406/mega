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

        console.log("Datos recibidos de la API:", data); // Verificar la respuesta

        const tbody = document.querySelector(".table__tbody");
        tbody.innerHTML = ""; // Limpiar antes de agregar nuevos datos

        // Si "papeles" existe y es un array
        if (data.papeles && Array.isArray(data.papeles)) {
            data.papeles.forEach(papel => {
                const row = document.createElement("tr");

                row.innerHTML = `
                    <td>${data.material || "N/A"}</td>
                    <td>${data.flauta || "N/A"}</td>
                    <td>${papel.codigo || "N/A"}</td>
                    <td>${papel.peso || "N/A"}</td>
                    <td>${papel.descripcion || "N/A"}</td>
                `;

                tbody.appendChild(row);
            });
        } else {
            console.warn("No se encontraron datos en 'papeles'.");
            tbody.innerHTML = "<tr><td colspan='5'>No hay datos disponibles</td></tr>";
        }
    } catch (error) {
        console.error("Error al obtener los datos:", error);
        document.querySelector(".table__tbody").innerHTML = 
            "<tr><td colspan='5'>Error al cargar los datos</td></tr>";
    }
}

// Llamar a la función para cargar los datos cuando la página se cargue
document.addEventListener("DOMContentLoaded", consumirAPI);





</script>
