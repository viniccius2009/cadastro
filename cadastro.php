<?php
$host = 'localhost';
$db = 'biblioteca';
$user = 'root';
$pass = '';

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Erro: " . $conn->connect_error);
}

$email = $_POST['email'];
$senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);

// Evitar duplicidade
$sql = "SELECT id FROM usuarios WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows > 0) {
    echo "Este email já está cadastrado.";
} else {
    $stmt = $conn->prepare("INSERT INTO usuarios (email, senha) VALUES (?, ?)");
    $stmt->bind_param("ss", $email, $senha);
    if ($stmt->execute()) {
        echo "Cadastro realizado com sucesso. <a href='login.html'>Login</a>";
    } else {
        echo "Erro ao cadastrar.";
    }
}

$conn->close();
?>
