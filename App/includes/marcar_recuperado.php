<form class="login-form eliminar_post movLR" method="POST">
    <h2 class="login-titulo">Objeto Vendido</h2>
    <div class="eliminar_botones">
       <button type="submit" class="login-button" name="recuperado">Confirmar
        
       </button>
       <button class="login-button">Cancelar</button>
    </div>

    <button class="cerrar"><img src="assets/icons/equis.svg" id="cerrar_modal"></button>
</form>

<?php echo $row_detalle['id']; 
    if(isset($_POST['recuperado'])){
        $serverName = "localhost:3306";
        $userName = "root";
        $password = "root";
        $dbName = "found_it";
            
        //crear conexion 
        $conn = mysqli_connect($serverName, $userName, $password, $dbName);

        if(isset($_GET['id'])) {
            $id_post = $_GET['id'];
         }
    
        $queryfound = "UPDATE etiquetas SET nombre = 'gathered' WHERE id_post = $id_post AND (nombre = 'lost' OR nombre = 'found')";
        mysqli_query($conn, $queryfound);

        echo "<meta http-equiv='refresh' content='0'>";
    }
?>