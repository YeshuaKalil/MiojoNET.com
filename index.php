<?php
/*Configurações iniciais*/

include_once 'conectar.php'; //Conectar ao banco
session_start(); //Iniciar a sessão

if (!isset($_SESSION['id'])) { //Visualização de nav quando desconectado
    $nome = "Perfil";
    $img = "uploaded_img/low-profile.png";
}else{ //Visualização de nav quando conectado (Coletar informações úteis da sessão)
$nome = $_SESSION['nome'];
$img = $_SESSION['img'];}
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
    <div id="about"> <!--Caixa de texto-->
      <div class="title"> <!--Título-->
        Miojo Vs Cup Noodles
      </div>
      <div class="text"> <!--Conteúdo-->
        Miojo VS Cup Noodles é um jogo dedicado à speedrunners onde você deve correr o mais rápido o possível dos Cup Noodles e chegar na próxima fase e fazer tudo de novo, só que um pouco mais difícil, repetidamente.
      </div>
    </div>
    <img src="">
    <div id="game"> <!--Caixa de texto-->
      <div class="title"> <!--Título-->
        Jogar
      </div>
      <div class="text"> <!--Conteúdo-->
        Aqui está o link para acessar o jogo:
      </div>
      <a href="mvc_game.php"><button class="btn">Link</button></a> <!--Botão que redireciona para a página do jogo('mvc_game.php')-->
    </div>
  </div>
<!--***************************-->

<!--Rodapé-->
  <div id="footer">
    <p>Não filiado a marca Nissin</p>
    <p>Site desenvolvido por Ricardo Yeshua Cavalcante Kalil e Lucas de Carvalho Araújo Domingos</p>
  </div>
<!--******-->

</body>
</html>
<!--Fim da página-->
