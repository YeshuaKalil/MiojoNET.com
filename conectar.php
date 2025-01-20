<?php // Configurar banco de dados
$endereco = "localhost"; // Endereço do servidor
$usuario = "root";        // Nome do usuário
$senha = "";              // Senha do usuário
$banco = "MVC";   // Nome do banco de dados *
$conn = new mysqli($endereco, $usuario, $senha, $banco) or die("Erro de conexão com BD."); // Conectar ao banco
$conn->set_charset('utf8mb4'); // charset
?>