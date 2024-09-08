<?php

include 'config.php';
session_start();
$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
};

if(isset($_GET['logout'])){
   unset($user_id);
   session_destroy();
   header('location:login.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Home</title>

    <link rel="stylesheet" href="css/style.css">

</head>
<body>

<header>
   <h2> Home </h2>
   <ul>
      <li>Item X</li>
      <li>Item Y</li>
   </ul>
</header>

<div class="container">

   <div class="perfil">
      <?php
         $select = mysqli_query($conn, "SELECT * FROM `user-formulario` WHERE id = '$user_id'") or die('falha');
         if(mysqli_num_rows($select) > 0){
            $fetch = mysqli_fetch_assoc($select);
         }
         if($fetch['imagem'] == ''){
            echo '<img src="images/imagemDefault.png">';
         }else{
            echo '<img src="imagensUpload/'.$fetch['imagem'].'">';
         }
      ?>
      <h3><?php echo $fetch['nome']; ?></h3>
      <a href="atualizarPerfil.php" class="botao">Atualizar perfil</a>
      <a href="home.php?logout=<?php echo $user_id; ?>" class="delete-botao">Logout</a>
      <p> <a href="login.php">Login</a>  <a href="registro.php">Registro</a></p>
   </div>

</div>

</body>
</html>