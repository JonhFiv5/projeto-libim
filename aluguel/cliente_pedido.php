<script type="text/javascript" src="../javascript/validar.js"></script>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta charset="utf-8">
        <title>Pedido</title>
        <link rel="icon" href="../img/favicon.png" type="image/png">
        <link rel="stylesheet" href="../css/estilo.css">
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

        <form action="inicia_novo_pedido.php" method="post">
            <h2>INICIAR PEDIDO</h2>
            <label for="cpftxt">Informe o CPF do cliente:</label>
            
            <input id="cpftxt" type="text" name="txtcpf" autocomplete="off" 
            placeholder="ex: 123.456.789-10" required minlength="14" maxlength="14">

            <div id="botao">
                <input type="submit" value="ENVIAR" class="botaoEnviar">
                <input type="button" value="VOLTAR AO MENU" onclick="location.href='../home'" class="botaoEnviar">
            </div>
        </form>
    </body>
</html>