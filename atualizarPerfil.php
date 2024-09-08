<?php

include 'config.php'; // incluir a conexão com banco de dados, iniciar sessão e então obter o ID da sessão atual
session_start();
$user_id = $_SESSION['user_id'];

if(isset($_POST['atualizarPerfil'])){  // caso o formulário for enviado..
   
   // obter dados..

   $atualizarNome = mysqli_real_escape_string($conn, $_POST['atualizarNome']);
   $atualizarEmail = mysqli_real_escape_string($conn, $_POST['atualizarEmail']);


   // atualizar nome e o email..
   mysqli_query($conn, "UPDATE `user-formulario` SET nome = '$atualizarNome', email = '$atualizarEmail' WHERE id = '$user_id'") or die('falha');



   // obter a senha antiga para então criar uma nova
   $senhaAntiga = $_POST['senhaAntiga'];
   $atualizarSenha = mysqli_real_escape_string($conn, md5($_POST['atualizarSenha']));
   $novaSenha = mysqli_real_escape_string($conn, md5($_POST['novaSenha']));
   $confirmarSenha = mysqli_real_escape_string($conn, md5($_POST['confirmarSenha']));


   // verificar se os campos estão preenchidos e realiza atualização da senha caso seja necessário
   if(!empty($atualizarSenha) || !empty($novaSenha) || !empty($confirmarSenha)){
      // verificar se senha antiga = senha armazenada
      if($atualizarSenha != $senhaAntiga){
         $message[] = 'A senha antiga não coincide!';
      }elseif($novaSenha != $confirmarSenha){
         $message[] = 'As senhas não coincidem!';
      }else{ // atualização da senha
         mysqli_query($conn, "UPDATE `user-formulario` SET senha = '$confirmarSenha' WHERE id = '$user_id'") or die('falha');
         $message[] = 'Senha atualizada!';
      }
   }
   // upload de uma nova imagem 
   $update_image = $_FILES['atualizarImagem']['name'];
   $update_image_size = $_FILES['atualizarImagem']['size'];
   $update_image_tmp_name = $_FILES['atualizarImagem']['tmp_name'];
   $update_image_folder = 'imagensUpload/'.$update_image;

   if(!empty($update_image)){   // verificar o preenchimento e o tamanho
      if($update_image_size > 2000000){
         $message[] = 'A imagem é muito grande';
      }else{   // atualiza a imagem e a move para a pasta de upload
         $image_update_query = mysqli_query($conn, "UPDATE `user-formulario` SET imagem = '$update_image' WHERE id = '$user_id'") or die('falha');
         if($image_update_query){
            move_uploaded_file($update_image_tmp_name, $update_image_folder);
         }
         $message[] = 'Imagem enviada!';
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
   <title>Atualizar Perfil</title>

   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<div class="atualizar-perfil">

   <?php  
      $select = mysqli_query($conn, "SELECT * FROM `user-formulario` WHERE id = '$user_id'") or die('falha');
      if(mysqli_num_rows($select) > 0){
         $fetch = mysqli_fetch_assoc($select);
      }
   ?>

   <form action="" method="post" enctype="multipart/form-data">
      <?php  // exibe imagem; caso não haja, irá exibir a imagem padrão
         if($fetch['imagem'] == ''){
            echo '<img src="imagens/imagemDefault.png">';
         }else{
            echo '<img src="imagensUpload/'.$fetch['imagem'].'">';
         }
         if(isset($message)){   // mensagens de erro ou sucesso
            foreach($message as $message){
               echo '<div class="mensagem">'.$message.'</div>';
            }
         }
      ?>
      <div class="flex">
         <div class="inputBox">   <!-- campos para o usuário preencher -->
            <span>Nome</span>
            <input type="text" name="atualizarNome" value="<?php echo $fetch['nome']; ?>" class="caixa">
            <span>Email</span>
            <input type="email" name="atualizarEmail" value="<?php echo $fetch['email']; ?>" class="caixa">
            <span>Foto</span>
            <input type="file" name="atualizarImagem" accept="image/jpg, image/jpeg, image/png" class="caixa">
         </div>
         <div class="inputBox">
            <input type="hidden" name="senhaAntiga" value="<?php echo $fetch['senha']; ?>">
            <span>Senha antiga</span>
            <input type="password" name="atualizarSenha" placeholder="Digite a senha antiga" class="caixa">
            <span>Nova senha</span>
            <input type="password" name="novaSenha" placeholder="Digite a nova senha" class="caixa">
            <span>Confirmar senha</span>
            <input type="password" name="confirmarSenha" placeholder="Confirme a nova senha" class="caixa">
         </div>
      </div>
      <input type="submit" value="Atualizar perfil" name="atualizarPerfil" class="botao">
      <a href="home.php" class="delete-botao">Voltar</a>
   </form>

</div>

</body>
</html>