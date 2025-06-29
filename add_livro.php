<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $conn = new mysqli('localhost', 'root', '', 'biblioteca');
    if ($conn->connect_error) die("Erro: " . $conn->connect_error);

    $titulo = $_POST['titulo'];
    $autor = $_POST['autor'];
    $ano = $_POST['ano'];
    $genero = $_POST['genero'];
    $quantidade = $_POST['quantidade'];

$stmt = $conn->prepare("INSERT INTO livros (titulo, autor, ano_publicacao, genero, disponivel, imagem, quantidade) VALUES (?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("ssisisi", $titulo, $autor, $ano, $genero, $disponivel, $imagem_nome, $quantidade);



    // Upload da imagem
    $imagem_nome = null;
    if (!empty($_FILES['imagem']['name'])) {
        $imagem_nome = 'imagens/' . basename($_FILES['imagem']['name']);
        move_uploaded_file($_FILES['imagem']['tmp_name'], $imagem_nome);
    }

    $stmt = $conn->prepare("INSERT INTO livros (titulo, autor, ano_publicacao, genero, disponivel, imagem) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssisis", $titulo, $autor, $ano, $genero, $disponivel, $imagem_nome);

    if ($stmt->execute()) {
        header("Location: inicio.php");
    } else {
        echo "Erro ao cadastrar livro.";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>Adicionar Livro</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <div class="container">
    <h1>Adicionar Novo Livro</h1>
    <form method="post" enctype="multipart/form-data">
      <input type="text" name="titulo" placeholder="Título" required>
      <input type="text" name="autor" placeholder="Autor" required>
      <input type="number" name="ano" placeholder="Ano de publicação" required>
      <input type="text" name="genero" placeholder="Gênero" required>
      <input type="number" name="quantidade" placeholder="Quantidade em estoque" min="1" value="1" required>


      <label style="display:block; margin:10px 0;">
        Capa do livro:
        <input type="file" name="imagem" accept="image/*">
      </label>

      <button type="submit" class="btn">Cadastrar</button>
    </form>
  </div>
</body>
</html>
