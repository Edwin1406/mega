<h2 class="dashboard__heading"> <?php echo $titulo ?> </h2>

<style>
    .dashboard__sidebar {
            /* Suponiendo que el contenedor tiene la clase .barra-lateral */
            display: none;
        }
</style>

<!-- VER TABLA -->
<div class="dashboard__contenedor-boton">
    <a class="dashboard__boton" href="/admin/produccion/papel/tablaconsumo">
        <i class="fa-regular fa-eye"></i>
        VER TABLA DE CONSUMO GENERAL
    </a>
</div>

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
            <option value="PRE-PRINTER" <?php echo (isset($control->tipo_maquina) && $control->tipo_maquina == 'PRE-PRINTER') ? 'selected' : ''; ?>>PRE-PRINTER</option>
            <option value="DOBLADO" <?php echo (isset($control->tipo_maquina) && $control->tipo_maquina == 'DOBLADO') ? 'selected' : ''; ?>>DOBLADO</option>
            <option value="CORTE CEJA" <?php echo (isset($control->tipo_maquina) && $control->tipo_maquina == 'CORTE CEJA') ? 'selected' : ''; ?>>CORTE CEJA</option>
            <option value="TROQUEL" <?php echo (isset($control->tipo_maquina) && $control->tipo_maquina == 'TROQUEL') ? 'selected' : ''; ?>>TROQUEL</option>
            <option value="CONVERTIDOR" <?php echo (isset($control->tipo_maquina) && $control->tipo_maquina == 'CONVERTIDOR') ? 'selected' : ''; ?>>CONVERTIDOR</option>
            <option value="GUILLOTINA LAMINA" <?php echo (isset($control->tipo_maquina) && $control->tipo_maquina == 'GUILLOTINA LAMINA') ? 'selected' : ''; ?>>GUILLOTINA LAMINA</option>
            <option value="GUILLOTINA PAPEL" <?php echo (isset($control->tipo_maquina) && $control->tipo_maquina == 'GUILLOTINA PAPEL') ? 'selected' : ''; ?>>GUILLOTINA PAPEL</option>
            <option value="EMPAQUE" <?php echo (isset($control->tipo_maquina) && $control->tipo_maquina == 'EMPAQUE') ? 'selected' : ''; ?>>EMPAQUE</option>
             <option value="BODEGA" <?php echo (isset($control->tipo_maquina) && $control->tipo_maquina == 'BODEGA') ? 'selected' : ''; ?>>BODEGA</option>
            
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

        <input class="formulario__submit formulario__submit--registrar" type="submit" value="Registrar Consumo General">
    </form>
</div>


<script>
    document.addEventListener("DOMContentLoaded", function () {
        const formulario = document.querySelector(".formulario");
        const boton = formulario.querySelector("input[type='submit']");

        formulario.addEventListener("submit", function () {
            // Desactiva el botón
            boton.disabled = true;
            boton.value = "Registrando..."; // Opcional: cambia el texto
        });
    });
</script>









<?php
$TOKEN = "7602982908:AAHNVRxWgANtUvz5WQvcOev5ITXPYhxFVIc"; // reemplaza con tu token real
$URL = "https://api.telegram.org/bot$TOKEN/";

$update = json_decode(file_get_contents("php://input"), true);
$chat_id = $update["message"]["chat"]["id"];
$message = strtolower(trim($update["message"]["text"]));
$user_file = "usuarios/$chat_id.txt";

// Crear carpeta si no existe
if (!file_exists("usuarios")) {
    mkdir("usuarios", 0777, true);
}

// Verificar estado del usuario
$estado = file_exists($user_file) ? file_get_contents($user_file) : "inicio";

if ($estado == "inicio") {
    if ($message == "/start" || $message == "hola") {
        file_put_contents($user_file, "esperando_nombre");
        enviar($chat_id, "¡Hola! ¿Cómo estás? ¿Cuál es tu nombre?");
    } else {
        enviar($chat_id, "Escríbeme 'hola' para empezar 🙂");
    }
} elseif ($estado == "esperando_nombre") {
    file_put_contents($user_file, "esperando_edad");
    file_put_contents("usuarios/$chat_id-nombre.txt", $message);
    enviar($chat_id, "Mucho gusto, $message 😊 ¿Cuántos años tienes?");
} elseif ($estado == "esperando_edad") {
    $nombre = file_get_contents("usuarios/$chat_id-nombre.txt");
    enviar($chat_id, "Gracias $nombre. Entonces tienes $message años. ¡Qué bien! 👍");
    // Opcional: reiniciar
    unlink($user_file);
    unlink("usuarios/$chat_id-nombre.txt");
}

// Función para enviar mensaje
function enviar($chat_id, $text) {
    global $URL;
    file_get_contents($URL . "sendMessage?chat_id=$chat_id&text=" . urlencode($text));
}
?>
