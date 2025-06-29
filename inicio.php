<?php
$host = 'localhost';
$db = 'biblioteca';
$user = 'root';
$pass = '';

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Erro ao conectar ao banco de dados: " . $conn->connect_error);
}

$livros = $conn->query("SELECT * FROM livros ORDER BY criado_em DESC");
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Biblioteca</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <div class="container">
    <h1>Biblioteca</h1>

    <div class="buttons">
      <a href="cadastro.html" class="btn">Cadastro</a>
      <a href="login.html" class="btn">Login</a>
      <a href="add_livro.php" class="btn">Adicionar Livro</a>
    </div>

    <h2 style="margin-top: 30px;">Livros disponíveis</h2>
<div class="livros-lista">
  <?php while ($livro = $livros->fetch_assoc()): ?>
  <div class="livro-card">
    <div class="livro-img">
      <img src="<?= $livro['imagem'] ?: 'imagens/default.jpg' ?>" alt="Capa do livro" />
    </div>
    <div class="livro-info">
      <h3><?= htmlspecialchars($livro['titulo']) ?></h3>
      <p><strong>Autor:</strong> <?= htmlspecialchars($livro['autor']) ?></p>
      <p><strong>Ano:</strong> <?= htmlspecialchars($livro['ano_publicacao']) ?></p>
      <p><strong>Gênero:</strong> <?= htmlspecialchars($livro['genero']) ?></p>
      <p><strong>Status:</strong> <?= $livro['disponivel'] ? 'Disponível' : 'Indisponível' ?></p>
      <p><strong>Estoque:</strong> <?= $livro['quantidade'] ?> unidade(s)</p>
      <div style="margin-top: 10px;">
  <a href="atualizar_estoque.php?id=<?= $livro['id'] ?>&acao=menos" class="btn" style="background-color: #d9534f;">–</a>
  <a href="atualizar_estoque.php?id=<?= $livro['id'] ?>&acao=mais" class="btn" style="background-color: #5cb85c;">+</a>
  <a href="excluir_livro.php?id=<?= $livro['id'] ?>" class="btn" style="background-color: #ff4444;" onclick="return confirm('Tem certeza que deseja excluir este livro?')">Excluir</a>
</div>
    </div>
  </div>
  <?php endwhile; ?>
</div>


