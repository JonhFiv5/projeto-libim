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
        <!-- CSS only -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">
    </head>

    <body background="../img/bgLivros.png" class="fundo">

 <?php
    if(isset($_POST['cpf']) && isset($_POST['cpf']) != "" ){
        $cpf = addslashes($_POST['cpf']);
    }
?>
        <div class="container">
            <form method="post">
                <h2>DEVOLVER LIVRO(S)</h2>
                <div class="row">
                    <div class="col">
                        <label for="cpf">Informe o CPF do cliente:</label>
                        <input id="cpf" type="text" name="cpf" autocomplete="off" placeholder="ex: 123.456.789-10" required minlength="14" maxlength="14">
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 col-md-6 col-lg-6 mt-2">
                        <input type="submit" value="BUSCAR" class="botaoEnviar">
                    </div>
                    <div class="col-sm-12 col-md-6 col-lg-6 mt-2">
                        <input type="button" value="VOLTAR AO MENU" onclick="location.href='../home'" class="botaoEnviar">
                    </div>
                </div>
            </form>
            <div style="overflow-x:auto;">
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
            </div>
        </div>
    </body>
</html>