<?php
/*Configurações iniciais*/
include_once 'conectar.php'; //Conectar ao banco
session_start(); //Iniciar sessão
if (!isset($_SESSION['id'])) { //Bloquear acesso geral
    header("Location: mvc_enter.php");
}
//Coletar informações úteis da sessão
$nome = $_SESSION['nome'];
$email = $_SESSION['email'];
$img = $_SESSION['img'];
$id = $_SESSION['id'];

//Filtrar Recordações
$pressed = "Geral";
if (isset($_GET['pressed'])) {
    if ($_GET['pressed'] == "Geral" || $_GET['pressed'] == "Pessoal") {
    $pressed = $_GET['pressed'];
    }
}
?>

<!--Página-->
<!DOCTYPE html>
<html lang="pt_BR">
<head>
  <!--Título, links e meta-->
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="estilos/mvc_main.css">
  <link rel="stylesheet" href="estilos/mvc_record.css">
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
        <div id="optRecord"> <!--Filtrar Recordações-->
            <a href="mvc_record.php?pressed=Geral"><button id="Geral" class="Geral notselected" name="geral" onclick="PressedRed('Geral')">Geral</button></a>
            <a href="mvc_record.php?pressed=Pessoal"><button id="Pessoal" class="Pessoal" name="pessoal" onclick="PressedRed('Pessoal')">Pessoal</button></a>
        </div>

        <div id="addrecord"> <!--Adicionar Recordação-->
        <?php if($pressed == 'Pessoal'){echo '<a href="mvc_edit-view.php?idR=0"><div class="add"><p>+ Adicionar recordação</p></div></a>';}?>
        </div>

        <div id="allrecords"> <!--Mostrar Recordações-->

          <!--<div class="recordsc">
              <a href="mvc_edit.php"><img class="scimg" src="imagens/record_place.svg"></a>
              <p class="title">Recordação Nome</p>
              <div class="descRecord">
                 <button class="gostei" onclick="alert('Você gostou dessa recordação.')">❤️0</button><p class="text desc">NomeUsuário</p>
              </div>
          </div>-->

          <?php

          if ($pressed == "Geral") { //Selecionar Recordações Gerais
              $sql = "SELECT * FROM records WHERE Compartilhar = 1 order by Curtidas desc";
              $result = $conn->execute_query($sql);
              if (mysqli_num_rows($result) == 0) { //Caso não haja nenhuma recordação
                echo "<div class='recordsc'>";
                echo "<p class='center'>Nenhuma recordação encontrada</p>";
                echo "</div>";
              }
          }else{ //Selecionar Recordações Pessoais
          $sql = "SELECT * FROM records WHERE Idusuario = ?";
          $result = $conn->execute_query($sql, [$id]);
          if (mysqli_num_rows($result) == 0) { //Caso não haja nenhuma recordação
              echo "<div class='recordsc'>";
              echo "<p class='center'>Nenhuma recordação encontrada</p>";
              echo "</div>";
          }
          }

         
          /*Modelo de Capa de Recordação*/
        while ($row = mysqli_fetch_assoc($result)) {
            //Pegar informações necessárias sobre a recordação
            $idR = $row['Id'];
            $nomeR = $row['Nome'];
            $contentR = $row['Content'];
            $imgR = $row['Img']; //Capa não alterável (não sei ainda se é necessário)
            $imgR = "imagens/record_place.svg";
            $curtidas = $row['Curtidas'];
            $compartilhar = $row['Compartilhar'];
            $idU = $row['Idusuario'];
            $sql = "SELECT * FROM usuarios WHERE Id = ?";
            $resultU = $conn->execute_query($sql, [$idU]);
            $rowU = mysqli_fetch_assoc($resultU);
            $nomeU = $rowU['Nome'];
            $imgU = "uploaded_img/" .$rowU['Img'];
            $view = "mvc_edit-view.php?idR=$idR";

            if ($idU == $id) { //Exceção de Usuário
                $nomeU = "Você";
            }
            if ($nomeR == "") { //Exceção de Título
                $nomeR = "Recordação sem nome";
            }
            $titleR = $nomeR;
            if (strlen($nomeR) > 13) { //Limitar tamanho do Nome da Recordação
                $nomeR = substr($nomeR, 0, 13) . "...";
            }
            if (strlen($nomeU) > 8) { //Limitar tamanho do Nome do Usuário
                $nomeU = substr($nomeU, 0, 8) . "...";
            }
            if ($curtidas > 10*9-1) { //Limitar tamanho de Curtidas Bilhões
                $curtidas = number_format($curtidas/10**9, 1, ".", "") . "B";
    
            } else if ($curtidas > 10*6-1) { //Limitar tamanho de Curtidas Milhões
                $curtidas = number_format($curtidas/10**6, 1, ".", "") . "M";
    
            }  else if ($curtidas > 10*3-1) { //Limitar tamanho de Curtidas Milhares
                $curtidas = number_format($curtidas/10**3, 1, ".", "") . "K";
            }
            //Acho que não há necessidade de limitar trilhões no caso deste site.

            //Recordação montada
            echo "<div class='recordsc'>";
            echo "<a href=$view><img class='scimg' src='$imgR' title='$titleR'></a>";
            echo "<p class='title'>$nomeR</p>";
            echo "<div class='descRecord'>";
            echo "<button class='gostei'>❤️$curtidas</button><p class='text desc'>$nomeU <img class='imgP' src='$imgU' alt=''></p>";
            echo "</div>";
            echo "</div>";
        }
        ?>

        </div>
    </div>

<?php //Estilo do Filtro
echo '<script> 
function PressedRed(pressed) { 
  var allrecords = document.getElementById("allrecords");
  var addrecord = document.getElementById("addrecord");
  var actual = document.getElementsByClassName("notselected");
  actual[0].classList.remove("notselected")
  var element = document.getElementById(pressed);
  element.classList.add("notselected");
}
PressedRed("'.$pressed.'");
</script>';
?>

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
