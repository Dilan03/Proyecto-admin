<?php
if(isset($_POST["register"])) {
   $serverName = "localhost:3306";
   $userName = "root";
   $password = "root";
   $dbName = "found_it";
    
   //crear conexion 
   $conn = mysqli_connect($serverName, $userName, $password, $dbName);

   $curp = $_POST["curp"];
   $first_name = $_POST["first_name"];
   $last_name = $_POST["last_name"];
   $email = $_POST["email"];

   $foto = $_FILES['foto']['tmp_name'];
   $foto_name = $_FILES['foto']['name'];
   $foto = base64_encode(file_get_contents(addslashes($foto)));

   $password = $_POST["password"];
   $confirm_password = $_POST["confirm_password"];
   $phone = $_POST["phone"];

   $duplicate = mysqli_query($conn, "SELECT nombre, correo FROM usuarios WHERE nombre = '$first_name' OR correo = '$email'");
   if(mysqli_num_rows($duplicate) > 0) {
        echo 
        "<script> alert('El nombre o el correo ya han sido utilizados')</script>";
   } else {
        if($password == $confirm_password) {
            $query = "CALL InsertarUsuario('$curp', '$first_name', '$last_name', '$email', '$password', '$foto', '$phone', 0);";
            mysqli_query($conn, $query);
            echo "<script> alert('Registro exitoso!!')</script>";
         } else {
         echo "<script> alert('Las contraseñas no coinciden')</script>";
      }
   }

}
function displayImage() {
   global $conn;
   $sql = "SELECT foto FROM usuarios";
   $data = mysqli_query($conn, $sql);
    while($row = mysqli_fetch_assoc($data)) {
      echo '<img src=data:image;base64,'.$row['foto'].' alt="profilepic"/>';
   }
}