<h2 class="dashboard__heading"> <?php echo $titulo ?> </h2>




<style>
    .caracteristicas {
        display: flex;
        justify-content: 1fr 1fr;
        flex-wrap: wrap;
        align-items: center;
        gap: 2rem;
        
    }


</style>

<div class="contenedor">
    <div class="caracteristicas">
        <div class="caracteristicas__item">
            <p> ID DEL EQUIPO: </p>
            <p> <?php echo $computadora->numero_interno ?> </p>
        
        </div>
        <div class="caracteristicas__item">
            <p> AREA: </p>
            <p> <?php echo $computadora->area ?> </p>
        </div>
        
        <div class="caracteristicas__item">
            <p> USUARIO ASIGNADO: </p>
            <p> <?php echo $computadora->usuario_asignado ?> </p>
        </div>
        
        <div class="caracteristicas__item">
            <p> FECHA COMPRA: </p>
            <p> <?php echo $computadora->fecha_compra ?> </p>
        </div>
        
        <div class="caracteristicas__item">
            <p> MARCA O MODELO: </p>
            <p> <?php echo $computadora->marca_modelo ?> </p>
        </div>
        
        <div class="caracteristicas__item">
            <p> PROCESADOR: </p>
            <p> <?php echo $computadora->procesador ?> </p>
        </div>
        
        <div class="caracteristicas__item">
            <p> RAM: </p>
            <p> <?php echo $computadora->ram ?> </p>
        </div>
        
        <div class="caracteristicas__item">
            <p> DISCO DURO: </p>
            <p> <?php echo $computadora->disco_duro ?> </p>
        </div>
        
        <div class="caracteristicas__item">
            <p> SISTEMA OPERATIVO: </p>
            <p> <?php echo $computadora->sistema_operativo ?> </p>
        </div>
        
        <div class="caracteristicas__item">
            <p> ESTADO ACTUAL: </p>
            <p> <?php echo $computadora->estado_actual ?> </p>
        </div>
        
        <div class="caracteristicas__item">
            <p> DIRECCION IP: </p>
            <p> <?php echo $computadora->direccion_ip ?> </p>
        </div>
        
        <div class="caracteristicas__item">
            <p> CONTRASEÑA: </p>
            <p> <?php echo $computadora->contrasena ?> </p>
        </div>
        
        <div class="caracteristicas__item">
            <p> FECHA DE REGISTRO: </p>
            <p> <?php echo $computadora->created_at ?> </p>
        </div>






    </div>
</div>