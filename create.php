<?php

require "conexao.php";

header('Content-Type: application/json');

$nome = $_POST['nome'] ?? '';
$email = $_POST['email'] ?? '';
$senha = $_POST['senha'] ?? '';
$mensagem = $_POST['mensagem'] ?? '';

$senhaHash = password_hash($senha, PASSWORD_DEFAULT);

$sql = "INSERT INTO contato (nome, email, senha, mensagem)
        VALUES (:nome, :email, :senha, :mensagem)";

$stmt = $conexao->prepare($sql);

$stmt->bindParam(":nome", $nome);
$stmt->bindParam(":email", $email);
$stmt->bindParam(":senha", $senhaHash);
$stmt->bindParam(":mensagem", $mensagem);

if ($stmt->execute()) {
    echo json_encode([
        "status" => "sucesso",
        "mensagem" => "Mensagem enviada com sucesso!"
    ]);
} else {
    echo json_encode([
        "status" => "erro",
        "mensagem" => "Erro ao salvar no banco!"
    ]);
}