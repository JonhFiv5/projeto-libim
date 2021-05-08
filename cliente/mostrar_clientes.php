<script type="text/javascript" src="../javascript/validar.js"></script>

<?php
require_once '../validar_sessao.php';
require_once 'class/classe_cliente.php';
require_once 'class/classe_endereco.php';
$cliente = new Cliente("livrimdb","localhost","root","");
$endereco = new Endereco("livrimdb","localhost","root","");
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
    <title>Mostrar clientes</title>
    <link rel="stylesheet" href="../css/estilo.css">
    <link rel="icon" href="../img/favicon.png" type="image/png">
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">
</head>
<body>

<?php
    if(isset($_POST['cpf']) && $_POST['cpf'] != ""){
        $cpf = addslashes($_POST['cpf']);
    }else{
        $cpf = addslashes('%%');
    }
?>

    <div class="container">
        <form method="POST">
            <h2>BUSCAR CLIENTES</h2>
            <div class="row">
                <div class="col">
                    <label for="cpf">DIGITE O CPF</label>
                    <input type=text name="cpf" id="cpf" autocomplete="off" placeholder="ex: 123.456.789-10">
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
                        <th>Telefone</th>
                        <th>E-mail</th>
                        <th>CPF</th>
                        <th>Rua</th>
                        <th>Bairro</th>
                        <th>Cidade</th>
                        <th>UF</th>
                        <th>Nº Casa</th>
                        <th>CEP</th>
                        <th>Obs. Endereço</th>
                        <th colspan=2>Opções</th>
                    </tr>
                </thead>
                <tbody>
            <?php
                $dados = $cliente->buscarDados($cpf);  //Realiza busca
                if(count($dados)>0){
                    for($i=0; $i < count($dados); $i++){
                        echo "<tr>";
                        foreach($dados[$i] as $k => $v){
                            if($k != "id_clientes"){
                                echo "<td>".$v."</td>";
                            }
                        }
            ?>
                        <td class="excluirEditar"><a href="atualizar_cliente.php?id_up=<?php echo $dados[$i]['id_clientes'];?>">Editar</a></td>
                        <td class="excluirEditar"><a href="mostrar_clientes.php?id=<?php echo $dados[$i]['id_clientes'];?>">Excluir</a></td>
            <?php
                        echo "</tr>";
                    }
                }else{
                    echo "<center><p style='color:white;'>Nada encontrado no banco de dados.</p></center>";
                }
            ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>

<?php
    if(isset($_GET['id'])){
        $id = addslashes($_GET['id']);
        $cliente->excluirCliente($id);
        header("location: mostrar_clientes.php");
    }
?>
