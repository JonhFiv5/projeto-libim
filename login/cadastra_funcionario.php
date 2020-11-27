<?php 
session_start();
require_once 'funcionarioDAO.php';

$nome = addslashes($_POST['txtnome']);
$usuario = addslashes($_POST['txtusuario']);
$senha = PASSWORD_HASH(addslashes($_POST['txtsenha']), PASSWORD_DEFAULT);
$nivelAcesso = addslashes($_POST['nivel_acesso']);

$funcionario = new FuncionarioDao();

$cadastrado = $funcionario->cadastrar($nome, $usuario, $senha, $nivelAcesso);

if (!$cadastrado) {
    $_SESSION['aviso'] = 'Erro, usuário não pôde ser cadastrado.';
    header('Location: form_cadastro_funcionario.php');
} else{
    $_SESSION['sucesso'] = 'Cadastro realizado com sucesso!';
    header('Location: form_cadastro_funcionario.php');
}

?>