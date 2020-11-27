<script type="text/javascript" src="../javascript/validar.js"></script>

<?php
    require_once '../validar_sessao.php';
    require_once '../mensagens.php';
    require_once '../cliente/class/classe_cliente.php';
    require_once 'dao/devolucaoDAO.php';
    $devolucao = new DevolucaoDao();
?>


<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta charset="UTF-8">
        <title>Devolucao</title>
        <link rel="icon" href="../img/favicon.png" type="image/png">
        <link rel="stylesheet" href="../css/estilo.css">
    </head>

    <body background="../img/bgLivros.png" class="fundo">

<?php
    if(isset($_GET['id_pedido'])){
        $id_pedido = addslashes($_GET['id_pedido']);
        $dados = $devolucao->buscarItemsPedido($id_pedido);
        $dados_cliente = $devolucao->buscarDadosCliente($id_pedido);
    }

    if(isset($_POST['id_livro'])){
        $id_livro = addslashes($_POST['id_livro']);
        $qtd_livro = addslashes($_POST['qtd_livro']);
        $livro_existe = false;

        //Realiza funcao se o id do livro existir no pedido
        for($i=0; $i < count($dados); $i++){
            if($id_livro == $dados[$i]['id_livros']){
                $devolucao->realizarDevolucao($id_pedido, $id_livro, $qtd_livro);
                header("Refresh:0");
                $livro_existe = true;
            }
        }
        
        if($livro_existe == false){
            $_SESSION['aviso'] = "Insira um livro valido";
            header("Refresh:0");
        }
    }
?>

    <form method="post">
        <h2>ESCOLHA O(S) LIVRO(S)</h2>

        <div style="display: inline-block; width: 49.9%;">
        <label for="id_pedido">ID PEDIDO:</label>
        <input id="pedido" type="text" name="pedido" readonly value="<?php echo $id_pedido; ?>">
        </div>
        
        <div style="display: inline-block; width: 49%;">
        <label for="cliente">CLIENTE:</label>
        <input id="cliente" type="text" name="cliente" readonly value="<?php echo $dados_cliente['nome']; ?>">  
        </div>
        
        <div style="display: inline-block; width: 49.9%;">
        <label for="id_livro">ID LIVRO:</label>
        <input id="id_livro" type="text" name="id_livro" required pattern="[0-9]+">
        </div>
        
        <div style="display: inline-block; width: 49%;">
        <label for="qtd_livro">QUANTIDADE:</label>
        <input id="qtd_livro" type="text" name="qtd_livro" required pattern="[0-9]+">  
        </div>

        <div id="botao">
            <input type="submit" value="ENVIAR" class="botaoEnviar">
            <input type="button" value="VOLTAR" onclick="location.href='livro_devolucao.php'" class="botaoEnviar">
        </div>
    </form>

    <table>
    <tr id="titulo">
                <td>ID LIVRO</td>
                <td>NOME</td>
                <td>CATEGORIA</td>
                <td>LOCALIZACAO</td>
                <td>VALOR UNICO</td>
                <td>ALUGADO(S)</td>
                <td>DEVOLVIDO(S)</td>
            </tr>
        <?php
            if(count($dados)>0){
                for($i=0; $i < count($dados); $i++){
                    echo "<tr>";
                    foreach($dados[$i] as $k => $v){
                        echo "<td>".$v."</td>";
                    }
                    echo "</tr>";
                }
            }else{
                echo "<center><p style='color:white;'>Nenhum livro encontrado no pedido</p></center>";
            }
        ?>
    </table>
    </body>
</html>