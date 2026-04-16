<?php
require "conexao.php";

header('Content-Type: application/json');

$id = $_POST['id'] ?? null;

if (!$id) {
    echo json_encode(["status" => "erro", "mensagem" => "ID inválido"]);
    exit;
}

$sql = "DELETE FROM contato WHERE id = :id";
$stmt = $conexao->prepare($sql);
$stmt->bindParam(":id", $id);

if ($stmt->execute()) {
    echo json_encode(["status" => "sucesso", "mensagem" => "Deletado com sucesso"]);
} else {
    echo json_encode(["status" => "erro", "mensagem" => "Erro ao deletar"]);
}