<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta charset="utf-8">
        <title>Livros do pedido</title>
        <link rel="icon" href="../img/favicon.png" type="image/png">
        <link rel="stylesheet" href="../css/estilo.css">
        <!-- CSS only -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">
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

        <div class="container">
            <form action="busca_livro.php" method="post" style="<?php if ($form_livro) {echo 'display: none;';}?>" >
                <div class="row">
                    <div class="col">
                        <label for="id_livro">Informe o ID do livro desejado:</label>
                        <input id="id_livro" type="number" name="id_livro" autocomplete="off" step="1" required>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col">
                        <input type="submit" value="BUSCAR" class="botaoEnviar">
                    </div>
                </div>
                <?php 
                    if (isset($_SESSION['item'])){
                        echo '<div class="row mt-3"><div class="col"><input type="button" value="FINALIZAR PEDIDO" onclick="window.location=\'concluir_pedido.php\'" class="botaoEnviar"></div></div>';
                    }
                ?>
            </form>


            <form action="incluir_livro.php" method="post" style="<?php if (!$form_livro) {echo 'display: none;';}?> ">
                <div class="row">
                    <div class="col">
                        <label for="txtlivro">Livro</label>
                        <input type="text" id="txtlivro" value="<?php echo $titulo_livro;?>" readonly>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <label for="txtvalor">Valor do aluguel</label>
                        <input type="text" id="txtvalor" value="<?php echo $valor;?>" readonly>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <label for="txtestoque">Estoque disponível</label>
                        <input type="text" id="txtestoque" value="<?php echo $estoque;?>" readonly>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <label for="txtqtd">Quantidade desejada</label>
                        <input type="number" id="txtqtd" name="txtqtd" min="1" max="<?php echo $estoque;?>" required>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-12 col-md-6 col-lg-6 mt-2">
                        <input type="submit" value="ADICIONAR LIVRO" class="botaoEnviar">
                    </div>
                    <div class="col-sm-12 col-md-6 col-lg-6 mt-2">
                        <input type="button" value="BUSCAR OUTRO LIVRO" onclick="window.location='cancela_item.php'" class="botaoEnviar">
                    </div>
                </div>
            </form>

            <form>
                <div class="row">
                    <div class="col">
                        <label for="txtidpedido">Número do pedido</label>
                        <input type="text" id="txtidpedido" value="<?php echo $id_pedido;?>" readonly style="text-align: center">
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <label for="txtnome">Nome do cliente</label>
                        <input type="text" id="txtnome" value="<?php echo $nome;?>" readonly style="text-align: center">
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <label for="txtcpf">Número de CPF:</label>
                        <input type="text" id="txtcpf" value="<?php echo $cpf;?>" readonly style="text-align: center">
                    </div>
                </div>
            </form>
        </div>
    </body>
</html>