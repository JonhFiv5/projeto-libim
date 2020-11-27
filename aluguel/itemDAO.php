<?php 
require_once "../conexao/conexao.php";

class ItemDao{
    private $con;

    function ItemDao(){
        $this->con = Conexao::abrirConexao();
    }

    function cadastrar($pk_livro, $pk_pedido, $quantidade) {
        $sql = "
        INSERT INTO item_aluguel
        (fk_livros, fk_pedido, qtde)
        VALUES (:l, :p, :q);
        ";
        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(":l", $pk_livro);
        $stmt->bindParam(":p", $pk_pedido);
        $stmt->bindParam(":q", $quantidade);

        $stmt->execute();
    }

    function buscarPorCodigo($id) {
        $sql = "SELECT * FROM tbl_pedido WHERE id_pedido = :i";
        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':i', $id);
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

}

?>