<?php

require_once "../conexao/conexao.php";

class FuncionarioDao{
    private $con;

    function FuncionarioDao(){
        $this->con = Conexao::abrirConexao();
    }

    function cadastrar($nome, $usuario, $senha, $nivelAcesso) {
        // Verificar se o nome de usuário já existe no banco
        $sql = "SELECT * FROM tbl_funcionarios WHERE login = :l";
        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':l', $usuario);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            return false;
        } else {
            $sql = "
            INSERT INTO tbl_funcionarios (nome, login, senha, nivel_acesso)
            VALUES (:n, :l, :p, :a)
            ";
            $stmt = $this->con->prepare($sql);
            $stmt->bindParam(":n", $nome);
            $stmt->bindParam(":l", $usuario);
            $stmt->bindParam(":p", $senha);
            $stmt->bindParam(":a", $nivelAcesso);

            $stmt->execute();
            return true;
        }
    }

    function verificarLogin($usuario, $senha) {
        // Verificar se o usuario existe
        $sql = "SELECT senha, nivel_acesso FROM tbl_funcionarios WHERE login = :l";
        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(":l", $usuario);
        $stmt->execute();

        if ($stmt->rowCount() == 0) {
            return false;
        } else {
            // Verificar se a senha pertence ao usuario
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            $senha_valida = password_verify($senha, $result['senha']);
            if ($senha_valida) {
                $nivelAcesso = $result['nivel_acesso'];
                return $nivelAcesso;
            } else {
                return false;
            }
        }
    }

    function buscarDados(){
        $sql = "SELECT * FROM tbl_funcionarios";
        $stmt = $this->con->prepare($sql);
        $stmt->execute();

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    function buscarDadosNome($nome) {
        $result = array();
        $sql = "SELECT * FROM tbl_funcionarios WHERE nome LIKE :n";
        $stmt = $this->con->prepare($sql);
        $nome = $nome.'%';
        $stmt->bindParam(':n', $nome);
        $stmt->execute();

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    function excluirRegistro($id) {
        $sql = "DELETE FROM tbl_funcionarios WHERE id_funcionarios = :i";
        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':i', $id);
        $stmt->execute();
    }

    function buscarPorCodigo($id) {
        $sql = "SELECT * FROM tbl_funcionarios WHERE id_funcionarios = :i";
        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':i', $id);
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    // NOVO
    function buscarId($login) {
        $sql = "SELECT id_funcionarios FROM tbl_funcionarios WHERE login = :l";
        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':l', $login);
        $stmt->execute();

        $result = $stmt->fetchColumn();
        return $result;
    }

    function atualizar($id, $nome, $usuario, $senha, $nivelAcesso) {
        // Verificar se o nome de usuário já existe no banco
        $sql = "SELECT * FROM tbl_funcionarios WHERE login = :l";
        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':l', $usuario);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($result['id_funcionarios'] != $id){
                return false;
            } 
        }

        $sql = "
        UPDATE tbl_funcionarios SET nome = :n, login = :l, senha = :p, nivel_acesso = :a
        WHERE id_funcionarios = :i
        ";
        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(":n", $nome);
        $stmt->bindParam(":l", $usuario);
        $stmt->bindParam(":p", $senha);
        $stmt->bindParam(":a", $nivelAcesso);
        $stmt->bindParam(":i", $id);

        $stmt->execute();
        return true;
    }

}
?>