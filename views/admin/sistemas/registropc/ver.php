<h2 class="dashboard__heading"> <?php echo $titulo ?> </h2>




<style>
  .caracteristicas {
  display: flex;
  flex-wrap: wrap;
  gap: 2rem;
  background-color: #f8f2f2;
  padding: 1rem;
  border-radius: 1rem;
  justify-content: center;
}

.caracteristicas > * {
  flex: 1 1 calc(15% - 1rem); /* 4 columnas con espacio */
  min-width: 20%; /* Para evitar que se achiquen demasiado en pantallas pequeñas */
}

.caracteristicas__item {
  background-color: #24292d;
  color: #f8f2f2;
  padding: 10px 15px;
  transition: all 0.5s;
  margin-bottom: 5rem;
  text-align: center;
  border-radius: 1rem;
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