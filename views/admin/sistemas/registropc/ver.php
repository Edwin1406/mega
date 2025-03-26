<h2 class="dashboard__heading"> <?php echo $titulo ?> </h2>




<style>
    .contenedor {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
    }


</style>

<div class="contenedor">
    <div class="caracteristicas">
        <h1> informacion de la computadora </h1>
        <div class="caracteristicas__item">
            <p> ID DEL EQUIPO: </p>
            <p> <?php echo $computadora->numero_interno ?> </p>
        
        </div>
        <div class="caracteristicas__item">
            <p> AREA: </p>
            <p> <?php echo $computadora->area ?> </p>
        </div>




    </div>
</div>