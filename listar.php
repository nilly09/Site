<?php
require "conexao.php";

header('Content-Type: application/json');

$sql = "SELECT id, nome, email, mensagem FROM contato ORDER BY id DESC";
$stmt = $conexao->query($sql);

echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));