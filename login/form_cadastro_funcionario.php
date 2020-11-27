<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <title>Cadastro de Funcionário</title>
        <meta charset="utf-8">
        <link rel="icon" href="../img/favicon.png" type="image/png">
        <link rel="stylesheet" href="../css/estilo.css">
    </head>

    <body background="../img/bgLivros.png" class="fundo">
        <?php
           // require_once '../validar_sessao.php';
           // require_once '../mensagens.php';
            
        ?>
        <form action="cadastra_funcionario.php" method="post">

            <label for="nome">Nome</label>
            <input class="form-control" type="text" name="txtnome" placeholder="ex: Maria Silva" id="nome" autocomplete="off" required>

            <label for="usuario">Usuário</label>
            <input class="form-control" type="text" name="txtusuario" placeholder="ex: maria.silva" id="usuario" autocomplete="off" required>

            <label for="senha">Senha</label>
            <input class="form-control" style="color: #000;" placeholder="ex: 12345678" type="password" name="txtsenha" id="senha" required>

	        <label class="centro-texto">Nível de acesso</label>
            <label class="form-check-label" for="comum">Comum</label>
            <input class="form-check-input" type="radio" name="nivel_acesso" id="comum" value="2" checked="checked">
            <label class="form-check-label" for="adm">Administrador</label>

            <input class="form-check-input" type="radio" name="nivel_acesso" id="adm" value="1">
            

            <div id="botao">
                <input type="submit" value="CADASTRAR USUÁRIO" class="botaoEnviar">
                <input type="button" value="VOLTAR AO MENU" onclick="location.href='../home'" class="botaoEnviar">
            </div>

        </form>
    </body>
</html>