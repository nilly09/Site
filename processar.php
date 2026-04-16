<?php

require "validar_senha.php";

$nome = trim($_POST['nome'] ?? '');
$email = trim($_POST['email'] ?? '');
$senha = $_POST['senha'] ?? '';
$mensagem = trim($_POST['mensagem'] ?? '');

/* Validação email */
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo json_encode(["status" => "erro", "mensagem" => "Email inválido"]);
    exit;
}

/* Mensagem */
if (strlen($mensagem) > 250) {
    echo json_encode(["status" => "erro", "mensagem" => "Mensagem muito longa"]);
    exit;
}

/* Senha */
$senhaValida = validarSenha($senha);
if ($senhaValida !== true) {
    echo json_encode(["status" => "erro", "mensagem" => $senhaValida]);
    exit;
}

/* Agora repassa para o create.php */
$postData = http_build_query([
    'nome' => $nome,
    'email' => $email,
    'senha' => $senha,
    'mensagem' => $mensagem
]);

$ch = curl_init("create.php");

curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);

$response = curl_exec($ch);
curl_close($ch);

echo $response;
