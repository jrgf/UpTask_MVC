<?php include_once __DIR__.'/header-dashboard.php'; ?>

<?php if(count($proyectos)===0){?>
    <p class="no-proyectos">No Hay Proyectos Aún</p><a href="/crear-proyecto">
        Comienza Creando Uno
    </a>
<?php } else {?>
        <ul class="listado-proyectos">
            <?php foreach($proyectos as $proyecto){ ?>
                 <li class="proyecto">
                    <a href="/proyecto?url=<?php echo $proyecto->url; ?>">
                    <?php echo $proyecto->proyecto ?>
                    </a>
                    </li>   
            <?php }?>
        </ul>
    <?php } ?>
<?php include_once __DIR__.'/footer-dashboard.php'; ?>   
