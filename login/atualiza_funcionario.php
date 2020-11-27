<?php 
session_start();
require_once 'funcionarioDAO.php';

$id = addslashes($_GET['id']);
$nome = addslashes($_POST['txtnome']);
$usuario = addslashes($_POST['txtusuario']);
$senha = PASSWORD_HASH(addslashes($_POST['txtsenha']), PASSWORD_DEFAULT);
$nivelAcesso = addslashes($_POST['nivel_acesso']);

$funcionario = new FuncionarioDao();

$atualizado = $funcionario->atualizar($id, $nome, $usuario, $senha, $nivelAcesso);

if ($atualizado){
    $_SESSION['sucesso'] = 'Usuário atualizado com sucesso!';
    header("Location: lista_funcionarios.php");
} else{
    $_SESSION['aviso'] = 'Erro, atualização não realizada.';
    header("Location: lista_funcionarios.php");
}

?>