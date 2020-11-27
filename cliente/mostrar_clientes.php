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
</head>
<body>

<?php
    if(isset($_POST['cpf']) && $_POST['cpf'] != ""){
        $cpf = addslashes($_POST['cpf']);
    }else{
        $cpf = addslashes('%%');
    }
?>

    <section id="centro">
        <form method="POST">
            <h2>BUSCAR CLIENTES</h2>
            <label for="cpf">DIGITE O CPF</label>
            <input type=text name="cpf" id="cpf" autocomplete="off" placeholder="ex: 123.456.789-10">
            <div id="botao">
                <input type="submit" value="PESQUISAR" class="botaoEnviar">
                <input type="button" value="VOLTAR AO MENU" onclick="location.href='../home'" class="botaoEnviar">
            </div>
        </form>

        <table>
            <tr id="titulo">
                <td>Nome</td>
                <td>Telefone</td>
                <td>E-mail</td>
                <td>CPF</td>
                <td>Rua</td>
                <td>Bairro</td>
                <td>Cidade</td>
                <td>UF</td>
                <td>Nº Casa</td>
                <td>CEP</td>
                <td>Obs. Endereço</td>
                <td colspan=2>Opções</td>
            </tr>
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
        </table>
    </section>
</body>
</html>

<?php
    if(isset($_GET['id'])){
        $id = addslashes($_GET['id']);
        $cliente->excluirCliente($id);
        header("location: mostrar_clientes.php");
    }
?>
