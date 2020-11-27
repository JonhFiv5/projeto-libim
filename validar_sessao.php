<?php 
session_start();
if (!isset($_SESSION['usuario'])){
    $_SESSION['aviso'] = "Você precisa estar logado no sistema.";
	header('Location: ../login');
}

?>