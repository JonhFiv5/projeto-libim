<?php 
require_once "../conexao/conexao.php";

class PedidoDao{
    private $con;

    function PedidoDao(){
        $this->con = Conexao::abrirConexao();
    }

    function criarPedido($pk_funcionario, $pk_cliente) {
        $sql = "
        INSERT INTO tbl_pedido 
        (fk_funcionario, fk_cliente, data_vencimento)
        VALUES (:f, :c, :d)
        ";
        $data = date('d-m-Y');
        $vencimento = date('Y-m-d', strtotime("+30 days",strtotime($data)));
        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(":f", $pk_funcionario);
        $stmt->bindParam(":c", $pk_cliente);
        $stmt->bindParam(":d", $vencimento);
        $stmt->execute();
    }

    function pegarIdPedidoAtual() {
        $sql = "SELECT MAX(id_pedido) FROM tbl_pedido";
        $stmt = $this->con->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchColumn();
        return $result;
    }

    function calcularValor($pk_pedido){
        $sql_valores = "
        SELECT liv.valor FROM tbl_livros liv WHERE 
        liv.id_livros IN (SELECT alu.fk_livros FROM item_aluguel alu WHERE alu.fk_pedido = :p
        GROUP BY alu.fk_livros)
        ";
        $stmt = $this->con->prepare($sql_valores);
        $stmt->bindParam(":p", $pk_pedido);
        $stmt->execute();

        $valores = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $sql_quantidade = "
        SELECT SUM(alu.qtde) as qtde FROM item_aluguel alu WHERE alu.fk_pedido = :p
        GROUP BY alu.fk_livros
        ";
        $stmt = $this->con->prepare($sql_quantidade);
        $stmt->bindParam(":p", $pk_pedido);
        $stmt->execute();

        $quantidades = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $valor_total = 0;
        for ($i = 0; $i < sizeof($valores); $i++) {
            $valor_total += $valores[$i]['valor'] * $quantidades[$i]['qtde'];
        }

        return $valor_total;
    }

    function atualizarValor($id, $valor) {
        $sql = "
        UPDATE tbl_pedido
        SET valor_total = :v
        WHERE id_pedido = :i 
        ";
        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(":v", $valor);
        $stmt->bindParam(":i", $id);

        $stmt->execute();
    }

    function atualizarVencimento($id, $data) {
        $sql = "
        UPDATE tbl_pedido
        SET data_vencimento = :d
        WHERE id_pedido = :i
        ";
        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(":d", $data);
        $stmt->bindParam(":i", $id);

        $stmt->execute();
    }

    function buscarVencidos($id, $data) {
        // Precisa ser implementado
    }

    function buscarDados(){
        $sql = "SELECT * FROM tbl_pedido";
        $stmt = $this->con->prepare($sql);
        $stmt->execute();

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    function excluirRegistro($id) {
        $sql = "DELETE FROM tbl_pedido WHERE id_pedido = :i";
        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':i', $id);
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

    function pegarResumoPedido($id) {
        $sql_titulo_valor = "
        SELECT liv.nome, liv.valor FROM tbl_livros liv 
        WHERE liv.id_livros IN 
        (SELECT alu.fk_livros FROM item_aluguel alu WHERE alu.fk_pedido = :i)
        ";
        $stmt = $this->con->prepare($sql_titulo_valor);
        $stmt->bindParam(":i", $id);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $sql_quantidade = "
        SELECT SUM(alu.qtde) as qtde FROM item_aluguel alu WHERE alu.fk_pedido = :p
        GROUP BY alu.fk_livros
        ";
        $stmt = $this->con->prepare($sql_quantidade);
        $stmt->bindParam(":p", $id);
        $stmt->execute();
        $quantidades = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // $retorno = array();

        for ($i = 0; $i < sizeof($quantidades); $i++) {
            // $result[$i] += array("qtde" => $quantidades[$i]['qtde']);
            $result[$i] += $quantidades[$i];
        }

        return $result;
    }

}

?>