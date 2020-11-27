<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta charset="utf-8">
        <title>Resumo do pedido</title>
        <link rel="icon" href="../img/favicon.png" type="image/png">
        <link rel="stylesheet" href="../css/estilo.css">
    </head>
    <body background="../img/bgLivros.png" class="fundo">
        <?php 
        require_once '../validar_sessao.php';
        require_once '../mensagens.php';
        require_once 'pedidoDAO.php';

        $id_pedido = $_SESSION['id_pedido'];
        $nome = $_SESSION['nome'];
        $cpf = $_SESSION['cpf'];

        $pedido = new PedidoDao();
        $resultados = $pedido->pegarResumoPedido($id_pedido);
        $dados_pedido = $pedido->buscarPorCodigo($id_pedido);

        ?>
        <table>
            <tr id="titulo">
                <td>Nome</td>
                <td>Valor</td>
                <td>Quantidade</td>
            </tr>

            <?php
                if (sizeof($resultados) > 0) {
                    foreach($resultados as $registro){
                        echo "<tr>";
                        echo "<td>".$registro['nome']."</td>";
                        echo "<td>".$registro['valor']."</td>";
                        echo "<td>".$registro['qtde']."</td>";
                        echo "</tr>";
                    }
                    echo '<table>';
                        echo "<tr id=\"titulo\">";
                        echo "<td>Data de vencimento</td>";    
                        echo "<td>Valor Total</td>";    
                        echo "</tr>";
                        echo "<tr>";
                        echo "<td>".$dados_pedido['data_vencimento']."</td>";    
                        echo "<td>R\$".$dados_pedido['valor_total']."</td>";    
                        echo "</tr>";
                    echo "</table>";
                }
                else {
                    echo "<tr>";
                    echo "<td colspan='3'>Pedido Vazio</td>";
                    echo "</tr>";
                }
            ?>
        </table>
        
        <form style="background: rgba(0, 0, 0, 0);">
         <div id="botao">
            <input type="button" value="VOLTAR AO MENU" onclick="location.href='../home'" class="botaoEnviar">
         </div>
        </form>
    </body>
</html>