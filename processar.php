<?php

require "conexao.php";
require "validar_senha.php";

$nome = $_POST['nome'] ?? '';
$email = $_POST['email'] ?? '';
$senha = $_POST['senha'] ?? '';
$mensagem = $_POST['mensagem'] ?? '';

/* Validação Email */
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo "Erro: digite um email válido!";
    exit;
}

/* Validação mensagem */
if (strlen($mensagem) > 250) {
    echo "Erro: a mensagem deve ter no máximo 250 caracteres!";
    exit;
}

/* Validação senha */
$senhaValida = validarSenha($senha);
if ($senhaValida !== true) {
    echo "Erro: " . $senhaValida;
    exit;
}

/* Criptografar senha */
$senhaHash = password_hash($senha, PASSWORD_DEFAULT);

/* Inserção no banco */
$sql = "INSERT INTO contato (nome, email, senha, mensagem)
        VALUES (:nome, :email, :senha, :mensagem)";

$stmt = $conexao->prepare($sql);
$stmt->bindParam(":nome", $nome);
$stmt->bindParam(":email", $email);
$stmt->bindParam(":senha", $senhaHash);
$stmt->bindParam(":mensagem", $mensagem);

/* Executa e retorna os dados enviados */
if ($stmt->execute()) {
    // Aqui retornamos os dados do usuário, sem a senha
    echo "Nome: $nome, Gmail: $email, Mensagem enviada: $mensagem";
} else {
    echo "Erro ao salvar a mensagem!";
}

exit;