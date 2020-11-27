<?php
session_start();
require_once '../cliente/class/classe_cliente.php';
require_once 'pedidoDAO.php';

$cpf = addslashes($_POST['txtcpf']);

$cliente = new Cliente("livrimdb","localhost","root","");

$resultado = $cliente->buscarDadosParaPedido($cpf);
if (empty($resultado)) {
    $_SESSION['aviso'] = 'O CPF informado não se encontra cadastrado em nosso banco de dados';
    header('Location: cliente_pedido.php');
} else{
    $_SESSION['nome'] = $resultado['nome'];
    $_SESSION['cpf'] = $resultado['cpf'];

    $pedido = new PedidoDao();

    $pedido->criarPedido($_SESSION['id_usuario'], $resultado['id_clientes']);
    
    $_SESSION['id_pedido'] = $pedido->pegarIdPedidoAtual();
    header('Location: form_incluir_livros.php');
}
?>