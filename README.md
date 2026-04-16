# 📬 Sistema de Formulário de Contato

Sistema web completo com CRUD de contatos, validações no frontend e backend, criptografia de senha e armazenamento seguro em banco de dados MySQL.

---

## 📋 Sobre o Projeto

Aplicação full-stack que permite o envio, listagem, edição e exclusão de mensagens de contato, com:

- ✅ Validação de e-mail (formato válido via PHP)
- ✅ Validação e criptografia de senha com `password_hash()` (bcrypt)
- ✅ Proteção contra SQL Injection (Prepared Statements com PDO)
- ✅ Envio assíncrono via Fetch API (sem recarregar a página)
- ✅ Feedback visual de sucesso/erro para o usuário
- ✅ CRUD completo: criar, listar, editar e excluir contatos
- ✅ Design responsivo (mobile-first)

---

## 🚀 Tecnologias Utilizadas

| Tecnologia | Finalidade |
|---|---|
| HTML5 | Estrutura do formulário e páginas de gerenciamento |
| CSS3 | Estilização com Flexbox e responsividade |
| JavaScript (ES6+) | Envio assíncrono (Fetch API) e feedback visual |
| PHP 7.4+ | Processamento backend, validações e criptografia |
| MySQL 5.7+ | Armazenamento dos dados |
| PDO | Conexão segura com prepared statements |

---

## 📁 Estrutura de Arquivos

```
formulario-contato/
│
├── index.html          # Página principal com o formulário de contato
├── create.php          # Insere novo contato no banco de dados
├── processar.php       # Processamento e validações backend (email, senha, mensagem)
├── listar.php          # Retorna todos os contatos em JSON
├── editar.php          # Atualiza um contato existente (UPDATE)
├── delete.php          # Exclui um contato pelo ID (DELETE)
├── update.html         # Página para editar um contato
├── delete.html         # Página para excluir um contato pelo ID
├── conexao.php         # Conexão PDO com o banco de dados
├── validar_senha.php   # Função de validação de senha
├── style.css           # Estilos e design responsivo
├── script.js           # Script JS alternativo (versão com alert)
└── sistema.sql         # Script de criação do banco de dados
```

---

## 🛠️ Pré-requisitos

Antes de começar, certifique-se de ter instalado:

- **XAMPP**, **WAMP** ou **LAMP** (servidor local)
- **PHP** versão 7.4 ou superior
- **MySQL** versão 5.7 ou superior
- **Navegador** atualizado (Chrome, Firefox, Edge ou Safari)

---

## ⚙️ Instalação e Configuração

### 1. Copiar os arquivos

Mova todos os arquivos do projeto para a pasta correta do seu servidor:

- **XAMPP (Windows/Mac):** `C:/xampp/htdocs/formulario-contato/`
- **WAMP (Windows):** `C:/wamp64/www/formulario-contato/`
- **LAMP (Linux):** `/var/www/html/formulario-contato/`

### 2. Criar o banco de dados

1. Inicie o **Apache** e o **MySQL** no seu servidor local
2. Acesse o **phpMyAdmin** em: `http://localhost/phpmyadmin`
3. Clique em **"Nova"** para criar um banco de dados chamado `sistema`
4. Selecione o banco `sistema` e clique na aba **"SQL"**
5. Cole e execute o script abaixo:

```sql
CREATE DATABASE IF NOT EXISTS sistema
  CHARACTER SET utf8mb4
  COLLATE utf8mb4_unicode_ci;

USE sistema;

CREATE TABLE IF NOT EXISTS contato (
    id        INT AUTO_INCREMENT PRIMARY KEY,
    nome      VARCHAR(100)  NOT NULL,
    email     VARCHAR(100)  NOT NULL,
    senha     VARCHAR(255)  NOT NULL,
    mensagem  VARCHAR(250)  NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
```

> Alternativamente, você pode importar o arquivo `sistema.sql` diretamente pelo phpMyAdmin em **Importar → Escolher arquivo**.

### 3. Configurar a conexão com o banco

Abra o arquivo `conexao.php` e ajuste as credenciais conforme seu ambiente:

```php
$host = "localhost";
$db   = "sistema";
$user = "root";      // Altere para seu usuário MySQL
$pass = "";          // Altere para sua senha MySQL
```

> ⚠️ **Atenção:** Nunca suba o arquivo `conexao.php` com senhas reais para repositórios públicos. Adicione-o ao `.gitignore` ou utilize variáveis de ambiente.

### 4. Acessar o sistema

Com o Apache e o MySQL rodando, acesse no navegador:

```
http://localhost/formulario-contato/
```

---

## 📄 Como o Sistema Funciona

### Fluxo de submissão do formulário

```
Usuário preenche o formulário
        ↓
JavaScript intercepta o submit (preventDefault)
        ↓
Fetch API envia os dados via POST para processar.php
        ↓
processar.php valida: email, senha e tamanho da mensagem
        ↓
        ├── Erro → retorna mensagem de erro → JS exibe em vermelho
        └── Ok  → senha é criptografada com password_hash()
                       ↓
                  dados inseridos no MySQL via PDO (prepared statement)
                       ↓
                  retorna nome, email e mensagem → JS exibe em verde
```

### CRUD de Contatos

| Operação | Arquivo | Método |
|---|---|---|
| Criar | `create.php` | POST |
| Listar | `listar.php` | GET |
| Editar | `editar.php` + `update.html` | POST |
| Excluir | `delete.php` + `delete.html` | POST |

### Descrição de cada arquivo

**`index.html`**
Página principal com o formulário de contato (nome, email, senha e mensagem). O JavaScript embutido intercepta o submit, envia os dados via `fetch()` para o backend e exibe o retorno na div `#mensagem-resultado` com classe `sucesso` (verde) ou `erro` (vermelho).

**`processar.php`**
Backend principal. Recebe os dados via `$_POST`, executa as validações (email, tamanho da mensagem, senha), criptografa a senha com `password_hash()` e insere o registro na tabela `contato` usando PDO com prepared statements.

**`create.php`**
Recebe os dados de contato via POST e insere um novo registro na tabela `contato`. Retorna JSON com o status da operação.

**`listar.php`**
Consulta todos os contatos no banco (id, nome, email, mensagem) e retorna o resultado como JSON, ordenado do mais recente para o mais antigo.

**`editar.php`**
Recebe via POST o `id` e os novos valores (nome, email, mensagem) e executa um `UPDATE` na tabela `contato`. Retorna JSON com status da operação.

**`update.html`**
Página com formulário para atualizar um contato existente pelo ID. Envia os dados via Fetch API para `editar.php`.

**`delete.php`**
Recebe o `id` via POST e executa o `DELETE` correspondente na tabela. Retorna JSON com status da operação.

**`delete.html`**
Página para excluir um contato pelo ID. Solicita confirmação antes de enviar a requisição para `delete.php`.

**`conexao.php`**
Cria a conexão com o MySQL via PDO. Em caso de falha, exibe a mensagem de erro e encerra a execução.

**`validar_senha.php`**
Contém a função `validarSenha($senha)` que verifica se a senha tem no mínimo 4 caracteres e se contém apenas caracteres permitidos (letras, números e símbolos comuns).

**`style.css`**
Estiliza o formulário com fundo azul escuro (`#0f172a`), card branco centralizado, inputs com borda animada ao focar e botão azul. Inclui media query para telas menores que 420px.

**`sistema.sql`**
Script SQL para criação do banco `sistema` e da tabela `contato` com os campos: `id`, `nome`, `email`, `senha` e `mensagem`.

---

## ✅ Validações Implementadas

### Backend (PHP)

| Campo | Regra | Mensagem de Erro |
|---|---|---|
| Email | Formato válido | "Erro: digite um email válido!" |
| Mensagem | Máximo 250 caracteres | "Erro: a mensagem deve ter no máximo 250 caracteres!" |
| Senha | Mínimo 4 caracteres | "A senha deve ter no mínimo 4 caracteres." |
| Senha | Apenas caracteres permitidos | "A senha contém caracteres inválidos." |

### Segurança

- **SQL Injection:** prevenido com PDO e `bindParam()`
- **Senha:** nunca armazenada em texto puro — sempre criptografada com `password_hash()`
- **Validação de email:** feita com `filter_var()` do PHP

---

## ⚠️ Observações e Melhorias Sugeridas

- O campo `email` na tabela não possui `UNIQUE`, o que permite e-mails duplicados. Considere adicionar: `ALTER TABLE contato ADD UNIQUE (email);`
- A senha mínima é de apenas 4 caracteres. Recomenda-se aumentar para 8.
- O arquivo `script.js` é uma versão alternativa com `alert()` e não está sendo carregado pelo `index.html` (que usa JS embutido). Você pode remover `script.js` ou padronizar em um único arquivo externo.
- As páginas `delete.html` e `update.html` não possuem estilização própria. Considere aplicar o `style.css` para manter a consistência visual.
- Em produção, configure o PHP para não exibir erros ao usuário (`display_errors = Off`) e utilize HTTPS.
- Adicione `conexao.php` ao `.gitignore` para evitar o vazamento de credenciais do banco de dados.

---

## 👥 Autores

- **Nicolly**
- **Patrick**

---

## 📄 Licença

Este projeto foi desenvolvido para fins educacionais.**`processar.php`**
Backend principal. Recebe os dados via `$_POST`, executa as validações (email, tamanho da mensagem, senha), criptografa a senha com `password_hash()` e insere o registro na tabela `contato` usando PDO com prepared statements.

**`conexao.php`**
Cria a conexão com o MySQL via PDO. Em caso de falha, exibe a mensagem de erro e encerra a execução.

**`validar_senha.php`**
Contém a função `validarSenha($senha)` que verifica se a senha tem no mínimo 4 caracteres e se contém apenas caracteres permitidos (letras, números e símbolos comuns).

**`style.css`**
Estiliza o formulário com fundo azul escuro (`#0f172a`), card branco centralizado, inputs com borda animada ao focar e botão azul. Inclui media query para telas menores que 420px.

**`sistema.sql`**
Script SQL para criação do banco `sistema` e da tabela `contato` com os campos: `id`, `nome`, `email`, `senha` e `mensagem`.

---

## ✅ Validações Implementadas

### Backend (PHP)

| Campo | Regra | Mensagem de Erro |
|---|---|---|
| Email | Formato válido | "Erro: digite um email válido!" |
| Mensagem | Máximo 250 caracteres | "Erro: a mensagem deve ter no máximo 250 caracteres!" |
| Senha | Mínimo 4 caracteres | "A senha deve ter no mínimo 4 caracteres." |
| Senha | Apenas caracteres permitidos | "A senha contém caracteres inválidos." |

### Segurança

- **SQL Injection:** prevenido com PDO e `bindParam()`
- **Senha:** nunca armazenada em texto puro — sempre criptografada com `password_hash()`
- **Validação de email:** feita com `filter_var()` do PHP

---

## ⚠️ Observações e Melhorias Sugeridas

- O campo `email` na tabela não possui `UNIQUE`, o que permite e-mails duplicados. Considere adicionar: `ALTER TABLE contato ADD UNIQUE (email);`
- A senha mínima é de apenas 4 caracteres. Recomenda-se aumentar para 8.
- O arquivo `script.js` é uma versão alternativa com `alert()` e não está sendo carregado pelo `index.html` (que usa JS embutido). Você pode remover `script.js` ou padronizar em um único arquivo externo.
- Em produção, configure o PHP para não exibir erros para o usuário (`display_errors = Off`) e utilize HTTPS.

---

## 👥 Autores

- **Nicolly**
- **Patrick**

---

## 📄 Licença

Este projeto foi desenvolvido para fins educacionais.
