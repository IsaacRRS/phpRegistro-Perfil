<?php

include 'config.php'; // incluir a conexão com banco de dados, iniciar sessão 
session_start();
$user_id = $_SESSION['user_id']; // obter o ID da sessão atual

if(!isset($user_id)){   // Verifica se o usuário está logado; Se não estiver logado, redireciona para a página de login                       
   header('location:login.php');
};

if(isset($_GET['logout'])){ // Verifica se a URL contém um parâmetro 'logout', 
   unset($user_id);         // Se sim, desconecta o usuário, destruindo a sessão e redireciona para a página de login
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

      <?php   // Consulta ao banco de dados para obter as informações do usuário baseado no ID
         $select = mysqli_query($conn, "SELECT * FROM `user-formulario` WHERE id = '$user_id'") or die('falha');

         if(mysqli_num_rows($select) > 0){  // Obtém os dados do usuário como um array associativo
            $fetch = mysqli_fetch_assoc($select);
         }
         if($fetch['imagem'] == ''){  // Exibe a imagem do perfil do usuário; Caso não haja, exibe a padrão
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