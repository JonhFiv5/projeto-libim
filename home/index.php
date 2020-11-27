<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
    <title>Menu</title>
    <link rel="icon" href="../img/favicon.png" type="image/png">
    <link rel="stylesheet" href="../css/estilo.css">
</head>
<?php require_once '../validar_sessao.php';?>
<body>

    <div class="container">
        <div class="box">
            <h2>MENU LIBIM</h2>
         <div class="box-menu">
            <input type="submit" value="CADASTRAR CLIENTE" onclick="window.location='../cliente/cadastro_cliente.php';"><br>
            <input type="submit" value="CONSULTAR CLIENTES" onclick="window.location='../cliente/mostrar_clientes.php';"><br>
            <input type="submit" value="CADASTRAR LIVRO" onclick="window.location='../livro/form_cadastro_livro.php';"><br>
            <input type="submit" value="CONSULTAR LIVROS" onclick="window.location='../livro/lista_livros.php';"><br>
            <?php
                if(isset($_SESSION['nivel']) && $_SESSION['nivel'] == '1') {
                    echo '<input type="submit" value="CADASTRAR USUÁRIO" onclick="window.location=\'../login/form_cadastro_funcionario.php\';"><br>';
                    echo '<input type="submit" value="CONSULTAR USUÁRIOS" onclick="window.location=\'../login/lista_funcionarios.php\';"><br>';
                }
            ?>
            <input type="submit" value="EMPRESTAR" onclick="window.location='../aluguel/cliente_pedido.php';"><br>
            <input type="submit" value="DEVOLVER" onclick="window.location='../devolucao/livro_devolucao.php';"><br>
        </div>
    </div>
   </div>
</body>
</html>