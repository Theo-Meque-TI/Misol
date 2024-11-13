<?php
session_start();
require 'conexao.php';
require 'logica-autenticacao.php';

// Verifica se o formulário foi submetido
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obtem os dados do formulário
    $email = filter_input(INPUT_POST, "email_emp", FILTER_SANITIZE_EMAIL);
    $senha = filter_input(INPUT_POST, "senha_emp", FILTER_SANITIZE_SPECIAL_CHARS);

    // Tenta autenticar o usuário
    $sql = "SELECT id, nome, telefone, cpf, email, senha, imagem, ativo FROM administrador WHERE email = ?";
    try {
        $stmt = $conn->prepare($sql);
        $result = $stmt->execute([$email]);
    } catch (Exception $e) {
        $result = false;
        $error = $e->getMessage();
    }

    $count = $stmt->rowCount();

    if ($count > 0) {
        // É um administrador
        $row = $stmt->fetch();
        if (password_verify($senha, $row['senha'])) {
            // DEU CERTO
            $_SESSION["email"] = $email;
            $_SESSION["nome"] = $row['nome'];
            $_SESSION["idUsuario"] = $row['id'];
            $_SESSION["tipoUser"] = "admin";
            $_SESSION["result_login"] = true;
            redireciona("index.php"); // Redireciona para a página de destino do admin
        } else {
            // NÃO DEU CERTO, SENHA OU EMAIL ERRADO
            unset($_SESSION["email"]);
            unset($_SESSION["nome"]);
            unset($_SESSION["tipoUser"]);
            $_SESSION["result_login"] = false;
            $_SESSION["erro"] = "Email ou senha incorretos.";
            redireciona("form_login_proprietario.php");
        }
    } else {
        // NÃO ACHOU NENHUM ADMIN COM ESSE EMAIL.
        $sql = "SELECT id_emp, nome_emp, telefone_emp, cnpj, email_emp, senha_emp, imagem_emp FROM empresa WHERE email_emp = ?";
        try {
            $stmt = $conn->prepare($sql);
            $result = $stmt->execute([$email]);
        } catch (Exception $e) {
            $result = false;
            $error = $e->getMessage();
        }

        $row = $stmt->fetch();

        if (password_verify($senha, $row['senha_emp'])) {
            // DEU CERTO
            $_SESSION["email_emp"] = $email;
            $_SESSION["nome_emp"] = $row['nome_emp'];
            $_SESSION["idUsuario"] = $row['id_emp'];
            $_SESSION["tipoUser"] = "empresa";
            $_SESSION["result_login"] = true;
            redireciona("index.php"); // Redireciona para a página de destino da empresa
        } else {
            // NÃO DEU CERTO, SENHA OU EMAIL ERRADO
            unset($_SESSION["email_emp"]);
            unset($_SESSION["nome_emp"]);
            unset($_SESSION["tipoUser"]);
            $_SESSION["result_login"] = false;
            $_SESSION["erro"] = "Email ou senha incorretos.";
            redireciona("form_login_empresa.php");
        }
    }
} else {
    // Se o formulário não foi submetido, exibe a página de login
    require 'form_login_empresa.php';
}
?>