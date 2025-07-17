<h2 class="dashboard__heading"> <?php echo $titulo ?> </h2>

<div class="dashboard__formulario">

    <?php include_once __DIR__ . '/../../../templates/alertas.php'  ?>


    <form method="POST" action="/admin/produccion/papel/consumo_general" class="formulario" enctype="multipart/form-data">

        
        <div class="formulario__campo">
            <label class="formulario__label" for="tipo_maquina">Tipo Maquina</label>
            <select
            name="tipo_maquina"
            id="tipo_maquina"
            class="formulario__input">
            <option value="">Selecciona una opción</option>
            <option value="CORRUGADOR" <?php echo (isset($control->tipo_maquina) && $control->tipo_maquina == 'CORRUGADOR') ? 'selected' : ''; ?>>CORRUGADOR</option>
            <option value="MICRO" <?php echo (isset($control->tipo_maquina) && $control->tipo_maquina == 'MICRO') ? 'selected' : ''; ?>>MICRO</option>
            <option value="TROQUEL" <?php echo (isset($control->tipo_maquina) && $control->tipo_maquina == 'TROQUEL') ? 'selected' : ''; ?>>TROQUEL</option>
            <option value="FLEXOGRAFICA" <?php echo (isset($control->tipo_maquina) && $control->tipo_maquina == 'FLEXOGRAFICA') ? 'selected' : ''; ?>>FLEXOGRAFICA</option>
            <option value="PRE PRINTER " <?php echo (isset($control->tipo_maquina) && $control->tipo_maquina == 'PRE PRINTER ') ? 'selected' : ''; ?>>PRE PRINTER </option>
            <option value="DOBLADO" <?php echo (isset($control->tipo_maquina) && $control->tipo_maquina == 'DOBLADO') ? 'selected' : ''; ?>>DOBLADO</option>
            <option value="CORTE CEJA" <?php echo (isset($control->tipo_maquina) && $control->tipo_maquina == 'CORTE CEJA') ? 'selected' : ''; ?>>CORTE CEJA</option>
            <option value="TROQUEL" <?php echo (isset($control->tipo_maquina) && $control->tipo_maquina == 'TROQUEL') ? 'selected' : ''; ?>>TROQUEL</option>
            <option value="CONVERTIDOR" <?php echo (isset($control->tipo_maquina) && $control->tipo_maquina == 'CONVERTIDOR') ? 'selected' : ''; ?>>CONVERTIDOR</option>
            <option value="GUILLOTINA LAMINA" <?php echo (isset($control->tipo_maquina) && $control->tipo_maquina == 'GUILLOTINA LAMINA') ? 'selected' : ''; ?>>GUILLOTINA LAMINA</option>
            <option value="GUILLOTINA PAPEL" <?php echo (isset($control->tipo_maquina) && $control->tipo_maquina == 'GUILLOTINA PAPEL') ? 'selected' : ''; ?>>GUILLOTINA PAPEL</option>
            <option value="EMPAQUE" <?php echo (isset($control->tipo_maquina) && $control->tipo_maquina == 'EMPAQUE') ? 'selected' : ''; ?>>EMPAQUE</option>
        </select>
        
        <div class="formulario__campo">
            <label class="formulario__label" for="total_general">Total General:</label>
            <input
                type="number"
                name="total_general"
                id="total_general"
                class="formulario__input"
                placeholder="total_general"
                value="<?php echo $control->total_general ?? '' ?>">
        </div>

        </div>

        <input class="formulario__submit formulario__submit--registrar" type="submit" value="Registrar Papel">
    </form>
</div>



<h2 style="text-align:center;">Consumo General por Máquina</h2>

<?php
function obtenerDatosAPI($url) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true); // sigue redirecciones
    curl_setopt($ch, CURLOPT_MAXREDIRS, 10);         // máximo 10 redirecciones
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // evita error por SSL
    $respuesta = curl_exec($ch);

    if (curl_errno($ch)) {
        echo "Error al conectar con la API: " . curl_error($ch);
        return null;
    }

    curl_close($ch);
    return json_decode($respuesta, true);
}

// Uso:
$apiUrl = "https://megawebsistem.com/admin/api/apiConsumoGeneral";
$datos = obtenerDatosAPI($apiUrl);

if (is_array($datos)) {
    // Aquí haces count(), foreach, etc.
} else {
    echo "<p style='color:red; text-align:center;'>No se pudo obtener datos de la API.</p>";
}
?>


<table>
  <thead>
    <tr>
      <th>ID</th>
      <th>Tipo de Máquina</th>
      <th>Total General</th>
      <th>Fecha</th>
      <th>Acción</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($datosPagina as $fila): ?>
      <tr>
        <td><?= htmlspecialchars($fila['id']) ?></td>
        <td><?= htmlspecialchars($fila['tipo_maquina']) ?></td>
        <td><?= htmlspecialchars($fila['total_general']) ?></td>
        <td><?= htmlspecialchars($fila['created_at']) ?></td>
        <td><a class="btn-editar" href="editar_maquina.php?id=<?= urlencode($fila['id']) ?>">Editar</a></td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>

<div class="paginador">
  <?php for ($i = 1; $i <= $totalPaginas; $i++): ?>
    <a href="?pagina=<?= $i ?>" class="<?= $i == $pagina ? 'active' : '' ?>"><?= $i ?></a>
  <?php endfor; ?>
</div>
