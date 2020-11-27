<?php
	session_start();
	require_once 'itemDAO.php';
	require_once '../livro/livroDAO.php';
	require_once 'pedidoDAO.php';

	$id_pedido = $_SESSION['id_pedido'];
	$id_livro = $_SESSION['id_livro'];

	$quantidade = addslashes($_POST['txtqtd']);

	$item = new ItemDao();
	$livro = new LivroDao();

	$item->cadastrar($id_livro, $id_pedido, $quantidade);
	$livro->atualizarEstoqueEsprestimo($id_livro, $quantidade);

	$pedido = new PedidoDao();
	$valor_total = $pedido->calcularValor($id_pedido);
	$pedido->atualizarValor($id_pedido, $valor_total);

	$_SESSION['sucesso'] = 'Livro adicionado ao pedido';
	$_SESSION['item'] = '';
	unset($_SESSION['titulo_livro']);
	header('Location: form_incluir_livros.php');
?>