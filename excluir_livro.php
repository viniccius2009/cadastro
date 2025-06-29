<?php
$conn = new mysqli('localhost', 'root', '', 'biblioteca');
if ($conn->connect_error) die("Erro: " . $conn->connect_error);

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    // Excluir a imagem associada (se quiser)
    $res = $conn->query("SELECT imagem FROM livros WHERE id = $id");
    if ($res && $livro = $res->fetch_assoc()) {
        $imagem = $livro['imagem'];
        if ($imagem && file_exists($imagem)) {
            unlink($imagem); // remove o arquivo de imagem do servidor
        }
    }

    $conn->query("DELETE FROM livros WHERE id = $id");
}

header("Location: inicio.php");
exit;
?>
