<?php
/*Configurações iniciais*/

include_once 'conectar.php'; //Conectar ao banco
session_start(); //Iniciar sessão

//Detectar conexão
if (!isset($_SESSION['id'])) {
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
        /*Fazer inscrição*/
        if (isset($_POST['submit'])) {
            //Pegar dados do formulário
            $signup_username = $_POST['signup_username'];
            $signup_email = $_POST['signup_email'];
            $signup_password = $_POST['signup_password'];
            $signup_confirm_password = $_POST['signup_confirm_password'];

            if ($signup_password == $signup_confirm_password) { //Checar se senhas coincidem
                $sql = "SELECT * FROM usuarios WHERE email = ?";
                $result = $conn->execute_query($sql, [$signup_email]);
                if (mysqli_num_rows($result) > 0) { //Verificar se email já existe no banco
                    echo "<div>Esse email já está sendo utilizado. Por favor, escolha outro.</div> <br>"; //Mensagem de erro: Email já existente
                    echo "<a href='javascript:self.history.back()'><button class='btn'>Voltar</button></a>"; //Retornar
                } else {
                    $signup_password = password_hash($signup_password, $algo, $options); //Criptografar senha
                    $sql = "INSERT INTO usuarios (nome, email, senha, img) VALUES (?, ?, ?, 'low-profile.png')";
                    $result = $conn->execute_query($sql, [$signup_username, $signup_email, $signup_password]);
                    if ($result) { //Usuário registrado
                        echo "<div>Usuário registrado com sucesso.</div> <br>";
                        echo "<a href='mvc_enter.php'><button class='btn'>Entrar</button></a>";
                    } else { //Erro ao registrar
                        echo "<div>Erro ao registrar usuário.</div> <br>";
                        echo "<a href='javascript:self.history.back()'><button class='btn'>Voltar</button></a>"; //Retornar
                    }
                }
            } else { //Mensagem de erro: Senhas não coincidem
                echo "<div>As senhas não coincidem.</div> <br>";
                echo "<a href='javascript:self.history.back()'><button class='btn'>Voltar</button></a>"; //Retornar
            }
        } else {
        ?>

            <div class="title">Inscrição</div> <!--Título-->
            <!--Formulário de inscrição-->
            <form action="#" method="post">
                <div class="loginField"><label for="signup_username">Nome de Usuário:</label> <!--Nome-->
                    <input class="input"  type="text" id="signup_username" name="signup_username" autocomplete="off" maxlength="20" required>
                </div>
                <div class="loginField"><label for="signup_password">Senha:</label> <!--Senha-->
                    <input class="input" type="password" id="signup_password" name="signup_password" autocomplete="off" maxlength="30" required>
                </div>
                <div class="loginField"><label for="signup_confirm_password">Confirmar Senha:</label> <!--Confirmar senha-->
                    <input class="input" type="password" id="signup_confirm_password" name="signup_confirm_password" autocomplete="off" maxlength="30" required>
                </div>
                <div class="loginField"><label for="signup_email">Email:</label> <!--Email-->
                    <input class="input" type="email" id="signup_email" name="signup_email" autocomplete="off" maxlength="60" required>
                </div>
                <div class="loginField"> <!--Botão de Inscrição-->
                    <input class="btn" type="submit" id="submit" name="submit" value="Criar" required>
                </div>
                <div><a href="mvc_enter.php">Já tem uma conta? Entre!</a></div> <!--Ir para a página de Login-->
            </form>
            <!--***********************-->

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