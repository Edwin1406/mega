<fieldset class="formulario__fieldset">
    <legend class="formulario__legend">Información Personal</legend>
    <div class="formulario__campo">
        <label class="formulario__label" for="nombre">Nombre</label>
        <input
            type="text"
            name="nombre"
            id="nombre"
            class="formulario__input"
            placeholder="Nombre del ponente"
            value="<?php echo $ponente->nombre ?? '' ?>">
    </div>

    <div class="formulario__campo">
        <label class="formulario__label" for="apellido">Apellido</label>
        <input
            type="text"
            name="apellido"
            id="apellido"
            class="formulario__input"
            placeholder="Apellido del ponente"
            value="<?php echo $ponente->apellido ?? '' ?>">
    </div>

    <div class="formulario__campo">
        <label class="formulario__label" for="ciudad">Ciudad</label>
        <input
            type="text"
            name="ciudad"
            id="ciudad"
            class="formulario__input"
            placeholder="Ciudad del ponente"
            value="<?php echo $ponente->ciudad ?? '' ?>">
    </div>

    <div class="formulario__campo">
        <label class="formulario__label" for="pais">País</label>
        <input
            type="text"
            name="pais"
            id="pais"
            class="formulario__input"
            placeholder="País del ponente"
            value="<?php echo $ponente->pais ?? '' ?>">
    </div>

    <div class="formulario__campo">
        <label class="formulario__label" for="imagen">imagen</label>
        <input
            type="file"
            name="imagen"
            id="imagen"
            class="formulario__input formulario__input--file">
    </div>
    <?php if(isset($ponente->imagen_actual)) :?>
        <a class="formulario__texto">Imagen Actual</a>
        <div class="formulario__imagen">
            <picture>
                <source srcset="<?php echo $_ENV['HOST'] . '/sitioweb/public/img/speakers/' . $ponente->imagen_actual; ?>.webp" type="image/webp"> 
                <source srcset="<?php echo $_ENV['HOST'] . '/sitioweb/public/img/speakers/' . $ponente->imagen_actual; ?>.png" type="image/png"> 
                <img  src="<?php echo $_ENV['HOST'] . '/sitioweb/public/img/speakers/' . $ponente->imagen_actual; ?>.png" alt="no carga">
            </picture>
        </div>

    <?php endif;?>

</fieldset>

<fieldset class="formulario__fieldset">
    <legend class="formulario__legend">Información Extra</legend>
    <div class="formulario__campo">
        <label class="formulario__label" for="tags_input">Áreas de Experiencia (separadas por comas)</label>
        <input
            type="text"
            id="tags_input"
            class="formulario__input"
            placeholder="Ej: PHP, Laravel, JavaScript"
            value="<?php echo $ponente->tags_input ?? '' ?>">
        <div id="tags" class="formulario__listado"> </div>
        <input type="hidden" name="tags" value="<?php echo $ponente->tags ?? ''; ?>">
    </div>

</fieldset>


<fieldset class="formulario__fieldset">
    <legend class="formulario__legend">Redes Sociales</legend>
    <div class="formulario__campo">


        <div class="formulario__contenedor-icono">
            <div class="formulario__icono">
                <i class="fa-brands fa-facebook"></i>
            </div>
            <input
                type="text"
                class="formulario__input--sociales"
                name="redes[facebook]"
                placeholder="Facebook del ponente"
                value="<?php echo $redes->facebook ?? '' ?>">
        </div>

        <div class="formulario__contenedor-icono">
            <div class="formulario__icono">
                <i class="fa-brands fa-twitter"></i>
            </div>
            <input
                type="text"
                class="formulario__input--sociales"
                name="redes[twitter]"
                placeholder="Twitter del ponente"
                value="<?php echo $redes->twitter ?? '' ?>">
        </div>

        <div class="formulario__contenedor-icono">
            <div class="formulario__icono">
                <i class="fa-brands fa-instagram"></i>
            </div>
            <input
                type="text"
                class="formulario__input--sociales"
                name="redes[instagram]"
                placeholder="Instagram del ponente"
                value="<?php echo $redes->instagram ?? '' ?>">
        </div>

        <div class="formulario__contenedor-icono">
            <div class="formulario__icono">
                <i class="fa-brands fa-linkedin"></i>
            </div>
            <input
                type="text"
                class="formulario__input--sociales"
                name="redes[linkedin]"
                placeholder="Linkedin del ponente"
                value="<?php echo $redes->linkedin ?? '' ?>">
        </div>

        <div class="formulario__contenedor-icono">
            <div class="formulario__icono">
                <i class="fa-brands fa-github"></i>
            </div>
            <input
                type="text"
                class="formulario__input--sociales"
                name="redes[github]"
                placeholder="Github del ponente"
                value="<?php echo $redes->github ?? '' ?>">

        </div>

        <div class="formulario__contenedor-icono">
            <div class="formulario__icono">
                <i class="fa-brands fa-youtube"></i>
            </div>
            <input
                type="text"
                class="formulario__input--sociales"
                name="redes[youtube]"
                placeholder="Youtube del ponente"
                value="<?php echo $redes->youtube ?? '' ?>">
        </div>

        <div class="formulario__contenedor-icono">
            <div class="formulario__icono">
                <i class="fa-brands fa-tiktok"></i>
            </div>
            <input
                type="text"
                class="formulario__input--sociales"
                name="redes[tiktok]"
                placeholder="Tiktok del ponente"
                value="<?php echo $redes->tiktok ?? '' ?>">
        </div>




    </div>







</fieldset>