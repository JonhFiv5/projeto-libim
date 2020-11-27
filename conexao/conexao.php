<?php

class Conexao {

    static function abrirConexao() {
        $con = null;
        try {
            $con = new PDO("mysql:dbname=livrimdb;host=localhost", "root", "");
        } catch (PDOException $e) {
            echo $e->getMessage();
            exit();
        } catch (Exception $e) {
            echo $e->getMessage();
            exit();
        }
        return $con;
    }

}

?>