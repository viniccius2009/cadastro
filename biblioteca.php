<?php
$host = 'localhost';
$db = 'biblioteca';
$user = 'root';
$pass = '';

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Erro: " . $conn->connect_error);
}

$resultado = $conn->query("SELECT * FROM livros");
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>Livros Cadastrados</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <div class="container">
    <h1>Livros</h1>
    <a href="add_livro.php" class="btn">Adicionar Livro</a>
    <table border="1" style="margin-top: 20px; width: 100%;">
      <tr>
        <th>Título</th>
        <th>Autor</th>
        <th>Ano</th>
        <th>Gênero</th>
        <th>Status</th>
      </tr>
      <?php while ($livro = $resultado->fetch_assoc()): ?>
      <tr>
        <td><?= htmlspecialchars($livro['titulo']) ?></td>
        <td><?= htmlspecialchars($livro['autor']) ?></td>
        <td><?= htmlspecialchars($livro['ano_publicacao']) ?></td>
        <td><?= htmlspecialchars($livro['genero']) ?></td>
        <td><?= $livro['disponivel'] ? 'Disponível' : 'Indisponível' ?></td>
      </tr>
      <?php endwhile; ?>
    </table>
  </div>
</body>
</html>