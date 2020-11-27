<?php 
session_start();
if (isset($_SESSION['titulo_livro'])) {
    unset($_SESSION['titulo_livro']);
}

header('Location: form_incluir_livros.php');
?>