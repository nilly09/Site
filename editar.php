<?php
require "conexao.php";

header('Content-Type: application/json');

$id = $_POST['id'] ?? null;
$nome = $_POST['nome'] ?? '';
$email = $_POST['email'] ?? '';
$mensagem = $_POST['mensagem'] ?? '';

if (!$id) {
    echo json_encode(["status" => "erro", "mensagem" => "ID inválido"]);
    exit;
}

$sql = "UPDATE contato 
        SET nome = :nome, email = :email, mensagem = :mensagem
        WHERE id = :id";

$stmt = $conexao->prepare($sql);

$stmt->bindParam(":id", $id);
$stmt->bindParam(":nome", $nome);
$stmt->bindParam(":email", $email);
$stmt->bindParam(":mensagem", $mensagem);

if ($stmt->execute()) {
    echo json_encode(["status" => "sucesso", "mensagem" => "Atualizado com sucesso"]);
} else {
    echo json_encode(["status" => "erro", "mensagem" => "Erro ao atualizar"]);
}