<h2 class="dashboard__heading"> <?php echo $titulo ?> </h2>




<style>
.contenedor {
  display: grid;
  grid-template-columns: 1fr 1fr; /* dos columnas */
  gap: 2rem;
  margin: 2rem auto;
  padding: 2rem;
  background-color: white;
  border-radius: 1rem;
  max-width: 90%; /* más ancho */
  box-shadow: 0 2px 5px rgba(135, 164, 165, 0.2);
}

.caracteristicas {
  display: grid;
  grid-template-columns: 1fr 1fr; /* 2 columnas internas */
  gap: 1.5rem;
}

.caracteristicas__item {
  background: radial-gradient(circle, rgb(196, 166, 138) 0%, rgb(218, 158, 109) 100%);
  color: rgb(2, 2, 2);
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
  font-size: 1.1rem;
  margin-bottom: 0.3rem;
  text-transform: uppercase;
  letter-spacing: 0.5px;
}

.caracteristicas__item p:last-child {
  font-size: 1.2rem;
  margin: 0;
  color: black;
}

.contenido {
  display: flex;
  justify-content: space-between;
  max-width: 90%;
  margin: auto;
  margin-top: 2rem;
}

.designar {
  font-size: 1.5rem;
  font-weight: bold;
}


</style>

<!-- nombre del usuario --> 


<div class="contenido">
    <p class="designar"><b>Usuario Asignado: </b><?php echo $computadora->usuario_asignado ?></p>
    <p class="designar"><b>Area:</b> <?php echo $computadora->area ?></p>
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
    
    <div class="caracteristicas">
        <h1>dsadsad</h1>
        
    </div>



    
</div>



<div class="dashboard__contenedor">
    <?php if (!empty($bobinas)): ?>
        <table class="table">
            <thead class="table__thead">
                <tr>
                    <th scope="col" class="table__th">Tipo de Papel</th>
                    <th scope="col" class="table__th">Gramaje</th>
                    <th scope="col" class="table__th">Ancho</th>
                    <th scope="col" class="table__th">Fecha y Hora </th>
                    <th scope="col" class="table__th"></th>
                </tr>
            </thead>
            <tbody class="table__tbody">

                <?php foreach ($bobinas as $bobina):?>
                    <tr class="table__tr">
                        <td class="table__td"><?php echo $bobina->tipo_papel?></td>
                        <td class="table__td"><?php echo $bobina->gramaje?></td>
                        <td class="table__td"><?php echo $bobina->ancho?></td>
                        <td class="table__td"><?php echo $bobina->created_at?></td>
                        <td class="table__td--acciones"><a class="table__accion table__accion--editar" href="/admin/produccion/papel/editar?id=<?php echo $bobina->id; ?>"><i class="fa-solid fa-user-pen"></i>Editar</a>
                        <form method="POST" action="/admin/produccion/papel/eliminar" class="table__formulario">
                            <input type="hidden" name="id" value="<?php echo $bobina->id; ?>">
                            <button class="table__accion table__accion--eliminar" type="submit">
                                <i class="fa-solid fa-user-slash"></i>
                                    Eliminar
                            </button>
                        </form>
                        </td>


                    </tr>
                <?php endforeach;?>

            </tbody>

        </table>
   


    <?php else: ?>
        <a class="text-center"> No hay Papel Aún</a>
    <?php endif; ?>
</div>


<?php echo $paginacion; ?>

