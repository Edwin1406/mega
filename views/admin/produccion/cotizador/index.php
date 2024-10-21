<h1 class="dashboard__heading"> <?php echo $titulo ?> </h1>

<div class="dashboard__contenedor-boton">
    <a class="dashboard__boton" href="/admin/produccion/index" >
        <i class="fa-solid fa-circle-arrow-left"></i>
        Volver
    </a>
</div>



<?php
require 'Bobina.php';
require 'Maquina.php';
require 'Combinacion.php';
require 'Usuario.php';

// Manejo de formularios
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['accion'])) {
        switch ($_POST['accion']) {
            case 'crear_bobina':
                Bobina::crear($_POST['tipo_papel'], $_POST['gramaje'], $_POST['ancho']);
                break;
            case 'crear_maquina':
                Maquina::crear($_POST['nombre'], $_POST['num_cuchillas'], $_POST['ancho_maximo'], $_POST['gramaje_maximo']);
                break;
            case 'crear_combinacion':
                Combinacion::crear($_POST['bobina_interna_id'], $_POST['bobina_media_id'], $_POST['bobina_externa_id'], $_POST['num_piezas'], $_POST['posicion_cuchilla'], $_POST['desperdicio'], $_POST['gramaje_total'], $_POST['estado_combinacion'], $_POST['maquina_id']);
                break;
            case 'crear_usuario':
                Usuario::crear($_POST['nombre'], $_POST['correo'], $_POST['contraseña']);
                break;
        }
    }
}

// Obtener datos para mostrar
$bobinas = Bobina::obtenerTodas();
$maquinas = Maquina::obtenerTodas();
$combinaciones = Combinacion::obtenerTodas();
$usuarios = Usuario::obtenerTodos();
?>

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
            <?php foreach ($bobinas as $bobina): ?>
                <tr>
                    <td><?= $bobina['id'] ?></td>
                    <td><?= $bobina['tipo_papel'] ?></td>
                    <td><?= $bobina['gramaje'] ?></td>
                    <td><?= $bobina['ancho'] ?></td>
                </tr>
            <?php endforeach; ?>
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
            <?php foreach ($maquinas as $maquina): ?>
                <tr>
                    <td><?= $maquina['id'] ?></td>
                    <td><?= $maquina['nombre'] ?></td>
                    <td><?= $maquina['num_cuchillas'] ?></td>
                    <td><?= $maquina['ancho_maximo'] ?></td>
                    <td><?= $maquina['gramaje_maximo'] ?></td>
                </tr>
            <?php endforeach; ?>
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
            <?php foreach ($combinaciones as $combinacion): ?>
                <tr>
                    <td><?= $combinacion['id'] ?></td>
                    <td><?= $combinacion['bobina_interna_id'] ?></td>
                    <td><?= $combinacion['bobina_media_id'] ?></td>
                    <td><?= $combinacion['bobina_externa_id'] ?></td>
                    <td><?= $combinacion['num_piezas'] ?></td>
                    <td><?= $combinacion['posicion_cuchilla'] ?></td>
                    <td><?= $combinacion['desperdicio'] ?></td>
                    <td><?= $combinacion['gramaje_total'] ?></td>
                    <td><?= $combinacion['estado_combinacion'] ?></td>
                    <td><?= $combinacion['maquina_id'] ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <!-- Formulario para crear Usuarios -->
    <h2>Crear Usuario</h2>
    <form method="post">
        <input type="hidden" name="accion" value="crear_usuario">
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" required>
        <label for="correo">Correo:</label>
        <input
