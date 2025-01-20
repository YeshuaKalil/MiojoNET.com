<?php
/*Configurações iniciais*/

include_once 'conectar.php'; //Conectar ao banco
session_start(); //Iniciar sessão

if (!isset($_SESSION['id'])) { //Bloquear acesso geral
    $nome = "Perfil";
    $img = "uploaded_img/low-profile.png";
}else{
  header("Location: mvc_profile.php");
}

//Config Senha
$algo = PASSWORD_BCRYPT;
$options = ['cost' => 12];
?>

<!--Página-->
<!DOCTYPE html>
<html lang="pt_BR">
<head>
  <!--Título, links e meta-->
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="estilos/mvc_main.css">
  <link rel="stylesheet" href="estilos/mvc_media.css">
  <title>MiojoNET</title>
  <!--********************-->
</head>

<body>
  
<!--Início de toda página-->
<?php include_once 'header.php'; ?>
<!--*********************-->
  
<!--Conteúdo principal da página-->
    <div id="section">
        
        <div id="loginbox"> <!--Caixa de texto-->
        
        <?php

        /*Fazer Login*/
        if (isset($_POST['submit'])) {
            //Pegar dados do formulário
            $login_email = $_POST['login_email'];
            $login_password = $_POST['login_password'];

            //Acessar usuario requisitado
            $sql = "SELECT * FROM usuarios WHERE email = ?";
            $result = $conn->execute_query($sql, [$login_email]);
            //Verificar se usuario existe
            if (mysqli_num_rows($result) > 0) {
                //Pegar email e senha
                $row = mysqli_fetch_assoc($result);
                $email = $row['Email'];
                $senha = $row['Senha'];

                //Verificar se senha é válida
                if (password_verify($login_password, $senha)) {
                    // Verifica se o algoritmo ou o custo mudaram
                    if (password_needs_rehash($senha, $algo, $options)) {
                        // Caso positivo, cria um hash novo, e substitui o antigo
                        $newSenha = password_hash($password, $algorithm, $options);
                        // Atualiza o registro do usuário com $newSenha
                        $sql = "UPDATE usuarios SET senha = ? WHERE ?";
                        $result = $conn->execute_query($sql, [$newSenha, $email]);
                    }

                    //Criar variáveis da sessão
                    $_SESSION['id'] = $row['Id'];
                    $_SESSION['nome'] = $row['Nome'];
                    $_SESSION['email'] = $row['Email'];
                    $_SESSION['img'] = "uploaded_img/" .$row['Img'];
                    //Ir para a página do Perfil
                    header("Location: mvc_profile.php");
                
                } else { //Senha incorreta
                        echo "<div>Email ou senha incorretos.</div> <br>";
                        echo "<a href='javascript:self.history.back()'><button class='btn'>Voltar</button></a>"; //Retornar
                }
                    
            } else { //Email incorreto
                echo "<div>Email ou senha incorretos.</div> <br>"; 
                echo "<a href='javascript:self.history.back()'><button class='btn'>Voltar</button></a>"; //Retornar
            }
        
        } else{
        
        ?>

            <div class="title">Entrar</div> <!--Título-->
                <form action="#" method="post"> <!--Formulário de Login-->
                    <div class="loginField"><label for="login_email">Email:</label> <!--Email-->
                        <input class="input"  type="text" id="login_email" name="login_email" autocomplete="off" required>
                    </div>
                    <div class="loginField"><label for="login_password">Senha:</label> <!--Senha-->
                        <input class="input" type="password" id="login_password" name="login_password" autocomplete="off" required>
                    </div>
                    <div class="loginField"> <!--Entrar na conta-->
                        <input class="btn" type="submit" id="submit" name="submit" value="Entrar" required>
                    </div>
                    <div><a href="mvc_register.php">Não tem uma conta? Crie uma!</a></div> <!--Ir para a página de Inscrição-->
            </form>
            <?php } ?>
        </div>
    </div>
<!--****************************-->

<!--Rodapé-->
    <div id="footer">
      <p>Não filiado a marca Nissin</p>
      <p>Site desenvolvido por Ricardo Yeshua Cavalcante Kalil e Lucas de Carvalho Araújo Domingos</p>
    </div>
<!--******-->
</body>
</html>
<!--Fim da página-->