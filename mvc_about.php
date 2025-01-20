<?php
/*Configurações iniciais*/
include_once 'conectar.php'; //Conectar ao banco
session_start(); //Iniciar a sessão
if (!isset($_SESSION['id'])) { //Bloquear acesso geral
    header("Location: mvc_enter.php");
} //Coletar informações úteis da sessão
$nome = $_SESSION['nome'];
$img = $_SESSION['img'];
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
        <div id="refer"> <!--Caixa de texto-->
            <div class="title"> <!--Título-->
              Sobre nós
            </div>
            <div class="text"> <!--Conteúdo-->
                <p class="about_us">"Com o sucesso do jogo 'Miojo vs Cup Noodles', desenvolvido por mim e meus colegas Thiago Benjamim Lopes de Azevedo e Marcos Pedro Maciel Ramalho na plataforma Scratch, a jornada do General Meus Olhos se tornou de grande interesse por parte dos fãs da nova Saga em gênesis. Na ideia de criar um lugar que unisse esses fãs e fortalecesse o projeto, surgiu este site. Eu e Lucas esperamos permitir a construção de uma comunidade saudável de pessoas que, assim como nós, querem transformar um pequeno trabalho de escola sobre miojo em uma grande e graciosa história. Fique a vontade para fazer parte dela."
                </p>
                <p class="author">Ricardo Yeshua Cavalcante Kalil.
                </p>
            </div>
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
