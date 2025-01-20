<?php
session_start();
session_destroy();
header("Location: mvc_enter.php"); //Desconectar da conta
?>