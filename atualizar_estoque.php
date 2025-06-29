<?php
$conn = new mysqli('localhost', 'root', '', 'biblioteca');
if ($conn->connect_error) die("Erro: " . $conn->connect_error);

$id = $_GET['id'];
$acao = $_GET['acao']; // 'mais' ou 'menos'

// Busca quantidade atual
$res = $conn->query("SELECT quantidade FROM livros WHERE id = $id");
if ($res && $livro = $res->fetch_assoc()) {
    $quantidade = $livro['quantidade'];

    if ($acao === 'mais') $quantidade++;
    if ($acao === 'menos' && $quantidade > 0) $quantidade--;

    $conn->query("UPDATE livros SET quantidade = $quantidade WHERE id = $id");
}

header("Location: inicio.php");
exit;
?>
