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
        <title>Devolução</title>
        <link rel="icon" href="../img/favicon.png" type="image/png">
        <link rel="stylesheet" href="../css/estilo.css">
    </head>

    <body background="../img/bgLivros.png" class="fundo">

 <?php
    if(isset($_POST['cpf']) && isset($_POST['cpf']) != "" ){
        $cpf = addslashes($_POST['cpf']);
    }
?>
    <form method="post">
        <h2>DEVOLVER LIVRO(S)</h2>
        <label for="cpf">Informe o CPF do cliente:</label>
            
        <input id="cpf" type="text" name="cpf" autocomplete="off" 
        placeholder="ex: 123.456.789-10" required minlength="14" maxlength="14">

        <div id="botao">
            <input type="submit" value="ENVIAR" class="botaoEnviar">
            <input type="button" value="VOLTAR AO MENU" onclick="location.href='../home'" class="botaoEnviar">
        </div>
    </form>

    <table>
        <tr id="titulo">
            <td>ID PEDIDO</td>
            <td>CLIENTE</td>
            <td>CPF</td>
            <td>VENCIMENTO</td>
            <td>VALOR TOTAL</td>
            <td>EMPRESTIMO</td>
        </tr>

        <?php
            //Realiza busca se CPF for inserido
            if(isset($_POST['cpf'])){  
                $dados = $devolucao->buscarPedidoCliente($cpf); 
                if(count($dados)>0){
                    for($i=0; $i < count($dados); $i++){
                        echo "<tr>";
                        foreach($dados[$i] as $k => $v){
                            echo "<td>".$v."</td>";
                        }
            ?>
                        <td><a href="item_devolucao.php?id_pedido=<?php echo $dados[$i]['id_pedido'];?>">
                        <?php echo($devolucao->buscarItemsDevolvidos($dados[$i]['id_pedido']) ? 'EM ANDAMENTO' : 'RETORNADO');?>
                        </a></td>
            <?php
                        echo "</tr>";
                    }
                }else{
                    echo "<center><p style='color:white;'>O CPF digitado nao possui nenhum pedido</p></center>";
                }
            }else{
                echo "<center><p style='color:white;'>Informe um CPF para visualizar os pedidos</p></center>";
            }
        ?>
    </table>
    </body>
</html>