<h2 class="dashboard__heading"> <?php echo $titulo ?> </h2>
<div class="dashboard__contenedor-boton">
    <a class="dashboard__boton" href="/admin/produccion/index" >
        <i class="fa-solid fa-circle-arrow-left"></i>
        Volver
    </a>
</div>

<div class="dashboard__contenedor-boton">
    <a class="dashboard__boton" href="/admin/produccion/materia/excel">
        <i class="fa-solid fa-arrow-right"></i>
        SUBIR EXCEL
    </a>
</div>

<!-- eliminar tabla de base de datos  -->
<form method="POST" action="/admin/produccion/materia/eliminarTabla" class="table__formulario">
    <input type="hidden" name="confirmar" value="1"> <!-- Para validar que la acción fue confirmada -->
    <button class="table__accion table__accion--eliminar" type="submit">
        <i class="fa-solid fa-database"></i> ELIMINAR BASE DE DATOS
    </button>
</form>





<script>
document.addEventListener("DOMContentLoaded", function() {
    document.querySelector('.table__formulario').addEventListener('submit', function(event) {
        event.preventDefault(); // Evita el envío inmediato del formulario
        
        Swal.fire({
            title: "¿Estás seguro?",
            text: "Esta acción eliminará la base de datos y no se podrá recuperar.",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#d33",
            cancelButtonColor: "#3085d6",
            confirmButtonText: "Sí, eliminar",
            cancelButtonText: "Cancelar"
        }).then((result) => {
            if (result.isConfirmed) {
                this.submit(); // Envía el formulario si el usuario confirma
            }
        });
    });
});
</script>










<?php if(count($escoge_registro)===0) {?>
    <p class="no-areas">NO HAY AREAS ASIGNADAS </p>

<?php  }else {?>
   <ul class="lista-areas-produccion">
    <?php foreach($escoge_registro as $produccionA) { ?>
        <li class="areas-produccion">
            <a href="<?php 
                $area = trim($produccionA->area_registro);
                $url = ''; // Inicializa la variable para la URL específica
                $id = $produccionA->url; // Obtiene el ID del área

                // Asigna una URL específica basada en el área
                if($area === 'maquinas'|| $area === 'MAQUINAS') {
                    $url = "/admin/produccion/maquinas/crear?id=".$id;
                } elseif($area === 'papel'|| $area === 'PAPEL') {
                    $url = "/admin/produccion/papel/crear?id=".$id;
                }elseif($area === 'proveedor'|| $area === 'PROVEEDOR') {
                    $url = "/admin/produccion/subirexcel/crear?id=".$id;
                }elseif($area === 'materia prima'|| $area === 'MATERIA PRIMA') {
                    $url = "/admin/produccion/materia/crear?id=".$id;
                }elseif($area === 'pedidos proyectos'|| $area === 'PEDIDOS PROYECTOS') {
                    $url = "/admin/produccion/estadistica/crear?id=".$id;
                } elseif($area === 'planifico'|| $area === 'PLANIFICO'){
                    $url = "/admin/produccion/planifico/index?id=".$id;
                } elseif($area === 'cotizador'|| $area === 'COTIZADOR'){
                    $url = "/admin/produccion/estimar/index?id=".$id;
                }

                echo $url;
            ?>">
                <?php 
                    // Asigna un ícono basado en el área
                    $icono = '';
                    if($area === 'maquinas'|| $area === 'MAQUINAS') {
                        $icono = '<i class="fas fa-industry"></i>'; // ícono de producción
                    } elseif($area === 'papel'|| $area === 'PAPEL') {
                        $icono = '<i class="fa-solid fa-scroll"></i>'; // ícono de cotizació  
                    } elseif($area === 'proveedor'|| $area === 'PROVEEDOR') {
                        $icono = '<i class="fa-solid fa-users"></i>'; // ícono de cotización
                    } elseif($area === 'producto'|| $area === 'MATERIA PRIMA') {
                        $icono = '<i class="fa-solid fa-box"></i>'; // ícono de cotización
                    } elseif($area === 'pedidos proyectos'|| $area === 'PEDIDOS PROYECTOS') {
                        $icono = '<i class="fa-solid fa-file"></i>'; // Ícono de documento
                    } elseif($area === 'planifico'|| $area === 'PLANIFICO') {
                        $icono = '<i class="fa-solid fa-calendar"></i>'; // Ícono de documento
                    } elseif($area === 'cotizador'|| $area === 'COTIZADOR') {
                        $icono = '<i class="fa-solid fa-calculator"></i>'; // Ícono de documento
                    }
                    // Muestra el ícono y el nombre del área
                    echo $icono . ' ' . $area;
                ?>
            </a>
        </li>
    <?php } ?>
</ul>



<?php  }?>









