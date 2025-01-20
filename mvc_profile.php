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
$email = $_SESSION['email'];
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
  <link rel="stylesheet" href="estilos/mvc_profile.css">
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
        
        <div id="profile_box"><!--Caixa de texto-->

        <?php
        if (isset($_POST['submit'])) { //Salvar foto de perfil
            $img = $_FILES['myimg']['name'];
            $img_tmp = $_FILES['myimg']['tmp_name'];
            $query = "UPDATE usuarios SET img = ? WHERE id = ?";
            $result = $conn->execute_query($query, [$img, $id]); //Atualizar imagem no banco
            if ($result) {
                $_SESSION['img'] = "uploaded_img/" .$img; //Atualizar imagem na sessão
                move_uploaded_file($_FILES['myimg']['tmp_name'], "uploaded_img/$img"); //Salvar imagem no site
            }
            header("Location: mvc_profile.php");
        
        } else {
        ?>

            <!--Informações do Perfil-->
            <form id="imgsubmit" name="imgsubmit" action="#" method="post" enctype="multipart/form-data">
              <div class="leftP"><!--Caixa à esquerda-->
                <div class="title">Bem vindo, <b><?php echo $nome; ?></b>!</div> <!--Nome-->
                <p>Seu email é <b><?php echo $email; ?></b>.</p> <!--Email-->
              </div>
              <div class="rightP"> <!--Caixa à direita-->
                <img class="imgP view" src="<?php echo $img;?>" id="imgview" alt="" onclick="document.getElementById('myimg').click()"><br> <!--Foto de perfil-->
                <input type="file" id="myimg" accept="image/*" name="myimg" onchange="document.getElementById('imgview').src = window.URL.createObjectURL(this.files[0])" required> <!--Importador de imagens-->
                <p>Clique para alterar sua foto de perfil.</p> <!--Dica óbvia-->
              </div>
              <div class="belowP"> <!--Caixa abaixo-->
                <button type="submit" name="submit" id="submit" class="btn">Salvar</button> <!--Salvar Foto de Perfil-->
                <a href="logout.php"><button type="button" class="btn right">Sair</button></a> <!--Desconectar da conta/Encerrar sessão-->
              </div>
            </form>
            <!--*********************-->
    
            <?php
        }?>
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
