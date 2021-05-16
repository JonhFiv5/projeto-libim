<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta charset="utf-8">
        <title>Cadastro de Funcionário</title>
        <link rel="icon" href="../img/favicon.png" type="image/png">
        <link rel="stylesheet" href="../css/estilo.css">
        <!-- CSS only -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">
    </head>

    <body background="../img/bgLivros.png" class="fundo">
        <?php
            /* Comente as linhas abaixo e acesse o endereço 
            * /projeto-libim/login/form_cadastro_funcionario.php
            * para adicionar um novo usuário sem estar logado
            */
            require_once '../validar_sessao.php';
            require_once '../mensagens.php';
        ?>
            <div class="container">
            <form action="cadastra_funcionario.php" method="post">
                <div class="row">
                    <div class="col">
                        <label for="nome">Nome</label>
                        <input class="form-control" type="text" name="txtnome" placeholder="ex: Maria Silva" id="nome" autocomplete="off" required>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <label for="usuario">Usuário</label>
                        <input class="form-control" type="text" name="txtusuario" placeholder="ex: maria.silva" id="usuario" autocomplete="off" required>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <label for="senha">Senha</label>
                        <input class="form-control" style="color: #000;" placeholder="ex: 12345678" type="password" name="txtsenha" id="senha" required>
                    </div>
                </div>

                <hr style="color: #fff;">
                <label class="centro-texto text-start">Nível de acesso</label>
                <div class="row">
                    <div class="col-3">
                        <label class="form-check-label text-start" for="comum">Comum</label>
                    </div>
                </div>
                <div class="row">
                    <div class="col-3">
                        <input class="form-check-input" type="radio" name="nivel_acesso" id="comum" value="2" checked="checked">                    
                    </div>
                </div>
                <div class="row">
                    <div class="col-3">
                        <label class="form-check-label text-start" for="adm">Administrador</label>
                    </div>
                </div>
                <div class="row">
                    <div class="col-3">
                        <input class="form-check-input" type="radio" name="nivel_acesso" id="adm" value="1">
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-sm-12 col-md-6 col-lg-6 mt-2">
                        <input type="submit" value="CADASTRAR USUÁRIO" class="btn btn-primary botaoEnviar">
                    </div>
                    <div class="col-sm-12 col-md-6 col-lg-6 mt-2">
                        <input type="button" value="VOLTAR AO MENU" onclick="location.href='../home'" class="btn btn-primary botaoEnviar">
                    </div>
                </div>
            </form>
        </div>
    </body>
</html>