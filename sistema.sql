CREATE DATABASE sistema;

USE sistema;

CREATE TABLE contato (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100),
    email VARCHAR(100),
    senha VARCHAR(255),
    mensagem VARCHAR(250),
);