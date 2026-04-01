<?php

function validarSenha($senha) {

    if (strlen($senha) < 4) {
        return "A senha deve ter no mínimo 4 caracteres.";
    }

    if (!preg_match('/^[a-zA-Z0-9!@#$%^&*()_+\-=\[\]{};:"\\|,.<>\/?]+$/', $senha)) {
        return "A senha contém caracteres inválidos.";
    }

    return true;
}