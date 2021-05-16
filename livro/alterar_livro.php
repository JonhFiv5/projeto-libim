<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
    <title>Atualizar Livro</title>
    <link rel="icon" href="../img/favicon.png" type="image/png">
    <link rel="stylesheet" href="../css/estilo.css">
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">
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
<body>
    <div class="container">
        <form action="atualiza_livro.php?id=<?php echo $id;?>" method="post">
            <h2>ATUALIZAR LIVRO</h2>
            <div class="row">
                <div class="col-sm-12 col-md-6 col-lg-6">
                    <label for="nome">Título</label>
                    <input type="text" name="txtnome" id="nome" autocomplete="off" placeholder="ex: Dom Casmurro" required value="<?php echo $nome;?>">
                </div>
                <div class="col-sm-12 col-md-6 col-lg-6">
                    <label for="categoria">Categoria</label>
                    <input type="text" name="txtcategoria" id="categoria" placeholder="ex: Literatura Brasileira" autocomplete="off" value="<?php echo $categoria;?>">
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12 col-md-6 col-lg-6">
                    <label for="quantidade">Quantidade em estoque</label>
                    <input type="number" name="numquantidade" placeholder="ex: 5" id="quantidade" min="0" value="<?php echo $quantidade;?>">
                </div>
                <div class="col-sm-12 col-md-6 col-lg-6">
                    <label for="local">Localização</label>
                    <input type="text" name="txtlocal" id="local" placeholder="Corredor 5" autocomplete="off" value="<?php echo $local;?>">
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12 col-md-6 col-lg-6">
                    <label for="valor">Valor</label>
                    <input type="number" name="numvalor" id="valor" placeholder="ex: R$5,50" min="1" step="0.05" required value="<?php echo $valor;?>">
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-sm-12 col-md-6 col-lg-6 mt-2">
                    <input type="submit" value="ATUALIZAR" class="btn btn-primary botaoEnviar">
                </div>
                <div class="col-sm-12 col-md-6 col-lg-6 mt-2">
                    <input type="button" value="VOLTAR AO MENU" onclick="location.href='../home'" class="btn btn-primary botaoEnviar">
                </div>
            </div>
        </form>
    </div>
</body>
</html>