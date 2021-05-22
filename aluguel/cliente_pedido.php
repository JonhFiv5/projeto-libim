<script type="text/javascript" src="../javascript/validar.js"></script>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta charset="utf-8">
        <title>Pedido</title>
        <link rel="icon" href="../img/favicon.png" type="image/png">
        <link rel="stylesheet" href="../css/estilo.css">
        <!-- CSS only -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">

    </head>
    <body background="../img/bgLivros.png" class="fundo">
        
        <?php 
            require_once '../validar_sessao.php';
            require_once '../mensagens.php';
            if (isset($_SESSION['titulo_livro'])) {
                unset($_SESSION['titulo_livro']);
            }
            if (isset($_SESSION['item'])){
                unset($_SESSION['item']);
            }
        ?> 
        <div class="container">
            <form action="inicia_novo_pedido.php" method="post">
                <h2>INICIAR PEDIDO</h2>
                <div class="row">
                    <div class="col">
                        <label for="cpftxt">Informe o CPF do cliente:</label>
                        <input id="cpftxt" type="text" name="txtcpf" autocomplete="off" placeholder="ex: 123.456.789-10" required minlength="14" maxlength="14">
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 col-md-6 col-lg-6 mt-2">
                        <input type="submit" value="INICIAR" class="botaoEnviar">
                    </div>
                    <div class="col-sm-12 col-md-6 col-lg-6 mt-2">
                        <input type="button" value="VOLTAR AO MENU" onclick="location.href='../home'" class="botaoEnviar">
                    </div>
                </div>
            </form>
        </div>
    </body>
</html>