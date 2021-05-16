<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta charset="utf-8">
        <title>Atualizar Funcionário</title>
        <link rel="icon" href="../img/favicon.png" type="image/png">
        <link rel="stylesheet" href="../css/estilo.css">
        <!-- CSS only -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">
    </head>

    <?php 

    require_once '../validar_sessao.php';
    require_once 'funcionarioDAO.php';

    $funcionario = new funcionarioDao();
    $nome = "";
    $usuario = "";
    $acesso = 1;

    if (isset($_GET['id_up'])){
        $id = addslashes($_GET['id_up']);
        $registro = $funcionario->buscarPorCodigo($id);

        $nome = $registro['nome'];
        $usuario = $registro['login'];
        $acesso = $registro['nivel_acesso'];
    }

    ?>

    <body background="../img/bgLivros.png" class="fundo">
        <div class="container">

            <form action="atualiza_funcionario.php?id=<?php echo $id;?>" method="post">
                <div class="row">
                    <div class="col">
                        <label for="nome">Nome</label>
                        <input type="text" name="txtnome" id="nome" autocomplete="off" value="<?php echo $nome;?>" required>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <label for="usuario">Usuário</label>
                        <input type="text" name="txtusuario" id="usuario" autocomplete="off" value="<?php echo $usuario;?>" required>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <label for="senha">Senha</label>
                        <input style="color: #000;" type="password" name="txtsenha" id="senha" required>
                    </div>
                </div>
                <hr style="color: #fff;">
                <label class="centro-texto text-start">Nível de acesso</label>
                <div class="row">
                    <div class="col-3">
                        <label class="form-check-label text-start" for="comum">Comum</label><br>
                    </div>
                </div>
                <div class="row">
                    <div class="col-3">
                        <input class="form-check-input" type="radio" name="nivel_acesso" id="comum" value="2" <?php echo $acesso == 2 ? 'checked':'unchecked';?>>
                    </div>
                </div>
                <div class="row">
                    <div class="col-3">
                        <label class="form-check-label text-start" for="adm">Administrador</label>
                    </div>
                </div>
                <div class="row">
                    <div class="col-3">
                        <input class="form-check-input" type="radio" name="nivel_acesso" id="adm" value="1" <?php echo $acesso == 1 ? 'checked':'unchecked';?>>
                    </div>
                </div>
                
                <div class="row mt-3">
                    <div class="col-sm-12 col-md-6 col-lg-6 mt-2">
                        <input type="submit" value="ALTERAR USUÁRIO" class="btn btn-primary botaoEnviar">
                    </div>
                    <div class="col-sm-12 col-md-6 col-lg-6 mt-2">
                        <input type="button" value="VOLTAR AO MENU" onclick="location.href='../home'" class="btn btn-primary botaoEnviar">
                    </div>
                </div>

            </form>

        </div>

    </body>
</html>