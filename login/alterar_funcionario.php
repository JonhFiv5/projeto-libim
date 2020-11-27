<!DOCTYPE html>
<html lang="pt-br">
    <head>
    <title>Atualizar Funcionário</title>
    <meta charset="UTF-8">
    <meta charset="utf-8">
    <link rel="icon" href="../img/favicon.png" type="image/png">
    <link rel="stylesheet" href="../css/estilo.css">
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

        <form action="atualiza_funcionario.php?id=<?php echo $id;?>" method="post">

            <label for="nome">Nome</label>
            <input type="text" name="txtnome" id="nome" autocomplete="off" 
            value="<?php echo $nome;?>" required>

            <br><br>

            <label for="usuario">Usuário</label>
            <input type="text" name="txtusuario" id="usuario" autocomplete="off"
            value="<?php echo $usuario;?>" required>

            <br><br>

            <label for="senha">Senha</label>
            <input style="color: #000;" type="password" name="txtsenha" id="senha" required>

            <div class="escolha_acesso">
                <p>Nível de acesso</p>
                <input type="radio" name="nivel_acesso" id="comum" value="2" 
                <?php echo $acesso == 2 ? 'checked':'unchecked';?>>
                <label for="comum">Comum</label><br>

                <input type="radio" name="nivel_acesso" id="adm" value="1"
                <?php echo $acesso == 1 ? 'checked':'unchecked';?>>
                <label for="adm">Administrador</label>
            </div>
            
            <div id="botao">
                <input type="submit" value="ALTERAR USUÁRIO" class="botaoEnviar">
                <input type="button" value="VOLTAR AO MENU" onclick="location.href='../home'" class="botaoEnviar">
            </div>

        </form>

    </body>
</html>