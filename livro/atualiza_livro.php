<?php
session_start();
require_once 'livroDAO.php';

$id = addslashes($_GET['id']);

$nome = addslashes($_POST['txtnome']);
$categoria = addslashes($_POST['txtcategoria']);
$quantidade = addslashes($_POST['numquantidade']);
$local = addslashes($_POST['txtlocal']);
$valor = addslashes($_POST['numvalor']);

$livro = new LivroDao();
$livro->atualizar($id, $nome, $categoria, $local, $quantidade, $valor);
$_SESSION['sucesso'] = 'Livro atualizado.';
header('Location: lista_livros.php');
?>