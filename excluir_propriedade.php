<?php
session_start();
require 'logica-autenticacao.php';
require 'conexao.php';

// Apenas Admin ou Proprietário podem acessar
if (!isProprietario() && !isAdmin()) {
    $_SESSION["restrito"] = true;
    redireciona();
    die();
}

// Captura e sanitiza o ID da propriedade e do proprietário
$id_propri = filter_input(INPUT_GET, "id_propri", FILTER_SANITIZE_NUMBER_INT);
$id = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);

// Verificação básica de parâmetros
if (!$id_propri || !$id) {
    $_SESSION['result'] = false;
    $_SESSION['erro'] = "ID inválido.";
    redireciona('listagem.php');
    die();
}

// Se for proprietário, verifica se ele é o dono da propriedade
if (isProprietario()) {
    $sqlVerifica = "SELECT id FROM propriedade WHERE id_propri = ? AND id = ? LIMIT 1";
    $stmtVerifica = $conn->prepare($sqlVerifica);
    $stmtVerifica->execute([$id_propri, id_usuario()]);

    $proprietario = $stmtVerifica->fetchColumn();

    // Se a propriedade não pertence ao proprietário logado, redireciona para a index.php
    if (!$proprietario) {
        $_SESSION["result"] = false;
        $_SESSION["erro"] = "Operação não permitida.";
        redireciona("index.php");
        die();
    }
}

// Se chegou até aqui, pode prosseguir com a exclusão
$sql = "DELETE FROM propriedade WHERE id_propri = ? AND id = ?";

try {
    $stmt = $conn->prepare($sql);
    $result = $stmt->execute([$id_propri, $id]);
    $count = $stmt->rowCount();
} catch (Exception $e) {
    $result = false;
    $error = $e->getMessage();
}

// Redirecionamento após a exclusão
if ($result && $count >= 1) {
    

    if (isAdmin()) {
        redireciona("listagem_propri.php?id=$id");
    } else {
        redireciona("listagem_minhas_propriedades.php?id=$id");
    }
    die();
} else {
    $_SESSION['result'] = false;
    $_SESSION['erro'] = $error ?? "Erro na exclusão.";
    
    if (isAdmin()) {
        redireciona("listagem_propri.php?id=$id");
    } else {
        redireciona("listagem_minhas_propriedades.php?id=$id");
    }
    die();
}
?>
