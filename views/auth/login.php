<main class="auth">
    <h2 class="auth__heading"><?php echo $titulo ?? '' ?></h2>
    <p class="auth__texto">Inicia Sesion en Sitio Web </p>
    <?php require_once __DIR__. '/../templates/alertas.php'; ?>


    <form  class="formulario" method="POST" action="/">
        <div class="formulario__campo">
            <label for="email"  class="formulario__label">Email</label>
            <input 
                type="email" 
                name="email" 
                class="formulario__input" 
                placeholder="Tu Email" 
                id="email"
                >
        </div>
        <div class="formulario__campo">
            <label for="password"  class="formulario__label">Password</label>
            <input 
                type="password" 
                name="password" 
                class="formulario__input" 
                placeholder="Tu password" 
                id="password"
                >
        </div>
        <input type="submit" value="Iniciar Sesion" class="formulario__submit">
    </form>
    <div class="acciones">
        <a href="/olvide" class="acciones__enlace">Olvide mi password</a>
        <a href="/registro" class="acciones__enlace">Crear Cuenta</a>
    </div>
</main>