<?php
if(isset($_POST["loginn"])) {
   $email = $_POST["email"];
   $password = $_POST["password"];

   $sql = "SELECT * FROM usuarios WHERE correo = '$email'"; 
   $result = mysqli_query($conn,$sql);

   $row = mysqli_fetch_assoc($result);

   if(mysqli_num_rows($result) > 0) {
      if($password == $row["contraseña"]) {
         $_SESSION["login"] = true;
         $_SESSION["id"] = $row["curp"];
         header("Location: index.php");
      }
   } else {
      echo "<script> alert('Usuario no registrado')</script>";
   }

}