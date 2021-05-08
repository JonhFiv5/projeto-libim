<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
    <title>Menu</title>
    <link rel="icon" href="../img/favicon.png" type="image/png">
    <link rel="stylesheet" href="../css/estilo.css">
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">
</head>
<?php require_once '../validar_sessao.php';?>
<body>

    <div class="container">
        <div class="box m-3">
            <h2>MENU LIBIM</h2>
            <div class="row">
                <div class="col-sm-12 col-md-8 offset-md-2 col-lg-6 offset-lg-3">
                    <input type="submit" value="CADASTRAR CLIENTE" onclick="window.location='../cliente/cadastro_cliente.php';">
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12 col-md-8 offset-md-2 col-lg-6 offset-lg-3">
                    <input type="submit" value="CONSULTAR CLIENTES" onclick="window.location='../cliente/mostrar_clientes.php';">
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12 col-md-8 offset-md-2 col-lg-6 offset-lg-3">
                    <input type="submit" value="CADASTRAR LIVRO" onclick="window.location='../livro/form_cadastro_livro.php';">
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12 col-md-8 offset-md-2 col-lg-6 offset-lg-3">
                    <input type="submit" value="CONSULTAR LIVROS" onclick="window.location='../livro/lista_livros.php';">
                </div>
            </div>
                <?php
                    if(isset($_SESSION['nivel']) && $_SESSION['nivel'] == '1') {
                        echo '<div class="row"><div class="col-sm-12 col-md-8 offset-md-2 col-lg-6 offset-lg-3"><input type="submit" value="CADASTRAR USUÁRIO" onclick="window.location=\'../login/form_cadastro_funcionario.php\';"></div></div>';
                        echo '<div class="row"><div class="col-sm-12 col-md-8 offset-md-2 col-lg-6 offset-lg-3"><input type="submit" value="CONSULTAR USUÁRIOS" onclick="window.location=\'../login/lista_funcionarios.php\';"></div></div>';
                    }
                ?>
            <div class="row">
                <div class="col-sm-12 col-md-8 offset-md-2 col-lg-6 offset-lg-3">
                    <input type="submit" value="EMPRESTAR" onclick="window.location='../aluguel/cliente_pedido.php';">
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12 col-md-8 offset-md-2 col-lg-6 offset-lg-3">
                    <input type="submit" value="DEVOLVER" onclick="window.location='../devolucao/livro_devolucao.php';">
                </div>
            </div>
        </div>
    </div>
</body>
</html>