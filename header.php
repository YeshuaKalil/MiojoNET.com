<!--Modelo do Cabeçalho e Navegação para todas as páginas-->
<div id="header"> <!--Cabeçalho-->
    <div id="logo">
      <a href="index.php"><img id="logoimg" src="imagens/logo_provisoria.jpeg"></a>
    </div>
    <div id="nav"> <!--Navegação-->
      <ul>
        <li><a href="index.php">Início</a></li>
        <li><a href="mvc_game.php">Miojo vs Cup Noodles</a></li>
        <li><a href="mvc_lore.php">História</a></li>
        <li><a href="mvc_record.php">Recordações</a></li>
        <li><a href="mvc_about.php">Sobre nós</a></li>
        <li><a href="mvc_profile.php"><?php echo $nome; ?> <img class="imgP" src="<?php echo $img;?>" alt=""></a></li> 
        <!--Com php, são visualizados o nome e foto de perfil do usuário conectado-->
      </ul>
    </div>
  </div>