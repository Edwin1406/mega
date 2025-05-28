<h2 class="dashboard__heading"><?php echo $titulo ?></h2>

<div class="dashboard__contenedor-boton">
    <a class="dashboard__boton" href="/admin/produccion/papel/tabla">
        <i class="fa-regular fa-eye"></i>
        VER PAPEL
    </a>
</div>

<div class="dashboard__formulario">
    <?php include_once __DIR__ . '/../../../templates/alertas.php'  ?>

    <form method="POST" action="/admin/produccion/papel/ingresoConsumo" class="formulario" enctype="multipart/form-data">
        <div class="formulario__campo">
            <label class="formulario__label" for="id_orden">ID ORDEN</label>
            <input
                type="number"
                name="id_orden"
                id="id_orden"
                class="formulario__input"
                placeholder="id_orden"
                value="<?php echo $papel->id_orden ?? '' ?>">
        </div>

        <div class="formulario__campo">
            <label class="formulario__label" for="CONSUMO">CONSUMO PAPEL</label>
            <input
                type="number"
                name="CONSUMO"
                id="CONSUMO"
                class="formulario__input"
                placeholder="CONSUMO PAPEL"
                value="<?php echo $papel->CONSUMO ?? '' ?>">
        </div>

        <input class="formulario__submit formulario__submit--registrar" type="submit" value="Registrar Papel">
    </form>

    <div id="resultados-tabla" class="mt-4">
        <?php if (!empty($resultados)) : ?>
    <h3>Resultados para ID ORDEN: <?php echo htmlspecialchars($id_orden); ?></h3>
    <?php foreach ($resultados as $modelo => $registros) : ?>
        <?php if (!empty($registros)) : ?>
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
        <?php endif; ?>
    <?php endforeach; ?>
<?php else : ?>
    <p>No se encontraron resultados para el ID ORDEN: <strong><?php echo htmlspecialchars($id_orden); ?></strong>.</p>
<?php endif; ?>

    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const input = document.getElementById('id_orden');

        input.addEventListener('change', async () => {
            const id_orden = input.value.trim();

            if (id_orden !== '') {
                const response = await fetch(`/admin/produccion/papel/consultar?id_orden=${id_orden}`);
                const html = await response.text();
                document.getElementById('resultados-tabla').innerHTML = html;
            }
        });
    });
</script>
