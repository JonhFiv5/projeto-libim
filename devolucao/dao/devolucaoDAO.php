<?php 
require_once "../conexao/conexao.php";

class DevolucaoDao{
    private $con;

    function DevolucaoDao(){
        $this->con = Conexao::abrirConexao();
    }

    function buscarPedidoCliente($cpf) {
        $sql = "SELECT p.id_pedido, c.nome, c.cpf, p.data_vencimento, p.valor_total 
        FROM tbl_pedido AS p 
        INNER JOIN tbl_clientes AS c 
        ON p.fk_cliente = c.id_clientes 
        WHERE c.cpf = :c
        ORDER BY p.id_pedido DESC";

        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':c', $cpf);
        $stmt->execute();

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
        
    }

    function buscarDadosCliente($id){
        $sql="select * from tbl_clientes
        join tbl_pedido
        ON tbl_pedido.fk_cliente = tbl_clientes.id_clientes
        where tbl_pedido.id_pedido = :id";

        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    function buscarItemsPedido($id) {
        $sql = "SELECT l.id_livros, l.nome, l.categoria, l.localizacao, l.valor, i.qtde, i.qtde_retorno
        FROM tbl_livros AS l
        JOIN tbl_pedido AS p
        JOIN item_aluguel AS i
        ON i.fk_pedido = p.id_pedido AND i.fk_livros = l.id_livros
        WHERE p.id_pedido = :id";

        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    function buscarItemsDevolvidos($id) {
        $sql = "SELECT l.id_livros, l.nome, i.qtde, i.qtde_retorno
        FROM tbl_livros AS l
        JOIN tbl_pedido AS p
        JOIN tbl_clientes AS c
        JOIN item_aluguel AS i
        ON i.fk_pedido = p.id_pedido AND i.fk_livros = l.id_livros
        WHERE p.id_pedido = :id AND i.qtde_retorno < i.qtde";

        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        //Retorna true se existem livros a serem devolvidos
        $stmt->rowCount() > 0 ? true : false;

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    function realizarDevolucao($id_pedido, $id_livro, $qtd){
        $result = array();
        $sql = "UPDATE item_aluguel i 
        SET qtde_retorno = IF (:qtd + qtde_retorno <= qtde, :qtd + qtde_retorno, qtde_retorno) 
        WHERE i.fk_livros = :liv AND i.fk_pedido = :ped";

        $sql_validar = "SELECT IF (:qtd + qtde_retorno <= qtde, TRUE, FALSE) AS validar
        FROM item_aluguel
        WHERE fk_livros = :liv AND fk_pedido = :ped";

        $sql_estocar = "UPDATE tbl_livros
        SET qtde_estoque = qtde_estoque + :qtd
        WHERE id_livros = :liv";

        $stmt = $this->con->prepare($sql_validar);
        $stmt->bindParam(':ped', $id_pedido);
        $stmt->bindParam(':liv', $id_livro);
        $stmt->bindParam(':qtd', $qtd);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if($result[0]["validar"] == 1){
            $stmt = $this->con->prepare($sql);
            $stmt->bindParam(':ped', $id_pedido);
            $stmt->bindParam(':liv', $id_livro);
            $stmt->bindParam(':qtd', $qtd);
            $stmt->execute();

            $stmt = $this->con->prepare($sql_estocar);
            $stmt->bindParam(':liv', $id_livro);
            $stmt->bindParam(':qtd', $qtd);
            $stmt->execute();

            $_SESSION['sucesso'] = 'Livro retornado';
        }else{
            $_SESSION['aviso'] = "Nao e possivel ultrapassar a quantidade de livros alugados";
        }
    }

}

?>