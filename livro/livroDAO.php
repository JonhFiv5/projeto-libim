<?php 
require_once "../conexao/conexao.php";

class LivroDao{
    private $con;

    function LivroDao(){
        $this->con = Conexao::abrirConexao();
    }

    function cadastrar($nome, $categoria, $localizacao, $qtd, $valor) {
        $sql = "
        INSERT INTO tbl_livros 
        (nome, categoria, localizacao, qtde_estoque, valor)
        VALUES (:n, :c, :l, :q, :v)
        ";
        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(":n", $nome);
        $stmt->bindParam(":c", $categoria);
        $stmt->bindParam(":l", $localizacao);
        $stmt->bindParam(":q", $qtd);
        $stmt->bindParam(":v", $valor);

        $stmt->execute();
    }

    function buscarDados(){
        $sql = "SELECT * FROM tbl_livros";
        $stmt = $this->con->prepare($sql);
        $stmt->execute();

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    function excluirRegistro($id) {
        $sql = "DELETE FROM tbl_livros WHERE id_livros = :i";
        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':i', $id);
        $stmt->execute();
    }

    function buscarPorCodigo($id) {
        $sql = "SELECT * FROM tbl_livros WHERE id_livros = :i";
        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':i', $id);
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    function atualizar($id, $nome, $categoria, $localizacao, $qtd, $valor) {
        $sql = "
        UPDATE tbl_livros 
        set nome = :n, categoria = :c, localizacao = :l, qtde_estoque = :q, valor = :v
        WHERE id_livros = :i 
        ";
        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(":n", $nome);
        $stmt->bindParam(":c", $categoria);
        $stmt->bindParam(":l", $localizacao);
        $stmt->bindParam(":q", $qtd);
        $stmt->bindParam(":v", $valor);
        $stmt->bindParam(":i", $id);

        $stmt->execute();
    }

    function atualizarEstoqueEsprestimo($id, $qtd) {
        $sql = "
        UPDATE tbl_livros SET qtde_estoque = qtde_estoque - :q
        WHERE id_livros = :i";

        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(":q", $qtd);
        $stmt->bindParam(":i", $id);

        $stmt->execute();
    }

    function atualizarEstoqueDevolucao($id, $qtd) {
        $sql = "
        UPDATE tbl_livros SET qtde_estoque = qtde_estoque + :q
        WHERE id_livros = :i";

        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(":q", $qtd);
        $stmt->bindParam(":i", $id);

        $stmt->execute();
    }
    
    function buscarDadosNome($nome) {
        $result = array();
        $sql = "SELECT * FROM tbl_livros WHERE nome LIKE :n";
        $stmt = $this->con->prepare($sql);
        $nome = '%'.$nome.'%';
        $stmt->bindParam(':n', $nome);
        $stmt->execute();

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
}

?>