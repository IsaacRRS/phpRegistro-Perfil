<?php

include 'config.php'; // incluir a conexão com banco de dados e iniciar sessão 
session_start();

if(isset($_POST['submit'])){ // verifica se o formulário foi enviado


   // Escapa caracteres especiais e protege contra injeção de SQL
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   // Hash da senha 
   $senha = mysqli_real_escape_string($conn, md5($_POST['senha']));
   // Consulta o banco de dados para verificar se o e-mail e senha correspondem a um usuário existente
   $select = mysqli_query($conn, "SELECT * FROM `user-formulario` WHERE email = '$email' AND senha = '$senha'") or die('falha');

   if(mysqli_num_rows($select) > 0){        // Verifica se algum usuário foi encontrado com os dados fornecidos
      $row = mysqli_fetch_assoc($select);   // caso encontre, obtém os dados, armazena o ID e o redireciona
      $_SESSION['user_id'] = $row['id'];
      header('location:home.php');
   }else{  // mensagem de erro
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
      if(isset($message)){  // mensagens de erro ou sucesso
         foreach($message as $message){
            echo '<div class="mensagem">'.$message.'</div>';
         }
      }                  // campos para o usuário preencher
      ?>  
      <input type="email" name="email" placeholder="email" class="caixa" required>
      <input type="password" name="senha" placeholder="senha" class="caixa" required>
      <input type="submit" name="submit" value="Entrar " class="botao">
      <p>Não tem uma conta? <a href="registro.php">Registre-se</a></p>
   </form>

</div>

</body>
</html>