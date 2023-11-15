<?php
    $estado;

    if($row_posts['found'] == 'found') $estado = 'Encontrado';
    elseif ($row_posts['lost'] == 'lost') $estado = 'Perdido';
    elseif ($row_posts['gathered'] == 'gathered') $estado = 'Recuperado';

    require 'functions/agregarAncient.php';

    echo '<div class="tarjeta">
        <div class="tarjeta__etiquetas">';
        if (($row_posts['ancient']) == 'ancient') {
            echo '<div class="etiquetaEST etiquetaEST--ancient"><span>#Ancient</span></div>';
        }
        if (($row_posts['found']) == 'found') {
            echo '<div class="etiquetaEST etiquetaEST--found"><span>#USADO</span></div>';
        }
        if (($row_posts['lost']) == 'lost') {
            echo '<div class="etiquetaEST etiquetaEST--lost"><span>#NUEVO</span></div>';
        }
        if (($row_posts['gathered']) == 'gathered') {
            echo '<div class="etiquetaEST etiquetaEST--gathered"><span>#VENDIDO</span></div>';
        }
    echo '</div>
       <div class="tarjeta__image">
           <img src=data:image;base64,'.$row_posts['imagen'].' alt="imagen_objeto"/>
       </div>
       <div class="tarjeta__detalles">
           <h4 class="tarjeta__nombre">'.($row_posts['nombre_objeto']).'</h4>
           <span>
                <span class="tarjeta__etiquetasCAT">
                    <p class="etiquetaCAT">'.($row_posts['nombre']).'</p>
                    <p class="etiquetaCAT ubi">'.($row_posts['ubi']).'</p>
                </span>
               <button class="boton boton__tarjeta"><a href="detailobject.php?id='.$row_posts['id'].'">Informacion</a></button>
           </span>
           <span class="tarjeta__fecha">'.$estado.': '.(substr($row_posts['fecha_publicacion'], 0,10)).'</span>
       </div>
   </div>';