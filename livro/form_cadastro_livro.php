<!DOCTYPE html>
<html lang="pt-br">
<head>
    <title>Cadastro de Livro</title>
    <meta charset="UTF-8">
    <meta charset="utf-8">
    <link rel="icon" href="../img/favicon.png" type="image/png">
    <link rel="stylesheet" href="../css/estilo.css">
</head>

    <?php
        require_once '../validar_sessao.php';
        require_once '../mensagens.php';
    ?>
    
    <body background="../img/bgLivros.png" class="fundo">
        <?php
            require_once '../validar_sessao.php';
            require_once '../mensagens.php';
        ?>
        <form action="cadastra_livro.php" method="post">
            <h2>CADASTRAR LIVRO</h2>

            <label for="nome">Título</label>
            <input type="text" name="txtnome" id="nome" placeholder="ex: Dom Casmurro" autocomplete="off" required>

            

            <label for="categoria">Categoria</label>
            <input type="text" name="txtcategoria" id="categoria" placeholder="ex: Literatura Brasileira" autocomplete="off">

            

            <label for="quantidade">Quantidade em estoque</label>
            <input type="number" name="numquantidade" placeholder="ex: 5" id="quantidade" min="0">

            

            <label for="local">Localização</label>
            <input type="text" name="txtlocal" placeholder="ex: Corredor 5" id="local" autocomplete="off">

            

            <label for="valor">Valor</label>
            <input type="number" name="numvalor" placeholder="ex: R$5,50" id="valor" min="1" step="0.05" required/>

            

            <div id="botao">
                <input type="submit" value="CADASTRAR LIVRO" class="botaoEnviar">
                <input type="button" value="VOLTAR AO MENU" onclick="location.href='../home'" class="botaoEnviar">
            </div>
        </form>

    </body>
</html>