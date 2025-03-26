<h2 class="dashboard__heading"> <?php echo $titulo ?> </h2>




<style>
/* .caracteristicas {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(30%, 2fr));
  gap: 1.5rem;
  background-color:rgb(255, 255, 255);
  padding: 2rem;
  border-radius: 1rem;
  max-width: 50%;
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

.contenido{
    display: flex;
    justify-content: space-between;
   
}

.designar{
    font-size: 2.5rem;
    color:rgb(0, 0, 0);
    font-weight: bold;
} */



.contenedor {
  display: flex;
  justify-content: center;
  align-items: flex-start;
  gap: 2rem;
  padding: 2rem;
}

.caracteristicas {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
  gap: 1.5rem;
  background-color: rgb(255, 255, 255);
  padding: 2rem;
  border-radius: 1rem;
  flex: 1;
}

.formulario {
  background-color: #fff;
  padding: 2rem;
  border-radius: 1rem;
  box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
  text-align: center;
  min-width: 200px;
  height: fit-content;
}

.formulario__submit {
  background-color: #2c63ff;
  color: white;
  padding: 1rem 2rem;
  font-size: 1rem;
  border: none;
  border-radius: 1rem;
  cursor: pointer;
  transition: background-color 0.3s ease;
}

.formulario__submit:hover {
  background-color: #1f4fd3;
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
 

    
</div>
<div class="contenedor">
    <div class="caracteristicas">
        <!-- ... todos los .caracteristicas__item ... -->
    </div>

    <form method="POST" class="formulario" action="/admin/sistemas/registropc/eliminar">
        <input type="hidden" name="id" value="<?php echo $computadora->id; ?>">
        <input type="submit" value="Eliminar" class="formulario__submit">
    </form>
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

