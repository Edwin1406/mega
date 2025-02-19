<h2 class="dashboard__heading"> <?php echo $titulo ?> </h2>

<button class="borrar">
    clear
</button>

<script>


document.querySelector(".borrar").addEventListener("click", () => {
    localStorage.removeItem("pedidosFiltrados");
    alert("Los datos filtrados se han eliminado de Local Storage.");
});

const pedidosFil = localStorage.getItem("pedidosFiltrados");

const pedidos = JSON.parse(pedidosFil);
console.log(pedidos);


// function muestra lista de pedidos en un tabla crear tabla con js
const tabla = document.createElement("table");
tabla.classList.add("table");
document.body.appendChild(tabla);

const thead = document.createElement("thead");
thead.classList.add("table__thead");
tabla.appendChild(thead);

const tr = document.createElement("tr");
thead.appendChild(tr);

const th1 = document.createElement("th");
th1.classList.add("table__th");
th1.textContent = "ID";
tr.appendChild(th1);

const th2 = document.createElement("th");
th2.classList.add("table__th");
th2.textContent = "Nombre Pedido";
tr.appendChild(th2);

const th3 = document.createElement("th");
th3.classList.add("table__th");
th3.textContent = "Cantidad";
tr.appendChild(th3);

const th4 = document.createElement("th");
th4.classList.add("table__th");
th4.textContent = "Largo";
tr.appendChild(th4);

const th5 = document.createElement("th");
th5.classList.add("table__th");
th5.textContent = "Ancho";
tr.appendChild(th5);

const th6 = document.createElement("th");
th6.classList.add("table__th");
th6.textContent = "Alto";
tr.appendChild(th6);

const th7 = document.createElement("th");
th7.classList.add("table__th");
th7.textContent = "Flauta";
tr.appendChild(th7);

const th8 = document.createElement("th");
th8.classList.add("table__th");
th8.textContent = "Test";
tr.appendChild(th8);

const th9 = document.createElement("th");
th9.classList.add("table__th");
th9.textContent = "Fecha Ingreso";
tr.appendChild(th9);

const th10 = document.createElement("th");
th10.classList.add("table__th");
th10.textContent = "Fecha Entrada";
tr.appendChild(th10);

const tbody = document.createElement("tbody");
tbody.classList.add("table__tbody");
tabla.appendChild(tbody);







</script>