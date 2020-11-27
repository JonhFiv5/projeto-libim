<script type="text/javascript" src="../javascript/validar.js"></script>

<?php
require_once '../validar_sessao.php';
require_once '../mensagens.php';
require_once 'class/classe_cliente.php';
require_once 'class/classe_endereco.php';
$cliente = new Cliente("livrimdb","localhost","root","");
$endereco = new Endereco("livrimdb","localhost","root","");

function verificar($k,$v){
    //Verifica se o valor de uma chave existe, se existir retorna o valor.
    echo(isset($k[$v]) ? $k[$v] : 'Valor não encontrado');
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
    <title>Atualizar cliente</title>
    <link rel="stylesheet" href="../css/estilo.css">
    <link rel="icon" href="../img/favicon.png" type="image/png">
</head>
<body>
<?php

    if(isset($_GET['id_up'])){
        $id_update = addslashes($_GET['id_up']);
        $res = $cliente->buscarDadosPorID($id_update);
    }

    if(isset($_POST['nome'])){
        $nome = addslashes($_POST['nome']);
        $telefone = addslashes($_POST['telefone']);
        $email = addslashes($_POST['email']);
        $cpf = addslashes($_POST['cpf']);
        $numero_casa = addslashes($_POST['numero_casa']);
        $dados_adicionais_endereco = addslashes($_POST['dados_adicionais_endereco']);
        $uf = addslashes($_POST['uf']);
        $cidade = addslashes($_POST['cidade']);
        $bairro = addslashes($_POST['bairro']);
        $nome_rua = addslashes($_POST['nome_rua']);
        $cep = addslashes($_POST['cep']);

        if(!$endereco->cadastrarEndereco($uf,$cidade,$bairro,$nome_rua,$cep)){
            //Se o endereço já tiver cadastrado, conecta o ID do cliente com o FK_Endereço já existente.
            $fk_endereco = $endereco->conectarIdEndereco($uf,$cidade,$bairro,$nome_rua,$cep);
            if(!$cliente->atualizarCliente($id_update, $nome, $telefone, $email, $cpf, $numero_casa, $dados_adicionais_endereco, $fk_endereco)){
                $_SESSION['aviso'] = 'E-mail ou CPF já está cadastrado.';
                header('Location: atualizar_cliente.php?id_up='.$_GET['id_up']);
            }else{
                $_SESSION['sucesso'] = 'Dados atualizados com sucesso!';
                header('Location: atualizar_cliente.php?id_up='.$_GET['id_up']);
            }
        }else{
            //Se for endereço novo, recebe o ultimo ID (endereço criado) e anexa ao cliente.
            $fk_endereco = $endereco->getUltimoIdEndereco();
            if(!$cliente->atualizarCliente($id_update, $nome, $telefone, $email, $cpf, $numero_casa, $dados_adicionais_endereco, $fk_endereco)){
                $_SESSION['aviso'] = 'E-mail ou CPF já está cadastrado.';
                header('Location: atualizar_cliente.php?id_up='.$_GET['id_up']);
            }else{
                $_SESSION['sucesso'] = 'Dados atualizados com sucesso!';
                header('Location: atualizar_cliente.php?id_up='.$_GET['id_up']);
            }
        }
    }

?>
    <section id="centro">
        <form method="POST">
            <h2>ATUALIZAR CLIENTE</h2>
            <label for="nome">Nome</label>
            <input type=text name="nome" id="nome" pattern="[a-zA-Zãõ'-éáóíâêôçÇñÑ ]{2,100}" required title="Apenas letras"
            value="<?php verificar($res,'nome');?>" >

            <label for="telefone">Telefone</label>
            <input type=text name="telefone" id="telefone" pattern=".{13,14}" required title="DDD e Numero requerido" placeholder="ex: (11)91234-5678"
            value="<?php verificar($res,'telefone');?>" >

            <label for="email">Email</label>
            <input type=email name="email" id="email" required placeholder="ex: cliente@xyz.com" autocomplete="off"
            value="<?php verificar($res,'email');?>" >

            <label for="cpf">CPF</label>
            <input type=text style="background-color:#a3a3a3;" readonly name="cpf" id="cpf"  pattern=".{14,14}" required title="11 números" autocomplete="off" placeholder="ex: 123.456.789-10"
            value="<?php verificar($res,'cpf');?>" >

            <label for="uf">UF (ESTADO)</label>
            <input type=text name="uf" id="uf" pattern=".{2,2}" required title="2 Letras" placeholder="ex: RJ"
            value="<?php verificar($res,'uf');?>" >

            <label for="cidade">Cidade</label>
            <input type=text name="cidade" id="cidade" required
            value="<?php verificar($res,'cidade');?>" >

            <label for="bairro">Bairro</label>
            <input type=text name="bairro" id="bairro" required
            value="<?php verificar($res,'bairro');?>" >

            <label for="nome_rua">Nome da Rua</label>
            <input type=text name="nome_rua" id="nome_rua" required
            value="<?php verificar($res,'nome_rua');?>" >

            <label for="cep">CEP</label>
            <input type=text name="cep" id="cep" minlength="5" pattern=".{8,8}" required title="9 números" placeholder="ex: 12345678"
            value="<?php verificar($res,'cep');?>" >

            <label for="numero_casa">Numero da Casa</label>
            <input type=text name="numero_casa" id="numero_casa" pattern=".{1,10}" id="numero_casa" required title="10 digitos max"
            value="<?php verificar($res,'numero_casa');?>" >

            <label for="dados_adicionais_endereco">Dados adicionais do Endereço</label>
            <input type=text name="dados_adicionais_endereco" id="dados_adicionais_endereco"
            value="<?php verificar($res,'dados_adicionais_endereco');?>" >

            <div id="botao">
                <input type="submit" value="ATUALIZAR DADOS" class="botaoEnviar">
                <input type="button" value="VOLTAR AO MENU" onclick="location.href='../home'" class="botaoEnviar">
            </div>
    
        </form>
    </section>
</body>
</html>