<?php 
session_start();
require_once 'livroDAO.php';

$nome = addslashes($_POST['txtnome']);
$categoria = addslashes($_POST['txtcategoria']);
$quantidade = addslashes($_POST['numquantidade']);
$local = addslashes($_POST['txtlocal']);
$valor = addslashes($_POST['numvalor']);

$livro = new LivroDao();
$livro->cadastrar($nome, $categoria, $local, $quantidade, $valor);
$_SESSION['sucesso'] = 'Livro cadastrado.';
header('Location: form_cadastro_livro.php');
?>