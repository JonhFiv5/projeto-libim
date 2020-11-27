<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <title>Livros</title>
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
            <h2>BUSCAR LIVROS</h2>
            <label for="nome">DIGITE O NOME DO LIVRO</label>
            <input type=text name="nome" id="nome" autocomplete="off" placeholder="ex: Harry Potter">
            <div id="botao">
                <input type="submit" value="PESQUISAR" class="botaoEnviar">
                <input type="button" value="VOLTAR AO MENU" onclick="location.href='../home'" class="botaoEnviar">
            </div>
        </form>

        <table>
            <tr id="titulo">
                <td>ID Livro</td>
                <td>Nome</td>
                <td>Categoria</td>
                <td>Localização</td>
                <td>Estoque</td>
                <td>Valor</td>
                <td colspan="2">Ações</td>
            </tr>

            <?php
                require_once 'livroDAO.php';
                $livro = new LivroDAO();

                if (isset($_GET['id_del'])){
                    $id_del = addslashes($_GET['id_del']);
                    $livro->excluirRegistro($id_del);
                }

                $result = $livro->buscarDadosNome($nome);
                if (sizeof($result) > 0) {
                    foreach($result as $registro){
                        echo "<tr>";
                        echo "<td>".$registro['id_livros']."</td>";
                        echo "<td>".$registro['nome']."</td>";
                        echo "<td>".$registro['categoria']."</td>";
                        echo "<td>".$registro['localizacao']."</td>";
                        echo "<td>".$registro['qtde_estoque']."</td>";
                        echo "<td>R$ ".number_format($registro['valor'], 2, ',', ' ')."</td>";
                        echo '<td><a href="alterar_livro.php?id_up='.$registro['id_livros'].'">Editar</a>';
                        echo '<td><a href="lista_livros.php?id_del='.$registro['id_livros'].'">Excluir</a>';
                        echo "</tr>";
                    }
                }
                else {
                    echo "<tr>";
                    echo "<td colspan='7'>Nenhum livro cadastrado</td>";
                    echo "</tr>";
                }
            ?>
        </table>

    </body>
</html>