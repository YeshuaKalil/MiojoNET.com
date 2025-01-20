<?php
include_once 'conectar.php';
session_start();
if (!isset($_SESSION['id'])) {
    header("Location: mvc_enter.php");
}
$nome = $_SESSION['nome'];
$email = $_SESSION['email'];
$img = $_SESSION['img'];
?>

<!DOCTYPE html>
<html lang="pt_BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="estilos/mvc_main.css">
  <link rel="stylesheet" href="estilos/mvc_game.css">
  <link rel="stylesheet" href="estilos/mvc_media.css">
  <title>MiojoNET</title>
</head>

<body>
  
<!--Início de toda página-->
<?php include_once 'header.php'; ?>
<!--*********************-->

    <div id="sectionRow" name="sectionRow">
    <div id="mot"><img src="imagens/motimg.gif"><p>Imagem motivacional.</p></div>
    <div id="jogo"><p>Clique no General para jogar</p><p>👇</p><button id="game_btn" onclick="script()">( ͡° ᴗ ͡°)</button></div>
        <script>
        function script() {var newTag = document.createElement('iframe');
// Set the content of the new element
document.getElementById('sectionRow').removeChild(document.getElementById('jogo'));
newTag.src  = 'gamecode/game_screen.php';
newTag.id = 'jogo';
newTag.allowtransparency = 'true';
newTag.frameborder = '0';
newTag.scrolling = 'no';
newTag.allowfullscreen = 'true';
// Append the new element to the parent

document.getElementById('sectionRow').insertBefore(newTag, document.getElementById('sectionRow').children[1]);}</script>
        <div id="controles">
            <h1 class="title">Controles</h1>
            <p>A, W, S, D - Mover General</p>
            <p>Setas ⬆ ⬇ ⬅ ⮕ - Mover Câmera</p>
            <p>Barra de espaço - Pular/Atirar</p>
            <p>Ponteiro do Mouse - Atacar</p>
            <p>(*Atacar/Fase Bônus)</p>
        </div>
    </div>
    <div id="footer">
      <p>Não filiado a marca Nissin</p>
      <p>Site desenvolvido por Ricardo Yeshua Cavalcante Kalil e Lucas de Carvalho Araújo Domingos</p>
    </div>
</body>
</html>
