<h1 class="dashboard__heading"> <?php echo $titulo ?> </h1>

<?php if(count($escoger)===0) {?>
    <p class="no-areas">NO HAY AREAS ASIGNADAS </p>

<?php  }else {?>
    <ul class="listado-areas">
        <?php foreach($escoger as $escoger) {?>
            <li class="areas">
                <a class="nando" href="/admin/area/paginaArea?id=<?php echo $escoger->url ?>" >
                    <?php echo $escoger->area ?>
                </a>
            </li>
        <?php } ?>
    </ul>

<?php  }?>
        
        <style>
            .nando{
                text-align: center;
            }
        </style>