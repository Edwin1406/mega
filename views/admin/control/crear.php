<form action="guardar.php" method="POST">
  Fecha: <input type="date" name="fecha" required><br>
  Nº Turnos: <input type="number" name="turnos" required><br>
  Operador: 
    <select name="operador">
      <option value="Luis Govea">Luis Govea</option>
      <option value="Guillermo Bonilla">Guillermo Bonilla</option>
    </select><br>
  Horas Programadas: <input type="time" name="horas_programadas"><br>
  Golpes Máquina: <input type="number" name="golpes_maquina"><br>
  Golpes Máquina/Hora: <input type="number" name="golpes_maquina_hora"><br>
  Nº Cambios de Medida: <input type="number" name="cambios_medida"><br>
  Separadores: <input type="number" name="cantidad_separadores"><br>
  Cajas: <input type="number" name="cantidad_cajas"><br>
  Papel: <input type="number" name="cantidad_papel"><br>
  Desperdicio (Kg): <input type="number" name="desperdicio_kg"><br>
  <button type="submit">Guardar</button>
</form>



<h2 class="dashboard__heading"> <?php echo $titulo ?> </h2>
<div class="dashboard__contenedor-boton">
    <a class="dashboard__boton" href="/admin/vendedor/cliente/tabla">
    <i class="fa-regular fa-eye"></i>
        VER ARCHIVO 
    </a>

</div>

<div class="dashboard__formulario">

<?php include_once __DIR__.'/../../../templates/alertas.php'  ?>

    <form method="POST" action="/admin/vendedor/cliente/crear"  class="formulario" enctype="multipart/form-data">

     
    <?php include_once __DIR__.'/formulario.php'  ?>

        <input class="formulario__submit formulario__submit--registrar" type="submit" value="Registrar Archivo">

        
    </form>

</div>