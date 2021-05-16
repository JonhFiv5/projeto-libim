<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta charset="UTF-8">
        <title>Funcionários</title>
        <link rel="icon" href="../img/favicon.png" type="image/png">
        <link rel="stylesheet" href="../css/estilo.css">
        <!-- CSS only -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">
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

        <div class="container">
            <form method="POST">
                <h2>BUSCAR FUNCIONÁRIOS</h2>
                <div class="row">
                    <div class="col">
                        <label for="nome">DIGITE O NOME DO FUNCIONÁRIO</label>
                        <input type=text name="nome" id="nome" autocomplete="off" placeholder="ex: Maria Silva">
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 col-md-6 col-lg-6 mt-2">
                        <input type="submit" value="PESQUISAR" class="botaoEnviar">
                    </div>
                    <div class="col-sm-12 col-md-6 col-lg-6 mt-2">
                        <input type="button" value="VOLTAR AO MENU" onclick="location.href='../home'" class="botaoEnviar">
                    </div>
                </div>
            </form>

            <div style="overflow-x:auto;">
                <table class="table">
                    <thead>
                        <tr id="titulo">
                            <th>Nome</th>
                            <th>Usuario</th>
                            <th colspan="2">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
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
                    </tbody>
                </table>
            </div>
        </div>
    </body>
</html>