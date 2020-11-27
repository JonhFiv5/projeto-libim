<?php 
	session_start();
	require_once 'pedidoDAO.php';

	$dias = addslashes($_POST['dias']);
	$id_pedido = $_SESSION['id_pedido'];

	$data = date('d-m-Y');
	$vencimento = date('Y-m-d', strtotime("+".$dias." days",strtotime($data)));

	$pedido = new PedidoDao();
	$pedido->atualizarVencimento($id_pedido, $vencimento);
	$_SESSION['sucesso'] = 'Pedido registrado.';
	header('Location: resumo_pedido.php');
?>