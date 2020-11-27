<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta charset="utf-8">
        <title>Livros do pedido</title>
        <link rel="icon" href="../img/favicon.png" type="image/png">
        <link rel="stylesheet" href="../css/estilo.css">
    </head>
    <body background="../img/bgLivros.png" class="fundo">
        <?php 
        require_once '../validar_sessao.php';
        require_once '../mensagens.php';
        ?>

        <form action="definir_vencimento_pedido.php" method="post">
            <label for="dias">Os livros serão alugados por quantos dias?</label>
            <input type="number" name="dias" id="dias" min="30" required>
            <div id="botao">
                <input type="submit" value="CONCLUIR PEDIDO" class="botaoEnviar">
            </div>
        </form>
    </body>
</html>