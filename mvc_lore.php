<?php
/*Configurações iniciais*/
include_once 'conectar.php'; //Conectar ao banco
session_start(); //Iniciar sessão
if (!isset($_SESSION['id'])) { //Bloquear acesso geral
    header("Location: mvc_enter.php");
}
//Coletar informações úteis da sessão
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
  <link rel="stylesheet" href="estilos/mvc_lore.css">
  <link rel="stylesheet" href="estilos/mvc_media.css">
  <title>MiojoNET</title>
  <!--*********************-->
</head>

<body>
  
<!--Início de toda página-->
<?php include_once 'header.php'; ?>
<!--*********************-->

<!--Conteúdo principal da página-->
    <div id="section">
        
        <div id="about"> <!--Caixa de Texto-->
            <div class="lorecontainer">
            <!--Texto-->
             <div class="loretextcontainer left">
                <div class="text loretext">
                <div class="title">Sobre o Jogo</div>
                   <p class="about_us">'Miojo vs Cup Noodles' introduz a história de um ex-general do Reino dos Miojos que, em uma tentativa de recuperar o poder de sua nação, invade a base dos Cup Noodles ao julgar serem eles os responsáveis pela destruição da Panela Suprema, e consequentemente, pela queda dos Nissin Lámen.</p>
                </div>
             </div>
            <!--Espaço-->
             <div class="lorespace"></div>
            <!--Imagem-->
             <div class="loreimg right loreimg1"></div>
            </div>

            <div class="lorecontainer">
            <!--Texto-->
             <div class="loretextcontainer right">
                <div class="text loretext">
                <div class="title">General Meus Olhos</div>
                   <p class="about_us">Um bravo combatente. Patriota para fazer de tudo pela nação, rebelde para abandonar seu escudo. Virou desertor durante a guerra contra os Cup Noodles. Nunca revelou o motivo, e ninguém teve coragem de espalhar algum boato sequer. Buscou sempre a glória de sua raça, e exterminou as pragas mais agressivas. Nunca se conformou com a proximidade que os Cup Noodles tinham da fronteira. Sua promessa foi de exterminar essa praga também.</p>
                </div>
             </div>
            <!--Espaço-->
             <div class="lorespace"></div>
            <!--Imagem-->
             <div class="loreimg left loreimg2"></div>
            </div>

            <div class="lorecontainer">
            <!--Texto-->
             <div class="loretextcontainer left">
                <div class="text loretext">
                <div class="title">Cup Noodles</div>
                   <p class="about_us">Seres violentos e asquerosos. Seu único propósito é a guerra, e por isso, sua raça se encontra em miséria, em um confronto de animais por ambições egoístas e primitivas. Desde o ocorrido no templo, sua tribo avançava mais a cada dia sobre o território Nissin. As tropas dos miojos intensificaram a defesa nas fronteiras, mas não foi o suficiente para conter a invasão. Até o momento, o Reino Nissin é vítima de seu controle.</p>
                </div>
             </div>
            <!--Espaço-->
             <div class="lorespace"></div>
            <!--Imagem-->
             <div class="loreimg right loreimg3"></div>
            </div>

            <div class="lorecontainer">
            <!--Texto-->
             <div class="loretextcontainer right">
                <div class="text loretext">
                <div class="title">A Panela Suprema</div>
                   <p class="about_us">O núcleo do Reino Nissin. Durante muito tempo, foi a fonte do poder dos miojos. Sua energia não tem uma origem explicável, mas se inventaram muitas histórias sobre ela, algumas consideradas verdades por grande parte dos moradores do Reino.</p>
                </div>
             </div>
            <!--Espaço-->
             <div class="lorespace"></div>
            <!--Imagem-->
             <div class="loreimg left loreimg4"></div>
            </div>
        </div>
    </div>
<!--***********************-->

<!--Rodapé-->
    <div id="footer">
      <p>Não filiado a marca Nissin</p>
      <p>Site desenvolvido por Ricardo Yeshua Cavalcante Kalil e Lucas de Carvalho Araújo Domingos</p>
    </div>
<!--******-->
</body>
</html>
<!--Fim da página-->
