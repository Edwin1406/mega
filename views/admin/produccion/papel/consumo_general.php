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



<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Formulario de Contacto</title>
</head>
<body>
  <h2>Envíame un mensaje</h2>
  <form action="enviar.php" method="POST">
    <label>Tu nombre:</label><br>
    <input type="text" name="nombre" required><br><br>

    <label>Tu mensaje:</label><br>
    <textarea name="mensaje" rows="5" required></textarea><br><br>

    <button type="submit">Enviar</button>
  </form>
</body>
</html>

<?php
$token = "7602982908:AAHNVRxWgANtUvz5WQvcOev5ITXPYhxFVIc"; // Reemplaza con el token real
$chat_id = "5451350032"; // Reemplaza con tu chat ID o el del grupo

// Recibe datos del formulario
$nombre = htmlspecialchars($_POST['nombre']);
$mensaje = htmlspecialchars($_POST['mensaje']);

// Arma el texto
$texto = "📩 *Nuevo mensaje desde el formulario:*\n\n👤 Nombre: $nombre\n📝 Mensaje: $mensaje";

// URL de Telegram
$url = "https://api.telegram.org/bot$token/sendMessage";

// Enviar mensaje
file_get_contents($url . "?chat_id=$chat_id&text=" . urlencode($texto) . "&parse_mode=Markdown");

// Redirige a una página de gracias o similar
echo "✅ Mensaje enviado. Gracias por contactarme.";
?>








