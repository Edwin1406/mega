<fieldset class="formulario__fieldset">
    <legend class="formulario__legend">Ingresar visor </legend>

    <div class="formulario__campo">
        <label class="formulario__label" for="nombre_cliente">Nombre Cliente</label>
        <input
            type="text"
            name="nombre_cliente"
            id="nombre_cliente"
            class="formulario__input"
            placeholder="nombre cliente"
            value="<?php echo $cliente->nombre_cliente ?? '' ?>">
    </div>

    <div class="formulario__campo">
        <label class="formulario__label" for="nombre_producto">Nombre Producto</label>
        <input
            type="text"
            name="nombre_producto"
            id="nombre_producto"
            class="formulario__input"
            placeholder="nombre_producto"
            value="<?php echo $cliente->nombre_producto ?? '' ?>">
    </div>
   

    <div class="formulario__campo">
    <label class="formulario__label" for="imagen">Imagen</label>
    <input
        type="file"
        name="imagen"
        id="imagen"
        class="formulario__input"
        placeholder="imagen del cliente"
        value="<?php echo $cliente->imagen ?? '' ?>">
    <div id="preview" class="formulario__preview">Pega la imagen aquí con Ctrl+V</div>
</div>

<script>
    // Selección del contenedor de la vista previa
    const preview = document.getElementById('preview');

    // Escuchar el evento 'paste'
    document.addEventListener('paste', (event) => {
        const items = event.clipboardData.items;

        for (let i = 0; i < items.length; i++) {
            const item = items[i];

            // Verificar si el contenido pegado es una imagen
            if (item.type.startsWith('image/')) {
                const file = item.getAsFile();

                // Crear una vista previa de la imagen
                const reader = new FileReader();
                reader.onload = (e) => {
                    preview.innerHTML = `<img src="${e.target.result}" alt="Vista previa" style="max-width: 100%; height: auto;">`;
                };
                reader.readAsDataURL(file);

                // (Opcional) Almacenar el archivo en un input invisible para envío
                const fileInput = document.getElementById('imagen');
                const dataTransfer = new DataTransfer();
                dataTransfer.items.add(file);
                fileInput.files = dataTransfer.files;
                break;
            }
        }
    });
</script>

    
</fieldset>