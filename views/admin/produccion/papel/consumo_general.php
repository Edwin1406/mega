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
    $ch = curl_init($url);
    curl_setopt_array($ch, [
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_MAXREDIRS => 5,
        CURLOPT_SSL_VERIFYPEER => false,
        CURLOPT_HEADER => false,
        CURLOPT_USERAGENT => 'Mozilla/5.0'
    ]);

    $respuesta = curl_exec($ch);

    if (curl_errno($ch)) {
        echo "<p class='error'>Error al conectar con la API: " . curl_error($ch) . "</p>";
        return null;
    }

    curl_close($ch);
    return json_decode($respuesta, true);
}

$apiUrl = "https://megawebsistem.com/admin/api/apiConsumoGeneral"; 
$datos = obtenerDatosAPI($apiUrl);

// Variables por defecto
$porPagina = 5;
$pagina = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
$pagina = max($pagina, 1);
$inicio = ($pagina - 1) * $porPagina;

if (is_array($datos)) {
    $totalRegistros = count($datos);
    $totalPaginas = ceil($totalRegistros / $porPagina);
    $datosPagina = array_slice($datos, $inicio, $porPagina);
} else {
    $totalPaginas = 0;
    $datosPagina = [];
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
