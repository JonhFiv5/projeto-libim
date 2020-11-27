<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <title>Funcionários</title>
        <meta charset="UTF-8">
        <meta charset="utf-8">
        <link rel="icon" href="../img/favicon.png" type="image/png">
        <link rel="stylesheet" href="../css/estilo.css">
    </head>

    <body background="../img/bgLivros.png" class="fundo">

        <?php
            require_once '../validar_sessao.php';
            require_once '../mensagens.php';

            if(isset($_POST['nome']) && $_POST['nome'] != ""){
                $nome = addslashes($_POST['nome']);
            }else{
                $nome = addslashes('%%');
            }
        ?>

        <form method="POST">
            <h2>BUSCAR FUNCIONÁRIOS</h2>
            <label for="nome">DIGITE O NOME DO FUNCIONÁRIO</label>
            <input type=text name="nome" id="nome" autocomplete="off" placeholder="ex: Maria Silva">
            <div id="botao">
                <input type="submit" value="PESQUISAR" class="botaoEnviar">
                <input type="button" value="VOLTAR AO MENU" onclick="location.href='../home'" class="botaoEnviar">
            </div>
        </form>

        <table>
            <tr id="titulo">
                <td>Nome</td>
                <td>Usuario</td>
                <td colspan="2">Ações</td>
            </tr>
            <?php
                include 'funcionarioDAO.php';
                $funcionario = new FuncionarioDao();

                require_once 'funcionarioDAO.php';

                if (isset($_GET['id_del'])){
                    $id_del = addslashes($_GET['id_del']);
                    $funcionario->excluirRegistro($id_del);
                    // header("Location: lista_funcionarios.php");
                }

                $result = $funcionario->buscarDadosNome($nome);
                if (sizeof($result) > 0) {
                    foreach($result as $registro){
                        echo "<tr>";
                        echo "<td>".$registro['nome']."</td>";
                        echo "<td>".$registro['login']."</td>";
                        echo '<td><a href="alterar_funcionario.php?id_up='.$registro['id_funcionarios'].'">Editar</a>';
                        echo '<td><a href="lista_funcionarios.php?id_del='.$registro['id_funcionarios'].'">Excluir</a>';
                        echo "</tr>";
                    }
                }
            ?>
        </table>

    </body>
</html>