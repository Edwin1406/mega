<h1 class="dashboard__heading"> <?php echo $titulo ?> </h1>

<?php if(count($escoger)===0) {?>
    <p class="no-proyectos">NO HAY AREAS ASIGNADAS </p>

<?php  }else {?>
    <ul class="listado-proyectos">
        <?php foreach($escoger as $escoger) {?>
            <li class="proyecto">
                <a href="/admin/area/paginaArea?id=<?php echo $escoger->url ?>" class="proyecto__nombre">
                    <?php echo $escoger->area ?>
                </a>
            </li>
        <?php } ?>
    </ul>

<?php  }?>