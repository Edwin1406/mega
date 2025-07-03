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
