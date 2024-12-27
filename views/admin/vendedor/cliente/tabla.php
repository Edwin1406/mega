<h2 class="dashboard__heading"> <?php echo $titulo ?> </h2>

<div class="dashboard__contenedor-boton">
    <a class="dashboard__boton" href="/admin/vendedor/cliente/crear">
        <i class="fa-solid fa-circle-arrow-left"></i>
        REGRESAR A INICIO
    </a>
</div>
<button id="customAlertButton">Show Custom Alert</button>

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

<div class="dashboard__contenedor">
    <?php if (!empty($visor)): ?>
        <table class="table" id="tabla">
            <thead class="table__thead">
                <tr>
                    <th scope="col" class="table__th">Nombre Cliente</th>
                    <th scope="col" class="table__th">Nombre Producto</th>
                    <th scope="col" class="table__th">Codigo producto</th>
                    <th scope="col" class="table__th">Estado</th>
                    <th scope="col" class="table__th">Archivo PDF</th>
                    <th scope="col" class="table__th">Acciones</th>
                </tr>
            </thead>
            <tbody class="table__tbody">
                <?php foreach ($visor as $visores):?>
                    <tr class="table__tr">
                        <td class="table__td"><?php echo $visores->nombre_cliente?></td>
                        <td class="table__td"><?php echo $visores->nombre_producto?></td>
                        <td  class="table__td"><?php echo $visores->codigo_producto?></td>
                        <td  data-id="<?php echo $visores->id; ?>" class="table__td" style="color: <?php echo ($visores->estado == 'pendiente') ? 'red' : 'green'; ?>">
                            <?php echo $visores->estado; ?>
                        </td>

                        
                        <td class="table__td">
                            <?php 
                            $rutaArchivo = "/src/visor/" . htmlspecialchars($visores->pdf);
                            $extension = pathinfo($visores->pdf, PATHINFO_EXTENSION);

                            if (in_array(strtolower($extension), ['jpg', 'jpeg', 'png', 'gif'])): ?>
                                <!-- Mostrar miniatura para imágenes -->
                                <img 
                                    src="<?php echo $rutaArchivo ?>" 
                                    alt="pdf" 
                                    class="imagen-miniatura" 
                                    style="width: 100px; height: auto; cursor: pointer;" 
                                    onclick="mostrarImagen(this.src)">
                            <?php elseif (strtolower($extension) === 'pdf'): ?>
                                <!-- Mostrar enlace para visualizar PDF -->
                                <a href="<?php echo $rutaArchivo ?>" target="_blank" class="enlace-pdf">Ver PDF</a>
                                <?php else: ?>
                                    <a href="<?php echo $rutaArchivo ?>" target="_blank" class="enlace-pdf">Ver PDF</a>

                            <?php endif; ?>
                        </td>
                        <td  class="table__td--acciones"><a class="table__accion table__accion--editar" href="/admin/vendedor/cliente/editar?id=<?php echo $visores->id; ?>"><i class="fa-solid fa-user-pen"></i>Editar</a>


                    </tr>
                <?php endforeach;?>
            </tbody>
        </table>
    <?php else: ?>
        <a class="text-center"> No hay visor Aún</a>
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
            mostrarAlerta('CAMBIASTE EL ESTADO  ',`visor${visor} `,'success','#28a745','#d4edda');
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


    document.getElementById('customAlertButton').addEventListener('click', function() {
      Swal.fire({
        title: "Alerta CAmbio de Estado",
        width: 600,
        padding: "6em",
        position: "top-end",
        color: rgba(5, 3, 2, 0.61),
        background:rgb(214, 97, 68), 
        backdrop: `
          rgba(0,0,123,0.4)
          url("/gif.gif")
          left top
          no-repeat
        `
      });
    });



})();








</script>



