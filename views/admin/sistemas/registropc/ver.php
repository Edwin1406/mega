<h2 class="dashboard__heading"> <?php echo $titulo ?> </h2>




<style>
.caracteristicas {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(30%, 1fr));
  gap: 1.5rem;
  background-color:rgb(255, 255, 255);
  padding: 2rem;
  border-radius: 1rem;
  max-width: 100%;
  margin: auto;
}

.caracteristicas__item {
    background: radial-gradient(circle, rgb(196, 166, 138) 0%, rgb(218, 158, 109) 100%);
  color:rgb(2, 2, 2);
  padding: 1.5rem;
  border-radius: 1rem;
  text-align: center;
  transition: transform 0.3s ease, box-shadow 0.3s ease;
  box-shadow: 0 2px 5px rgba(135, 164, 165, 0.2);
}

.caracteristicas__item:hover {
  transform: translateY(-5px);
  box-shadow: 0 5px 15px rgba(114, 156, 149, 0.3);
}

.caracteristicas__item p:first-child {
  font-weight: bold;
  font-size: 1.2rem;
  margin-bottom: 0.5rem;
  text-transform: uppercase;
  letter-spacing: 0.5px;
}

.caracteristicas__item p:last-child {
  font-size: 1.5rem;
  margin: 0;
  color:rgb(0, 0, 0);
}



</style>

<!-- nombre del usuario --> 


<div class="contenido">
    <p>Usuario :<?php echo $computadora->usuario_asignado ?></p>
    <p>Area:<?php echo $computadora->area ?></p>
</div>

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