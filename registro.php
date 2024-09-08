<?php

include 'config.php'; // incluir a conexão com banco de dados, iniciar sessão 

if(isset($_POST['submit'])){

// escapa caracteres especiais para evitar injeção SQL e protege os dados do usuário + hash de senha
   $nome = mysqli_real_escape_string($conn, $_POST['nome']);
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $senha = mysqli_real_escape_string($conn, md5($_POST['senha']));
   $csenha = mysqli_real_escape_string($conn, md5($_POST['csenha']));

   // obter dados da imagem
   $image = $_FILES['imagem']['name'];
   $image_size = $_FILES['imagem']['size'];
   $image_tmp_name = $_FILES['imagem']['tmp_name'];
   $image_pasta = 'imagensUpload/'.$image;

   // verificar se o email já foi cadastrado
   $select = mysqli_query($conn, "SELECT * FROM `user-formulario` WHERE email = '$email'") or die('falha');

   if(mysqli_num_rows($select) > 0){
      $message[] = 'Email já cadastrado'; 
   }else{
      if($senha != $csenha){    // verificar as senhas
         $message[] = 'As senhas não coincidem';
      }elseif($image_size > 2000000){
         $message[] = 'Imagem é muito grande';
      }else{  // inserir os dados no banco
         $insert = mysqli_query($conn, "INSERT INTO `user-formulario`(nome, email, senha, imagem) VALUES('$nome', '$email', '$senha', '$image')") or die('query failed');

         if($insert){  // mover a imagem fornecida para a pasta de upload
            move_uploaded_file($image_tmp_name, $image_pasta);
            $message[] = 'Registro concluído!';
            header('location:login.php');  // redirecionar
         }else{
            $message[] = 'Registro falhou!'; // mensagem de erro
         }
      }
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Registro</title>

   <link rel="stylesheet" href="css/style.css">

</head>
<body>

<header>
   <h2> Tela de Registro </h2>
   <ul>
      <li>Item X</li>
      <li>Item Y</li>
   </ul>
</header>

<div class="formulario-container">

   <form action="" method="post" enctype="multipart/form-data">
      <h3>Registre-se</h3>
      <?php
      if(isset($message)){
         foreach($message as $message){  // mensagem de erro ou sucesso
            echo '<div class="mensagem">'.$message.'</div>';
         }
      }                 // campos para o usuário preencher
      ?>   
      <input type="text" name="nome" placeholder="Nome" class="caixa" required>
      <input type="email" name="email" placeholder="Email" class="caixa" required>
      <input type="password" name="senha" placeholder="Senha" class="caixa" required>
      <input type="password" name="csenha" placeholder="Confirmar senha" class="caixa" required>
      <input type="file" name="imagem" class="caixa" accept="image/jpg, image/jpeg, image/png">
      <input type="submit" name="submit" value="Registrar-se" class="botao">
      <p>Já possui uma conta? <a href="login.php">Entrar</a></p>
   </form>

</div>

</body>
</html>