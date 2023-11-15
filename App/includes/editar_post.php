<form class="crearpub__form movLR" method="POST" action=<?php echo "functions/editar_posts.php?id_user=".$row['no_control']."&id_post=".$row_detalle['id']?> enctype="multipart/form-data">
    <h2 class="titulo-ventana"><b>Editar publicación</b></h2>

    <input type="file" id="myFile2" name="imagen">
    <label for="myFile2" ><div class="fileimage" id="myFileArea2"></div></label>

    <input type="textarea" class="tituloO" name="nombre_objeto" placeholder="Nombre del objeto" required>

    <input type="date" class="fecha" name="fecha" required><br>

    <input type="radio" class="perdido" id="perdido" name="estatus" value="lost"required>
    <label class="labperdido">Nuevo</label>

    <input type="radio" class="encontrado" id="encontrado" name="estatus" value="found"required>
    <label class="labencontrado">Usado</label><br>

    <textarea class="descripcion" name="descripcion" placeholder="Descripción" required></textarea><br>

    <select class="categoria" name="categoria" required>
        <option value="" disabled selected>Categoría</option>
        <option value="Electronicos">Electronicos</option>
        <option value="Ropa">Ropa</option>
        <option value="Otros">Otros</option>
    </select>
    <select class="ubicacion" name="ubicacion" required>
        <option value="" disabled selected>Ubicación</option>
        <option value="Ed. F">Ed. F</option>
        <option value="Ed. G">Ed. G</option>
        <option value="Ed. D">Ed. D</option>
        <option value="Ed. P">Ed. P</option>
        <option value="Ed. E">Ed. E</option>
        <option value="Ed. B">Ed. B</option>
        <option value="Ed. C">Ed. C</option>
        <option value="Ed. M">Ed. M</option>
        <option value="Ed. T">Ed. T</option>
        <option value="Ed. R">Ed.   R</option>
        <option value="Biblioteca">Biblioteca</option>
        <option value="Gimnasio">Gimnasio</option>
        <option value="Lab. Métodos">Lab. Métodos</option>
        <option value="Lab. Computo">Lab. Computo</option>
        <option value="Cafeteria">Cafeteria</option>
        <option value="Explanada">Explanada</option>
        <option value="Ed. Admin">Ed. Admin</option>
    </select><br>

    <button type="submit" class="publicar" name="actualizarPost">Publicar</button>
    <button class="cerrar"><img src="assets/icons/equis.svg" id="cerrar_modal"></button>
</form>