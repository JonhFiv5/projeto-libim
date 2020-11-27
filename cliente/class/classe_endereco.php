<?php

Class Endereco{
    
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

    public function buscarDados(){
        $result = array();
        $sql = "SELECT * FROM tbl_clientes ORDER BY id asc";
        $cmd = $this->pdo->query($sql);
        $result = $cmd->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function buscarDadosConectados(){
        $result = array();
        $sql = "SELECT * FROM tbl_endereco WHERE id_endereco = :i";
        $cmd = $this->pdo->query($sql);
        $result = $cmd->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function cadastrarEndereco($uf,$cidade,$bairro,$nome_rua,$cep){
        $sql = "SELECT id_endereco FROM tbl_endereco WHERE uf = :uf AND cidade = :cd AND bairro = :ba AND nome_rua = :nm AND cep = :cep";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(":nm", $nome_rua);
        $stmt->bindValue(":cep", $cep);
        $stmt->bindValue(":ba", $bairro);
        $stmt->bindValue(":cd", $cidade);
        $stmt->bindValue(":uf", $uf);
        $stmt->execute();

        if ($stmt->rowCount() > 0){  // Endereço existe
            return false;
        }else{
            $sql = "INSERT INTO tbl_endereco(uf,cidade,bairro,nome_rua,cep) VALUES(:uf, :cd, :ba, :nm, :cep)";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(":nm", $nome_rua);
            $stmt->bindValue(":cep", $cep);
            $stmt->bindValue(":ba", $bairro);
            $stmt->bindValue(":cd", $cidade);
            $stmt->bindValue(":uf", $uf);
            $stmt->execute();
            return true;
        }
    }

    public function conectarIdEndereco($uf,$cidade,$bairro,$nome_rua,$cep){
        $sql = "SELECT id_endereco FROM tbl_endereco WHERE uf = :uf AND cidade = :cd AND bairro = :ba AND nome_rua = :nm AND cep = :cep";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(":nm", $nome_rua);
        $stmt->bindValue(":cep", $cep);
        $stmt->bindValue(":ba", $bairro);
        $stmt->bindValue(":cd", $cidade);
        $stmt->bindValue(":uf", $uf);
        $stmt->execute();
        return $stmt->fetchColumn();
    }

    public function getUltimoIdEndereco(){
        $sql = "SELECT MAX(id_endereco) FROM tbl_endereco";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchColumn();
    }
}
?>