<?php
/*Configurações iniciais*/

include_once 'conectar.php'; //Conectar ao banco
session_start(); //Iniciar sessão
if (!isset($_SESSION['id'])) { //Bloquear acesso geral
    header("Location: mvc_enter.php");
}
//Coletar informações úteis da sessão
$id = $_SESSION['id'];
$nome = $_SESSION['nome'];
$img = $_SESSION['img'];

//Pegar Id da Recordação
if (!isset($_GET['idR'])){
    header('Location: mvc_record.php');
} else{
    $idR = $_GET['idR'];
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
  <link rel="stylesheet" href="estilos/mvc_edit-view.css">
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


    <?php
    
    /*Pegar informações da Recordação*/
    $sql = 'SELECT * FROM records WHERE id = ?';
    $result = $conn->execute_query($sql, [$idR]);
    if ($row = $result->fetch_assoc()) {
        $nomeR = $row['Nome'];
        $content = $row['Content'];
        $curtidas = $row['Curtidas'];
        $compartilhar = $row['Compartilhar'];
        $idU = $row['Idusuario'];
        $sql = 'SELECT * FROM usuarios WHERE id = ?';
        $result = $conn->execute_query($sql, [$idU]);
        if ($row = $result->fetch_assoc()) {
            $nomeU = $row['Nome'];
            $emailU = $row['Email'];
        } else {
            header('Location: mvc_record.php');
        }
    } else {
        $idU = "";
        $nomeR = '';
        $content = '';
        $curtidas = 0;
        $compartilhar = 0;
    }

    /*Ir para a página de Edit ou View*/
    if ($id == $idU || $idU == "") {
        editR($nomeR, $content, $compartilhar); //Construir área Edit.php
    } else {
        if ($compartilhar == 0) { //Privado nunca será View
            header('Location: mvc_record.php');
        }
        viewR($nomeR, $content, $curtidas, $nomeU, $emailU); //Construir área View.php
    }

    /*Edit.php*/
    function editR($nomeR, $content, $compartilhar) {
        global $id, $idU, $idR, $conn; //Váriáveis gerais importantes
        if (isset($_POST['submit'])) { //Quando salvar ou deletar forem clicados
            if ($_POST['submit'] == 'deletar') {
                //Deletar recordação
                $sql = "DELETE FROM records WHERE id = ?; DELETE FROM curtidas WHERE idrecord = ?";
                $result = $conn->execute_query($sql, [$idR, $idR]);
                if ($result) {
                    header("Location: mvc_record.php");
                } else {
                    header("Location: mvc_edit-view.php?idR=$idR");
                }
            } else {
            //Salvar recordação
            $nomeR = $_POST['nome'];
            $content = $_POST['content'];
            if (isset($_POST['compartilhar'])) {
                $compartilhar = 1;
            } else {
                $compartilhar = 0;
            }
            if (strlen($content) > 3000) { //Checar tamanho da Recordação
                header("Location: mvc_edit-view.php?idR=$idR");
            }
            if ($idU == "") { //Criar uma nova recordação
                $sql = "INSERT INTO records (Nome, Content, Img, Curtidas, Compartilhar, Idusuario) VALUES (?, ?, '', 0, ?, ?)";
                $result = $conn->execute_query($sql, [$nomeR, $content, $compartilhar, $id]);
                if ($result) {
                    header("Location: mvc_record.php");
                } else {
                    header("Location: mvc_edit-view.php?idR=$idR");
                }
            } else { //Alterar uma recordação já existente
                $sql = "UPDATE records SET Nome = ?, Content = ?, Compartilhar = ? WHERE id = ?";
                $result = $conn->execute_query($sql, [$nomeR, $content, $compartilhar, $idR]);
                if ($result) {
                    header("Location: mvc_record.php");
                } else {
                    header("Location: mvc_edit-view.php?idR=$idR");
                }
            }

        }} else {
        ?>
        <!--Informações da Recordação-->
        <form id="recordR" name="recordR" action="#" method="post" onsubmit="if(document.getElementById('deletar').value=='deletar'){return confirm('Deseja mesmo deletar essa recordação?');}">
          <div class="loginField edit">
            <!--Título da Recordação-->
            <input type="text" class="input" name="nome" id="nome" placeholder="Nome da recordação" maxlength="40" value="<?php if($nomeR){echo $nomeR;} ?>">
          </div>
          <div id="record_place">
            <!--Conteúdo da Recordação-->
            <textarea id="record" name="content" placeholder="Escrever recordação..." maxlength="3000" required><?php if($content){echo $content;} ?></textarea>
          </div>
          <!--Informação Adicional-->
          <h3>*Limite máximo de 3000 caracteres.</h3>
          <!--Salvar Recordação-->
          <button class="btn" id="salvar" name="submit" type="submit">Salvar</button>
          <!--Compartilhar Recordação-->
          <div class="comp"><label for="compartilhar">Compartilhar</label>
            <input type="checkbox" id="compartilhar" name="compartilhar" <?php if($compartilhar == 1){echo "checked";} ?>>
          </div>
          <!--Voltar para a página de Recordações-->
          <button type="button" class="btn" id="cancelar" onclick="window.location.href='mvc_record.php'">Cancelar</button>
          <!--Deletar Recordação-->
          <button class="btn" id="deletar" name="submit" type="submit" onclick="document.getElementById('deletar').value = 'deletar';">Deletar</button>
        </form>
        <!--*************************-->

        <?php
        }
    }

    /*View.php*/
    function viewR($nomeR, $content, $curtidas, $nomeU, $emailU) {
        global $id, $idU, $idR, $conn; //Variáveis gerais importantes
        $sql = "SELECT * FROM curtidas WHERE idrecord = ? AND idusuario = ?"; 
        $resultC = $conn->execute_query($sql, [$idR, $id]); //Checar se recordação já foi curtida
        if (mysqli_num_rows($resultC) > 0) {
            $curtir = "❤️";
        } else {
            $curtir = "🤍";
            
        }
        if (isset($_POST['submit'])) { //Atualizar botão de Curtir
            if ($_POST['submit'] == 'curtir') {
                if ($curtir == "❤️") { //Descurtir
                    $sql = "DELETE FROM curtidas WHERE idrecord = ? AND idusuario = ?";
                    $result = $conn->execute_query($sql, [$idR, $id]);
                } else { //Curtir
                    $sql = "INSERT INTO curtidas (idrecord, idusuario) VALUES (?, ?)";
                    $result = $conn->execute_query($sql, [$idR, $id]);
                }
                $sql = "SELECT * FROM curtidas WHERE idrecord = ?";
                $result = $conn->execute_query($sql, [$idR]);
                $curtidas = mysqli_num_rows($result);
                $sql = "UPDATE records SET Curtidas = ? WHERE id = ?";
                $result = $conn->execute_query($sql, [$curtidas, $idR]); //Atualizar quantidade de curtidas
                header("Location: mvc_edit-view.php?idR=$idR");
            } else {
                header("Location: mvc_record.php");
            }            
        } else {
        ?>
        <!--Informações da Recordação-->
        <form id="recordR" action="#" method="post">
          <div class="loginField edit recordTitle">
            <!--Título da Recordação-->
            <input type="text" class="input" name="nome" id="nome" placeholder="Nome da recordação" value="<?php if($nomeR){echo $nomeR;} ?>" disabled>
            <!--Curtir Recordação-->
            <button id="curtir" name="submit" type="submit" value="curtir"><?php echo $curtir .$curtidas;?></button>
          </div>
          <div id="record_place">
            <!--Conteúdo da Recordação-->
            <textarea id="record" name="content" placeholder="Escrever recordação..." maxlength="3000" disabled><?php if($content){echo $content;} ?></textarea>
          </div>
          <!--Informação Adicional-->
          <h3>Feito por <?php echo $nomeU;?> - <?php echo $emailU;?></h3>
          <!--Voltar pra página das Recordações-->
          <button class="btn" id="salvar" name="submit" type="submit" value="voltar">Voltar</button>
        </form>
        <!--*************************-->

        <?php }
    }

    ?>

    </div>
<!--****************************-->

<!--Rodapé-->
    <div id="footer">
      <p>Não filiado a marca Nissin</p>
      <p>Site desenvolvido por Ricardo Yeshua Cavalcante Kalil e Lucas de Carvalho Araújo Domingos</p>
    </div>
<!--*******-->
</body>
</html>
<!--Fim da página-->