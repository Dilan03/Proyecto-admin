<?php
    $queryComentarios = "SELECT c.id, c.id_post,u.foto, u.nombre, u.apellido, c.contenido, c.fecha_publicacion, u.curp FROM comentarios c 
    INNER JOIN usuarios u ON u.curp = c.id_autor ORDER BY c.fecha_publicacion DESC";
    $resultado_comenatios = mysqli_query($conn, $queryComentarios);

while($row_comenatrios = mysqli_fetch_array($resultado_comenatios)) {
    if (($row_comenatrios['id_post']) == $row_detalle['id']) {
        echo '<div class="user_1">
            <img class="options__user hideElement" src="assets/icons/user-box.svg">
            <span>
                <div class="profilepic">
                    <img src=data:image;base64,'.$row_comenatrios['foto'].' alt="profilepic"/>
                </div>
            </span>
            <div>
                <label class="comentario__usuario" for="usuario_1">'.$row_comenatrios['nombre'].' '.$row_comenatrios['apellido']; 
                if(!empty($_SESSION["id"])) {
                    if(($row['curp'] == $row_comenatrios['curp']) || ($row["id_rol"] == 1)) 
                    { 
                        echo '<a  class="borrar_comentario_btn" href="functions/borrar_comentarios.php?id='.$row_comenatrios['id_post'].'&id_comentario='.$row_comenatrios['id'].'"><img class="detalles_opt" src="assets/icons/bote-basura.svg"></a>';
                    } 
                }
                echo'</label><span style="color: gray; font-size: 14px;">  '.substr($row_comenatrios['fecha_publicacion'], 0,10).'</span><br>
                <p class="comentario__text">
                    '.$row_comenatrios['contenido'].'
                </p>
            </div>
        </div>';
    }
}