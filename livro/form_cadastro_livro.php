<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
    <title>Cadastro de Livro</title>
    <link rel="icon" href="../img/favicon.png" type="image/png">
    <link rel="stylesheet" href="../css/estilo.css">
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">
</head>

    <?php
        require_once '../validar_sessao.php';
        require_once '../mensagens.php';
    ?>
    
<body>
    <div class="container">
        <?php
            require_once '../validar_sessao.php';
            require_once '../mensagens.php';
        ?>
        <form action="cadastra_livro.php" method="post">
            <h2>CADASTRAR LIVRO</h2>
            <div class="row">
                <div class="col-sm-12 col-md-6 col-lg-6">
                    <label for="nome">Título</label>
                    <input type="text" name="txtnome" id="nome" placeholder="ex: Dom Casmurro" autocomplete="off" required>
                </div>
                <div class="col-sm-12 col-md-6 col-lg-6">
                    <label for="categoria">Categoria</label>
                    <input type="text" name="txtcategoria" id="categoria" placeholder="ex: Literatura Brasileira" autocomplete="off">
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12 col-md-6 col-lg-6">
                    <label for="quantidade">Quantidade em estoque</label>
                    <input type="number" name="numquantidade" placeholder="ex: 5" id="quantidade" min="0">
                </div>
                <div class="col-sm-12 col-md-6 col-lg-6">
                    <label for="local">Localização</label>
                    <input type="text" name="txtlocal" placeholder="ex: Corredor 5" id="local" autocomplete="off">
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12 col-md-6 col-lg-6">
                    <label for="valor">Valor</label>
                    <input type="number" name="numvalor" placeholder="ex: R$5,50" id="valor" min="1" step="0.05" required/>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-sm-12 col-md-6 col-lg-6 mt-2">
                    <input type="submit" value="CADASTRAR LIVRO" class="btn btn-primary botaoEnviar">
                </div>
                <div class="col-sm-12 col-md-6 col-lg-6 mt-2">
                    <input type="button" value="VOLTAR AO MENU" onclick="location.href='../home'" class="btn btn-primary botaoEnviar">
                </div>
            </div>
        </form>
    </div>
</body>
</html>