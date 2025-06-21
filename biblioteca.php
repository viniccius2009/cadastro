<?php
// Conexão com o banco de dados
$mysqli = new mysqli("localhost", "root", "", "biblioteca");
if ($mysqli->connect_error) {
    die("Erro de conexão: " . $mysqli->connect_error);
}

// Coleta dos dados do formulário
$nome = $_POST['nome']?? '';
$cpf = $_POST['cpf']?? '';
$nascimento = $_POST['nascimento']?? '';
$genero = $_POST['genero']?? '';
$endereco = $_POST['endereco']?? '';
$cep = $_POST['cep']?? '';
$cidade = $_POST['cidade']?? '';
$bairro = $_POST['bairro']?? '';
$telefone = $_POST['telefone']?? '';
$email_c = $_POST['email_c']?? '';
$email_l = $_POST['email_l']?? '';
$senha = password_hash($_POST['senha'], PASSWORD_DEFAULT)??'';

// Preparação da query
$stmt = $mysqli->prepare("INSERT INTO usuarios (nome, cpf, nascimento, genero, endereço, cep, cidade, bairro, telefone, email_c, email_l, senha) 
VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

if (!$stmt) {
    die("Erro na preparação da query: " . $mysqli->error);
}

$stmt->bind_param("sssssssssssss", $nome, $cpf, $nascimento, $genero, $endereco, $cep, $cidade, $bairro, $telefone, $email_c, $email_l, $senha, $senha_l);

// Execução e verificação
if ($stmt->execute()) {
    header("Location: inicio.html");
    exit();
} else {
    echo "Erro ao cadastrar: " . $stmt->error;
}

// Fechamento
$stmt->close();
$mysqli->close();
?>

