<h2 class="dashboard__heading"> <?php echo $titulo ?> </h2>

<style>
    .item {
      background-color: #24292d;
      color: #f8f2f2;
      padding: 10px 15px;
      transition: all 0.5s;
      margin-bottom: 5rem;
    }
    
    .container {
      display: flex;
      flex-direction: row;
      justify-content: center;
    }
    
    .item:nth-child(1), .item:nth-child(2), .item:nth-child(3), .item:nth-child(4), .item:nth-child(5) {
      width: 10%;
    }

    .item:hover {
      background-color: #ac5353;
      scale: 1.1;
      text-align: center;
    }

    .item a {
      color: inherit;
      text-decoration: none;
      display: block;
    }
    @media (min-width: 1024px) {
    .item:nth-child(1) {
      width: 20%;
    }
    
    .item:nth-child(2) {
      width: 20%;
    }
    
    .item:nth-child(3) {
      width: 20%;
    }
    
    .item:nth-child(4) {
      width: 20%;
    }
    
    .item:nth-child(5) {
      width: 20%;
    }


    
  }

</style>

<div class="container">
        <div class="item"><a href="/admin/sistemas/index?id=80ad04ffdfb4872f9b4603cdf4932f23"> <i class="fas fa-home"></i> INICIO</a></div>
        <div class="item"><a href="/admin/sistemas/productos/crear"> <i class="fas fa-industry"></i> PRODUCTOS</a></div>
        <div class="item"><a href="/admin/sistemas/solicitudes/tabla"> <i class="fas fa-scroll"></i> TABLA</a></div>
        <div class="item"><a href="/admin/sistemas/movimiento/movimientos">  <i class="fas fa-newspaper"></i> MOVIMIENTOS</a></div>
        <div class="item"><a href="/admin/sistemas/solicitudes/solicitud"><i class="fa-solid fa-arrow-right"></i> SOLICITUD</a></div>
    </div>




<!-- Campo de búsqueda -->
<div class="dashboard__contenedor" 
    style="
        margin-bottom: 15px; 
        padding: 20px; 
        border-radius: 10px; 
        border: 1px solid #ddd; 
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); 
        background-color: #fff; 
        transition: all 0.3s ease-in-out;
    ">
    <input 
        type="text" 
        id="filtros_ventas" 
        class="dashboard__input" 
        placeholder="Filtrar por nombre cliente o nombre producto"
        style="
            margin-bottom: 0; 
            padding: 12px 15px; 
            width: 100%; 
            box-sizing: border-box; 
            border: 1px solid #ccc; 
            border-radius: 8px; 
            outline: none; 
            font-size: 16px; 
            background-color: #f9f9f9; 
            box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.1); 
            transition: all 0.2s ease-in-out;
        "
        onfocus="this.style.boxShadow='0 0 5px rgba(0, 123, 255, 0.5)'; this.style.borderColor='#007bff';"
        onblur="this.style.boxShadow='inset 0 2px 4px rgba(0, 0, 0, 0.1)'; this.style.borderColor='#ccc';"
    >
</div>
<form method="GET" action="/admin/sistemas/solicitudes/tabla">
    <input type="hidden" name="page" value="1">
    <label for="per_page">Registros por página:</label>
    <select name="per_page" id="per_page" onchange="this.form.submit()">
        <option value="10" <?php echo ($_GET['per_page'] ?? '10') == '10' ? 'selected' : ''; ?>>10</option>
        <option value="25" <?php echo ($_GET['per_page'] ?? '') == '25' ? 'selected' : ''; ?>>25</option>
        <option value="50" <?php echo ($_GET['per_page'] ?? '') == '50' ? 'selected' : ''; ?>>50</option>
        <option value="all" <?php echo ($_GET['per_page'] ?? '') == 'all' ? 'selected' : ''; ?>>Todos</option>
        
    </select>
</form>


<style>

li{
    list-style: none;
    padding: 5px;
    margin: 5px;
    border: 1px solid #ccc;
    border-radius: 5px;
    background-color: #f9f9f9;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}


</style>

<div class="dashboard__contenedor">
    <?php if (!empty($visor)): ?>
        <table class="table" id="tabla">
            <thead class="table__thead">
                <tr>
                    <th scope="col" class="table__th">ID</th>
                    <th scope="col" class="table__th">Productos</th>
                    <th scope="col" class="table__th">Acciones</th>
                </tr>
            </thead>
            <tbody class="table__tbody">
                <?php foreach ($visor as $visores): ?>
                    <tr class="table__tr">
                        <td class="table__td"><?php echo $visores->id ?></td>
                        <td class="table__td">
                            <div style="display: flex; flex-wrap: wrap;">
                                <?php 
                                    $productos = json_decode($visores->array, true); // Decodificar el array de productos
                                    foreach ($productos as $producto): ?>
                                        <div style="width: 50%; padding: 5px;">
                                            <ul>
                                                <li>
                                                    <strong>Producto:</strong> <?php echo $producto['producto']; ?><br>
                                                    <strong>Categoría:</strong> <?php echo $producto['categoria']; ?><br>
                                                    <strong>Costo Unitario:</strong> <?php echo $producto['costoUnitario']; ?><br>
                                                    <strong>Cantidad:</strong> <?php echo $producto['cantidad']; ?><br>
                                                    <strong>Total:</strong> <?php echo $producto['total']; ?>
                                                </li>
                                            </ul>
                                        </div>
                                <?php endforeach; ?>
                            </div>
                        </td>
                        <td class="table__td--acciones">
                            <a class="table__accion table__accion--editar" href="/admin/sistemas/solicitudes/pdf?id=<?php echo $visores->id; ?>"><i class="fa-solid fa-user-pen"></i>pdf</a>
                            <a class="table__accion table__accion--eliminar" href="/admin/sistemas/solicitudes/pdfcompraryfinaciero?id=<?php echo $visores->id; ?>"><i class="fa-solid fa-user-slash"></i>Enviar Aprobado</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <a class="text-center">No hay visor Aún</a>
    <?php endif; ?>
</div>



<?php echo $paginacion; ?>



    <script>


(function(){ 

        cargarFunciones ();
        function cargarFunciones(){
            clickVisor();
        }


    function clickVisor(){

        document.addEventListener('dblclick', function(event) {
            const idVisor = event.target.getAttribute('data-id');
            Apivisor(idVisor);
        });

    }

    
    async function Apivisor( idVisor) {
        try {
            const url =`${location.origin}/admin/api/nombreCliente?id=${idVisor}`
            const resultado = await fetch(url);
            const visor = await resultado.json();
            const nuevoEstado = visor.estado === "ENVIADO" ? "PAUSADO" : "TERMINADO";
            visor.estado = nuevoEstado;
            actualizarEstado(visor);
        } catch (error) {
            console.log(error);
        }
    }

    

    async function  actualizarEstado(visor){
        const {id,nombre_cliente,nombre_producto,codigo_producto,estado,pdf} = visor;

        console.log('Datos antes de enviar:', { 
    id, 
    nombre_cliente, 
    nombre_producto, 
    codigo_producto, 
    estado, 
    pdf: visor.pdf 
});


        const data = new FormData();
        data.append('id', id);
        data.append('nombre_cliente', visor.nombre_cliente);
        data.append('nombre_producto', visor.nombre_producto);
        data.append('codigo_producto', visor.codigo_producto);
        data.append('estado', estado);
        data.append('pdf', visor.pdf);

        // for (const [key, value] of data.entries()) {
        //     console.log(`${key}: ${value}`);
        // }

        

        try {

            const url = `${location.origin}/admin/api/actualizar`;
            const respuesta = await fetch(url, {
                method: 'POST',
                body: data
            });
            const resultado = await respuesta.json();
            if(resultado.respuesta.tipo === 'correcto'){
                // actualizar el DOM
                document.querySelector(`[data-id="${id}"]`).textContent = estado; 
                // colores de estado
                document.querySelector(`[data-id="${id}"]`).style.color = estado === 'ENVIADO' ? 'green' : estado === 'PAUSADO' ? 'red' : 'orange';

                

            }
        } catch (error) {
            console.log(error);
            
        }
    }

    function mostrarAlerta(titulo,mensaje,tipo,color,fondo){
        Swal.fire({
            title: titulo,
            text: mensaje,
            icon: "success",
            position: "top-end",
            confirmButtonColor: color,
            background: fondo,

        });  
    }

})();








</script>



