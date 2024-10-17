<h1 class="titulo__heading"> <?php echo $titulo ?> </h1>

<?php if(count($escoger)===0) {?>
    <p class="no-areas">NO HAY AREAS ASIGNADAS </p>

<?php  }else {?>
    <ul class="lista-areas">
        <?php foreach($escoger as $escoger) {?>
            <li class="areas">
                <a  href="/admin/area/paginaArea?id=<?php echo $escoger->url ?>" >
                    <?php echo $escoger->area ?> <i class="fa-solid fa-hands-bound"></i>
                </a>
            </li>
        <?php } ?>
    </ul>

<?php  }?>
