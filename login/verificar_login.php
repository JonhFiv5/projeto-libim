<?php 
session_start();

require_once 'funcionarioDAO.php';

$usuario = addslashes($_POST['txtusuario']);
$senha = addslashes($_POST['txtsenha']);

$funcionario = new FuncionarioDao();

$login_realizado = $funcionario->verificarLogin($usuario, $senha);

if ($login_realizado) {
    $_SESSION['usuario'] = $usuario;
    $_SESSION['nivel'] = $login_realizado;
    $_SESSION['id_usuario'] = $funcionario->buscarId($usuario);
    header('Location: ../home');
} else {
    $_SESSION['usuario'] = '';
    $_SESSION['aviso'] = 'Nome de usuário e/ou senha inválidos';
    header('Location: index.php');
}

?>