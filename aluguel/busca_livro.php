<?php 
session_start();
require_once '../livro/livroDAO.php';

$id_livro = addslashes($_POST['id_livro']);
$livro = new LivroDao();

$resultado = $livro->buscarPorCodigo($id_livro);
if (empty($resultado)) {
    $_SESSION['aviso'] = 'O ID informado não corresponde a nenhum livro.';
    header('Location: form_incluir_livros.php');
} else if ((int)$resultado['qtde_estoque'] == 0) {
    $_SESSION['aviso'] = 'Estamos sem estoque desse livro no momento.';
    header('Location: form_incluir_livros.php');
} else{
    $_SESSION['id_livro'] = $id_livro;
    $_SESSION['titulo_livro'] = $resultado['nome'];
    $_SESSION['valor'] = $resultado['valor'];
    $_SESSION['estoque'] = $resultado['qtde_estoque'];
    header('Location: form_incluir_livros.php');
}

?>