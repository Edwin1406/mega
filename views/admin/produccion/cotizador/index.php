<h1 class="dashboard__heading"> <?php echo $titulo ?> </h1>

<div class="dashboard__contenedor-boton">
    <a class="dashboard__boton" href="/admin/produccion/index" >
        <i class="fa-solid fa-circle-arrow-left"></i>
        Volver
    </a>
</div>




<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Gestión de Cartón Corrugado</title>
    <link rel="stylesheet" href="styles.css"> <!-- Aquí puedes enlazar un archivo CSS -->
</head>
<body>
    <h1>Sistema de Gestión de Cartón Corrugado</h1>

    <!-- Formulario para crear Bobinas -->
    <h2>Crear Bobina</h2>
    <form method="post">
        <input type="hidden" name="accion" value="crear_bobina">
        <label for="tipo_papel">Tipo de Papel:</label>
        <input type="text" name="tipo_papel" required>
        <label for="gramaje">Gramaje (g/m²):</label>
        <input type="number" name="gramaje" required>
        <label for="ancho">Ancho (mm):</label>
        <input type="number" name="ancho" required>
        <button type="submit">Crear Bobina</button>
    </form>

    <!-- Listar Bobinas -->
    <h2>Bobinas</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Tipo de Papel</th>
                <th>Gramaje</th>
                <th>Ancho</th>
            </tr>
        </thead>
        <tbody>
            <?php ?>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
           
        </tbody>
    </table>

    <!-- Formulario para crear Máquinas -->
    <h2>Crear Máquina</h2>
    <form method="post">
        <input type="hidden" name="accion" value="crear_maquina">
        <label for="nombre">Nombre de la Máquina:</label>
        <input type="text" name="nombre" required>
        <label for="num_cuchillas">Número de Cuchillas:</label>
        <input type="number" name="num_cuchillas" required>
        <label for="ancho_maximo">Ancho Máximo (mm):</label>
        <input type="number" name="ancho_maximo" required>
        <label for="gramaje_maximo">Gramaje Máximo (g/m²):</label>
        <input type="number" name="gramaje_maximo" required>
        <button type="submit">Crear Máquina</button>
    </form>

    <!-- Listar Máquinas -->
    <h2>Máquinas</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Número de Cuchillas</th>
                <th>Ancho Máximo</th>
                <th>Gramaje Máximo</th>
            </tr>
        </thead>
        <tbody>
           
                <tr>
                    <td></td>
                    <td>></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
        
        </tbody>
    </table>

    <!-- Formulario para crear Combinaciones -->
    <h2>Crear Combinación de Bobinas</h2>
    <form method="post">
        <input type="hidden" name="accion" value="crear_combinacion">
        <label for="bobina_interna_id">Bobina Interna ID:</label>
        <input type="number" name="bobina_interna_id" required>
        <label for="bobina_media_id">Bobina Media ID:</label>
        <input type="number" name="bobina_media_id" required>
        <label for="bobina_externa_id">Bobina Externa ID:</label>
        <input type="number" name="bobina_externa_id" required>
        <label for="num_piezas">Número de Piezas:</label>
        <input type="number" name="num_piezas" required>
        <label for="posicion_cuchilla">Posición de Cuchilla (mm):</label>
        <input type="number" name="posicion_cuchilla" required>
        <label for="desperdicio">Desperdicio (mm):</label>
        <input type="number" name="desperdicio" required>
        <label for="gramaje_total">Gramaje Total (g/m²):</label>
        <input type="number" name="gramaje_total" required>
        <label for="estado_combinacion">Estado de Combinación:</label>
        <input type="text" name="estado_combinacion" required>
        <label for="maquina_id">Máquina ID:</label>
        <input type="number" name="maquina_id" required>
        <button type="submit">Crear Combinación</button>
    </form>

    <!-- Listar Combinaciones -->
    <h2>Combinaciones</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Bobina Interna ID</th>
                <th>Bobina Media ID</th>
                <th>Bobina Externa ID</th>
                <th>Número de Piezas</th>
                <th>Posición de Cuchilla</th>
                <th>Desperdicio</th>
                <th>Gramaje Total</th>
                <th>Estado de Combinación</th>
                <th>Máquina ID</th>
            </tr>
        </thead>
        <tbody>
           
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>?></td>
                    <td><</td>
                    <td></td>
                    <td>></td>
                    <td></td>
                </tr>
       
        </tbody>
    </table>

    