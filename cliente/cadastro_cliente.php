<script type="text/javascript" src="../javascript/validar.js"></script>

<?php
require_once '../validar_sessao.php';
require_once '../mensagens.php';
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
    <title>Cadastro cliente</title>
    <link rel="stylesheet" href="../css/estilo.css">
    <link rel="icon" href="../img/favicon.png" type="image/png">
</head>
<body>
<?php
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
            if(!$cliente->cadastrarCliente($nome,$telefone,$email,$cpf,$numero_casa,$dados_adicionais_endereco,$fk_endereco)){
                $_SESSION['aviso'] = 'E-mail ou CPF já está cadastrado.';
                header('Location: cadastro_cliente.php');
            }else{
                $_SESSION['sucesso'] = 'Cadastro realizado com sucesso!';
                header('Location: cadastro_cliente.php');
            }
        }else{
            //Se for endereço novo, recebe o ultimo ID (endereço criado) e anexa ao cliente.
            $fk_endereco = $endereco->getUltimoIdEndereco();
            if(!$cliente->cadastrarCliente($nome,$telefone,$email,$cpf,$numero_casa,$dados_adicionais_endereco,$fk_endereco)){
                $_SESSION['aviso'] = 'E-mail ou CPF já está cadastrado.';
                header('Location: cadastro_cliente.php');
            }else{
                $_SESSION['sucesso'] = 'Cadastro realizado com sucesso!';
                header('Location: cadastro_cliente.php');
            }
        }
    }
?>
    <section id="centro">
        <form method="POST">
            <h2>CADASTRAR CLIENTE</h2>
            <label for="nome">Nome</label>
            <input type=text name="nome" id="nome" pattern="[a-zA-Zãõ'-éáóíâêôçÇñÑ ]{2,100}" required title="Apenas letras" placeholder="ex: João da Silva">

            <label for="telefone">Telefone</label>
            <input type=text name="telefone" id="telefone" pattern=".{13,14}" required title="DDD e Numero requerido" placeholder="ex: (11)91234-5678">

            <label for="email">Email</label>
            <input type=email name="email" id="email" required placeholder="ex: cliente@xyz.com" autocomplete="off">

            <label for="cpf">CPF</label>
            <input type=text name="cpf" id="cpf" pattern=".{14,14}" required title="11 números" autocomplete="off" placeholder="ex: 123.456.789-10">

            <label for="uf">UF (ESTADO)</label>
            <input type=text name="uf" id="uf" pattern=".{2,2}" required title="2 Letras" placeholder="ex: SP">

            <label for="cidade">Cidade</label>
            <input type=text name="cidade" id="cidade" required placeholder="ex: São Paulo">

            <label for="bairro">Bairro</label>
            <input type=text name="bairro" id="bairro" placeholder="ex: Boa Vista">

            <label for="nome_rua">Nome da Rua</label>
            <input type=text name="nome_rua" id="nome_rua" placeholder="ex: Rua das Flores">

            <label for="cep">CEP</label>
            <input type=text name="cep" id="cep" pattern=".{8,8}" required title="8 números" placeholder="ex: 12345678">

            <label for="numero_casa">Numero da Casa</label>
            <input type=text name="numero_casa" pattern=".{1,10}" id="numero_casa" required title="10 digitos max" placeholder="ex: 200">

            <label for="dados_adicionais_endereco">Dados adicionais do Endereço</label>
            <input type=text name="dados_adicionais_endereco" id="dados_adicionais_endereco" placeholder="Opcional">
            
            <div id="botao">
                <input type="submit" value="CADASTRAR CLIENTE" class="botaoEnviar">
                <input type="button" value="VOLTAR AO MENU" onclick="location.href='../home'" class="botaoEnviar">
            </div>

        </form>
    </section>
</body>
</html>