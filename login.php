<?php

include 'config.php';
session_start();

if(isset($_POST['submit'])){

   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $senha = mysqli_real_escape_string($conn, md5($_POST['senha']));

   $select = mysqli_query($conn, "SELECT * FROM `user-formulario` WHERE email = '$email' AND senha = '$senha'") or die('query failed');

   if(mysqli_num_rows($select) > 0){
      $row = mysqli_fetch_assoc($select);
      $_SESSION['user_id'] = $row['id'];
      header('location:home.php');
   }else{
      $message[] = 'email ou senha incorretos!';
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Login</title>

   <link rel="stylesheet" href="css/style.css">

</head>
<body>
<header>
   <h2> Tela de Login </h2>
   <ul>
      <li>Item X</li>
      <li>Item Y</li>
   </ul>
</header>
<div class="formulario-container">

   <form action="" method="post" enctype="multipart/form-data">
      <h3>Entrar</h3>
      <?php
      if(isset($message)){
         foreach($message as $message){
            echo '<div class="message">'.$message.'</div>';
         }
      }
      ?>
      <input type="email" name="email" placeholder="email" class="box" required>
      <input type="password" name="senha" placeholder="senha" class="box" required>
      <input type="submit" name="submit" value="Entrar " class="botao">
      <p>Não tem uma conta? <a href="registro.php">Registre-se</a></p>
   </form>

</div>

</body>
</html>