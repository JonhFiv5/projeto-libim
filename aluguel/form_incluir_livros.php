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

            $id_pedido = $_SESSION['id_pedido'];
            $nome = $_SESSION['nome'];
            $cpf = $_SESSION['cpf'];

            $form_livro = false;
            $titulo_livro = '';
            $valor = 0;
            $estoque = 0;

            if (isset($_SESSION['titulo_livro'])) {
                $form_livro = true;
                $titulo_livro = $_SESSION['titulo_livro'];
                $valor = $_SESSION['valor'];
                $estoque = $_SESSION['estoque'];
            }
        ?>

        <form action="busca_livro.php" method="post" style="<?php if ($form_livro) {echo 'display: none;';}?>" >
            <label for="id_livro">Informe o ID do livro desejado:</label>
            <input id="id_livro" type="number" name="id_livro" autocomplete="off" step="1" required>

            <div id="botao">
                <input type="submit" value="BUSCAR" class="botaoEnviar">
            </div>
            <?php 
                if (isset($_SESSION['item'])){
                    echo '<input type="button" value="FINALIZAR PEDIDO" onclick="window.location=\'concluir_pedido.php\'" class="botaoEnviar">';
                }
            ?>
        </form>


        <form action="incluir_livro.php" method="post" style="<?php if (!$form_livro) {echo 'display: none;';}?> ">
            <label for="txtlivro">Livro</label>
            <input type="text" id="txtlivro" value="<?php echo $titulo_livro;?>" readonly>

            <label for="txtvalor">Valor do aluguel</label>
            <input type="text" id="txtvalor" value="<?php echo $valor;?>" readonly>
            
            <label for="txtestoque">Estoque disponível</label>
            <input type="text" id="txtestoque" value="<?php echo $estoque;?>" readonly>

            <label for="txtqtd">Quantidade desejada</label>
            <input type="number" id="txtqtd" name="txtqtd" min="1" max="<?php echo $estoque;?>" required>

            <div id="botao">
                <input type="submit" value="ADICIONAR LIVRO" class="botaoEnviar">
                <input type="button" value="BUSCAR OUTRO LIVRO" onclick="window.location='cancela_item.php'" class="botaoEnviar">
            </div>
        </form>

        <form>
            <label for="txtidpedido">Número do pedido</label>
            <input type="text" id="txtidpedido" value="<?php echo $id_pedido;?>" readonly style="text-align: center">

            <label for="txtnome">Nome do cliente</label>
            <input type="text" id="txtnome" value="<?php echo $nome;?>" readonly style="text-align: center">
        
            <label for="txtcpf">Número de CPF:</label>
            <input type="text" id="txtcpf" value="<?php echo $cpf;?>" readonly style="text-align: center">
        </form>
    </body>
</html>