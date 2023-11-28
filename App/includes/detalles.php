<div class="DetalleObjeto">
    <div class="rectangulo1">
        <div class="rectangulo2">
            <?php
                echo '<img width = 100% src=data:image;base64,'.$row_detalle['imagen'].' alt="profilepic"/>';
                
                $querydisponible = "SELECT disponible from posts WHERE id = $post_id AND disponible = 1";
                $resultadoDisponible = mysqli_query($conn, $querydisponible);
                
                if(mysqli_num_rows($resultadoDisponible) > 0) {
                    $permitir = false;
                }else {
                    $permitir = true;
                }
            ?>
        </div>
            <?php
                echo '
                    <div class="tarjeta__etiquetas">';
                    if (($row_detalle['ancient']) == 'ancient') {
                        echo '<div class="etiquetaEST etiquetaEST--ancient"><span>#Ancient</span></div>';
                    }
                    if (($row_detalle['found']) == 'found') {
                        echo '<div class="etiquetaEST etiquetaEST--found"><span>#USADO</span></div>';
                    }
                    if (($row_detalle['lost']) == 'lost') {
                        echo '<div class="etiquetaEST etiquetaEST--lost"><span>#NUEVO</span></div>';
                    }
                    if (($row_detalle['gathered']) == 'gathered') {
                        echo '<div class="etiquetaEST etiquetaEST--gathered"><span>#VENDIDO</span></div>';
                    }
                    echo '</div>'; 
                    ?>
    </div>
    <div class="rectangulo3">
        <section>
            <?php 
            if(!empty($_SESSION["id"])) {if((!empty($_SESSION["id"]) && ($row_detalle["id_autor"] == $_SESSION["id"]) && ($permitir))  || ($row["id_rol"] == 1 && ($permitir))) { ?>
                <i id="options_desplegable_llave_btn"><img class="detalles_opt" src="assets/icons/llave.svg"></i>
                <div class="options__desplegable-llave hideElement" id="options_desplegable_llave">
                    <a href="includes/eliminar_post.php?id=<?php echo $row_detalle['id'];?>" id="eliminar_post_btn"> Eliminar
                    </a>
                    <button id="editar_post_btn">Editar</button>
                    <a href="#" id="marcar_recuperado_btn">Vendido</a>
                </div>
            <?php } else { ?>
                    
            <?php }} ?>
                        
            <h2 class="titulo">
                <?php echo $row_detalle['nombre_objeto']?>
            </h2>
            <label for="encontrado" class="diaencontrado">
                <?php
                    if($row_detalle['found'] == 'found') echo 'Publicado';
                    elseif ($row_detalle['lost'] == 'lost') echo 'Publicado';
                ?> 
                el día <?php echo substr($row_detalle['fecha_publicacion'], 0,10)?></label>
            <br>
            <label for="descripcion" class="desc">Descripción</label>
            <p class="desc2"><?php echo $row_detalle['descripcion']?></p>
            <br>
            <label for="categoría" class="cat">Categoría</label>
            
            <label for="cat" class="cate"><?php echo $row_detalle['cat']?></label>
            
            <label for="ubi" class="ub">
                <?php
                    if($row_detalle['found'] == 'found') echo '';
                    elseif ($row_detalle['lost'] == 'lost') echo '';
                ?>
                en</label>
            <div class="rectangulo5">
                <label for="ubi" class="edificio"><?php echo $row_detalle['ubicacion']?></label>
            </div>
            <label for="encontro" class="encontro">Lo publicó
                <?php
                    if($row_detalle['found'] == 'found') echo '';
                    elseif ($row_detalle['lost'] == 'lost') echo '';
                ?>
            </label>
            <br>
            <p class="alumno"><?php echo $row_detalle['nombre']?> <?php echo $row_detalle['apellido']?></p>

            <div class="seccionBtn">
                <?php if(!empty($_SESSION["id"])) {?>
                <p class="pre">¿Es tuyo o sábes dónde está?</p>
                <button class="rectangulo4" onclick="redirectToWhatsApp()">
                    <span>Enviar mensaje</span> 
                    <img src="assets/icons/wasap.svg" alt="" class="was">
                </button>
                <?php } else {?>
                    <div class="button__login">
                        <a href="index.php" type="submit" class="boton boton__tarjeta boton__tarjeta--login">Iniciar sesión</a>
                    </div>
                <?php }?>
                <script>
        function redirectToWhatsApp() {
            var phoneNumber = "<?php echo $row_detalle['telefono']; ?>";
            var url = "https://wa.me/" + phoneNumber;

            window.open(url, "_blank");
        }
    </script>
                <?php
                    function conseguirnumeroBD() {
                        // Configurar la conexión a la base de datos
                        $serverName = "localhost:3306";
                        $userName = "root";
                        $password = "root";
                        $dbName = "found_it";
                        $telefono = $row_detalle['telefono']; // Obtener el número de teléfono desde la variable $row_detalle
                    }
                ?>
            </div>
        </section>
    </div>
</div>