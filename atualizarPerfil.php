<?php

include 'config.php';
session_start();
$user_id = $_SESSION['user_id'];

if(isset($_POST['atualizarPerfil'])){

   $atualizarNome = mysqli_real_escape_string($conn, $_POST['atualizarNome']);
   $atualizarEmail = mysqli_real_escape_string($conn, $_POST['atualizarEmail']);

   mysqli_query($conn, "UPDATE `user-formulario` SET nome = '$atualizarNome', email = '$atualizarEmail' WHERE id = '$user_id'") or die('falha');

   $senhaAntiga = $_POST['senhaAntiga'];
   $atualizarSenha = mysqli_real_escape_string($conn, md5($_POST['atualizarSenha']));
   $novaSenha = mysqli_real_escape_string($conn, md5($_POST['novaSenha']));
   $confirmarSenha = mysqli_real_escape_string($conn, md5($_POST['confirmarSenha']));

   if(!empty($atualizarSenha) || !empty($novaSenha) || !empty($confirmarSenha)){
      if($atualizarSenha != $senhaAntiga){
         $message[] = 'A senha antiga não coincide!';
      }elseif($novaSenha != $confirmarSenha){
         $message[] = 'As senhas não coincidem!';
      }else{
         mysqli_query($conn, "UPDATE `user-formulario` SET senha = '$confirmarSenha' WHERE id = '$user_id'") or die('falha');
         $message[] = 'Senha atualizada!';
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
</body>
</html>