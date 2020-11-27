<?php

Class Cliente{
    
    private $pdo;

    function __construct($dbname, $host, $user, $pass){
        
        try{
            $this->pdo = new PDO(
                "mysql:dbname=".$dbname.";host=".$host, $user, $pass
            );
        } catch (PDOException $e){
            echo "Erro no banco de dados ".$e->getMessage();
            exit();
        } catch (Exception $e){
            echo "Erro ".$e->getMessage();
            exit();
        }
    }

    public function buscarDados($cpf){
        $result = array();
        $sql = "SELECT c.id_clientes, c.nome, c.telefone, c.email, c.cpf, e.nome_rua, e.bairro, e.cidade, e.uf, c.numero_casa, e.cep, c.dados_adicionais_endereco 
                FROM tbl_clientes AS c INNER JOIN tbl_endereco AS e ON c.fk_endereco = e.id_endereco WHERE c.cpf LIKE :c ORDER BY c.id_clientes DESC;";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(":c", $cpf);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function buscarDadosPorID($id){
        $result = array();
        $sql = "SELECT c.id_clientes, c.nome, c.telefone, c.email, c.cpf, e.nome_rua, e.bairro, e.cidade, e.uf, c.numero_casa, e.cep, c.dados_adicionais_endereco 
                FROM tbl_clientes AS c INNER JOIN tbl_endereco AS e ON c.fk_endereco = e.id_endereco WHERE c.id_clientes = :i;";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(":i", $id);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    public function cadastrarCliente($nome, $telefone, $email, $cpf, $numero_casa, $dados_adicionais_endereco, $fk_endereco){
        // Antes de cadastrar verificar se já tem o email cadastrado
        $sql = "SELECT id_clientes FROM tbl_clientes WHERE email = :e OR cpf = :c";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(":e", $email);
        $stmt->bindValue(":c", $cpf);
        $stmt->execute();

        if ($stmt->rowCount() > 0){  // Email já existe
            return false;
        }else{
            $sql = "INSERT INTO tbl_clientes(nome, telefone, email, cpf, numero_casa, dados_adicionais_endereco, fk_endereco) VALUES(:n, :t, :e, :c, :nc, :dae, :ed)";
            $stmt = $this->pdo->prepare($sql);
            //Se dados adicionais estiverem vaioz, valor vira "nenhum"
            empty($dados_adicionais_endereco) ? $dados_adicionais_endereco = "Nenhum" : FALSE;

            $stmt->bindValue(":n", $nome);
            $stmt->bindValue(":t", $telefone);
            $stmt->bindValue(":e", $email);
            $stmt->bindValue(":c", $cpf);
            $stmt->bindValue(":nc", $numero_casa);
            $stmt->bindValue(":dae", $dados_adicionais_endereco);
            $stmt->bindValue(":ed", $fk_endereco);
            $stmt->execute();
            return true;
        }
    }

    public function atualizarCliente($id_clientes, $nome, $telefone, $email, $cpf, $numero_casa, $dados_adicionais_endereco, $fk_endereco){
        // Antes de atualizar verificar se colocou o mesmo email que outro usuário
        $sql = "SELECT id_clientes FROM tbl_clientes WHERE email = :e OR cpf = :c";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(":e", $email);
        $stmt->bindValue(":c", $cpf);
        $stmt->execute();

        if ($stmt->rowCount() > 1) {
            return false;
        }else{
            $sql = "UPDATE tbl_clientes SET nome = :n, telefone = :t, email = :e, cpf = :c, numero_casa = :nc, dados_adicionais_endereco = :dae, fk_endereco = :ed WHERE id_clientes=:i";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(":ed", $fk_endereco);
            $stmt->bindParam(":i", $id_clientes);
            $stmt->bindParam(":n", $nome);
            $stmt->bindParam(":t", $telefone);
            $stmt->bindParam(":e", $email);
            $stmt->bindParam(":c", $cpf);
            $stmt->bindParam(":nc", $numero_casa);
            $stmt->bindParam(":dae", $dados_adicionais_endereco);
            $stmt->execute();
            return true;
        }
    }

    public function excluirCliente($id){
        $sql = "DELETE FROM tbl_clientes WHERE id_clientes = :i";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(":i", $id);
        $stmt->execute();
    }

    public function buscarDadosParaPedido($cpf){
        $result = array();
        $sql = "SELECT c.id_clientes, c.nome, c.telefone, c.email, c.cpf, e.nome_rua, e.bairro, e.cidade, e.uf, c.numero_casa, e.cep, c.dados_adicionais_endereco 
                FROM tbl_clientes AS c INNER JOIN tbl_endereco AS e ON c.fk_endereco = e.id_endereco WHERE c.cpf = :c;";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(":c", $cpf);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }
}
?>