<!DOCTYPE html>
<html lang="pt-br">
<head>
    <title>Atualizar Livro</title>
    <meta charset="UTF-8">
    <meta charset="utf-8">
    <link rel="icon" href="../img/favicon.png" type="image/png">
    <link rel="stylesheet" href="../css/estilo.css">
</head>
    
    <?php 
    require_once '../validar_sessao.php';
    require_once 'livroDAO.php';

    $livro = new LivroDao();

    $nome = "";
    $categoria = "";
    $quantidade = 0;
    $local = "";
    $valor = "";

    if (isset($_GET['id_up'])){
        $id = addslashes($_GET['id_up']);
        $registro = $livro->buscarPorCodigo($id);

        $nome = $registro['nome'];
        $categoria = $registro['categoria'];
        $quantidade = $registro['qtde_estoque'];
        $local = $registro['localizacao'];
        $valor = $registro['valor'];
    }

    ?>
    <body background="../img/bgLivros.png" class="fundo">

        <form action="atualiza_livro.php?id=<?php echo $id;?>" method="post">

            <label for="nome">Título</label>
            <input type="text" name="txtnome" id="nome" autocomplete="off" placeholder="ex: Dom Casmurro" required
            value="<?php echo $nome;?>">

            <br><br>

            <label for="categoria">Categoria</label>
            <input type="text" name="txtcategoria" id="categoria" placeholder="ex: Literatura Brasileira" autocomplete="off"
            value="<?php echo $categoria;?>">

            <br><br>

            <label for="quantidade">Quantidade em estoque</label>
            <input type="number" name="numquantidade" placeholder="ex: 5" id="quantidade" min="0"
            value="<?php echo $quantidade;?>">

            <br><br>

            <label for="local">Localização</label>
            <input type="text" name="txtlocal" id="local" placeholder="Corredor 5" autocomplete="off"
            value="<?php echo $local;?>">

            <br><br>

            <label for="valor">Valor</label>
            <input type="number" name="numvalor" id="valor" placeholder="ex: R$5,50" min="1" step="0.05" required
            value="<?php echo $valor;?>">

            <br><br>

            <div id="botao">
                <input type="submit" value="ATUALIZAR" class="botaoEnviar">
                <input type="button" value="VOLTAR AO MENU" onclick="location.href='../home'" class="botaoEnviar">
            </div>
        </form>

    </body>
</html>