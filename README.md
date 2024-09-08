# Aplicação simples em PHP para demonstração 

## Resumo breve  📌
Aqui será mostrado as funcionalidades mais básicas envolvendo PHP e MySQL, como o upload de imagens, registro e login de usuário e atualização dos dados.

## 📝 Requerimentos

> IDE de sua escolha (VScode, PhpStorm..)
>
> Banco de Dados (MySQL, PostgreSQL..)
>
> Linguagem PHP
> 
> Ferramenta de hospedagem (Apache, Nginx, LiteSpeed..)
>
> 
🤝 Dica: O XAMPP, além de oferecer MySQL e PHP numa única instalação, também fornece um servidor Apache. 

## 🏗️ Preparação do ambiente e tratamento de erros

Depois que tudo estiver devidamente instalado, crie sua pasta em C:/xampp/htdocs e comece os trabalhos.

![Imagem do WhatsApp de 2024-09-08 à(s) 15 23 00_3e1ae62c](https://github.com/user-attachments/assets/30f91a98-ad8d-44ab-b9f4-ca79ecf5cac9)

### Em caso deste seguinte erro:

```
 'Cannot validate the php file. The php program was not found'
```

Vá até 'Variáveis de Ambiente' em seu computador e adicione o seguinte Path de usuário:

![image](https://github.com/user-attachments/assets/471d3276-6765-4f91-bac1-545d2934cfe3)

## 🧑‍🏫 Explicação

***config.php*** - Arquivo de configuração contendo a conexão com o banco de dados.

***registro.php*** - Inclui um formulário de registro que coleta informações como nome, email, senha, confirmação de senha e uma imagem. Após o envio do formulário, o sistema valida as entradas e armazena as informações em um banco de dados MySQL.

 - Verifica se o email já existe, se a senhas coincidem e se o tamanho da imagem está nos conformes

***login.php*** - Permite que os usuários se autentiquem com seu email e senha. Após a autenticação bem-sucedida, o usuário é redirecionado para a página inicial. Se a autenticação falhar, uma mensagem de erro é exibida.
 
 -  Inicia uma sessão para o usuário autenticado e armazena o ID do usuário na sessão.
 -  Verifica se o email e a senha fornecidos correspondem a um registro existente no banco de dados.

***home.php*** - Após o login, o usuário é redirecionado para esta página onde pode visualizar seu perfil, atualizar suas informações ou sair da sessão.

***atualizarPerfil.php*** - Os usuários podem atualizar seu nome, email, senha e imagem de perfil. O código inclui a lógica para verificar e atualizar essas informações no banco de dados.
 
#### Pastas

'css' - Todas as estilizações utilizadas.

'imagensUpload' - Local onde as imagens enviadas são armazenadas.

### 📚 Observações

- Comentários no código da aplicação foram adicionados para um melhor entendimento
- Esta é APENAS uma demonstração, uma real aplicação PHP exige uma maior organização

