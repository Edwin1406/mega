<h2 class="dashboard__heading"> <?php echo $titulo ?> </h2>
<div class="dashboard__contenedor-boton">
    <a class="dashboard__boton" href="/admin/produccion/papel/tabla">
        <i class="fa-regular fa-eye"></i>
        VER PAPEL
    </a>

</div>





<div class="dashboard__formulario">

    <?php include_once __DIR__ . '/../../../templates/alertas.php'  ?>

<form method="GET" action="/admin/produccion/papel/ingresoConsumo" onsubmit="return false;">
    <div class="formulario__campo">
        <label class="formulario__label" for="id_orden">ID ORDEN</label>
        <input
            type="number"
            name="id_orden"
            id="id_orden"
            class="formulario__input"
            placeholder="id_orden"
            value="<?php echo isset($id_orden) ? htmlspecialchars($id_orden) : ''; ?>"
            onchange="buscarOrden(this.value)">
    </div>
</form>

<script>
function buscarOrden(id) {
    if (id) {
        window.location.href = '/admin/produccion/papel/ingresoConsumo?id_orden=' + encodeURIComponent(id);
    }
}
</script>


</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>


<?php if (!empty($resultados)) : ?>
    <h3>Resultados para ID ORDEN: <?php echo htmlspecialchars($id_orden); ?></h3>

    <?php foreach ($resultados as $modelo => $registros) : ?>
        <?php if (!empty($registros) && is_array($registros) && isset($registros[0]) && is_array($registros[0])) : ?>
            <h4><?php echo $modelo; ?></h4>
            <table class="tabla">
                <thead>
                    <tr>
                        <?php foreach ($registros[0] as $campo => $valor) : ?>
                            <th><?php echo htmlspecialchars($campo); ?></th>
                        <?php endforeach; ?>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($registros as $fila) : ?>
                        <tr>
                            <?php foreach ($fila as $valor) : ?>
                                <td><?php echo htmlspecialchars($valor); ?></td>
                            <?php endforeach; ?>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else : ?>
            <p>No hay datos disponibles en el módulo <strong><?php echo htmlspecialchars($modelo); ?></strong>.</p>
        <?php endif; ?>
    <?php endforeach; ?>

<?php else : ?>
    <p>No se encontraron resultados para el ID ORDEN: <strong><?php echo htmlspecialchars($id_orden); ?></strong>.</p>
<?php endif; ?>
