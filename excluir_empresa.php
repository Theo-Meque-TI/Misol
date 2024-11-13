<?php
session_start();
require 'logica-autenticacao.php';

if (!isAdmin() && !isEmpresa()) {
    $_SESSION["restrito"] = true;
    redireciona();
    die();
}

require 'conexao.php';

$id_emp = filter_input(INPUT_GET, "id_emp", FILTER_SANITIZE_NUMBER_INT);

if (!$id_emp) {
    $_SESSION['result'] = false;
    $_SESSION['erro'] = "ID inválido.";
    redireciona('listagem.php');
    die();
}

if (isEmpresa()) { // É EMPRESA
    if (id_usuario() != $id_emp) {
        $_SESSION["result"] = false;
        $_SESSION["erro"] = "Operação não permitida";
        redireciona("index.php");
        die();
    }

    try {
        // Inicia a transação
        $conn->beginTransaction();

        // Exclui a empresa
        $sqlEmpresa = "DELETE FROM empresa WHERE id_emp = ?";
        $stmtEmpresa = $conn->prepare($sqlEmpresa);
        $stmtEmpresa->execute([$id_emp]);

        $conn->commit(); // Confirma a transação
        $_SESSION["result"] = true;

        // Se a empresa está se autoexcluindo, encerra a sessão
        if (id_usuario() == $id_emp) {
            redireciona("sair.php");
            die();
        } else {
            redireciona('listagem.php');
            die();
        }
    } catch (Exception $e) {
        // Rollback em caso de erro
        $conn->rollBack();
        $_SESSION['result'] = false;
        $_SESSION['erro'] = $e->getMessage();
        redireciona('form_alterar_empresa.php?id_emp=' . $_SESSION["idUsuario"]);
        die();
    }

} else { // É ADMIN
    try {
        // Inicia a transação
        $conn->beginTransaction();

        // Exclui a empresa
        $sqlEmpresa = "DELETE FROM empresa WHERE id_emp = ?";
        $stmtEmpresa = $conn->prepare($sqlEmpresa);
        $stmtEmpresa->execute([$id_emp]);

        $conn->commit(); // Confirma a transação
        $_SESSION["result"] = true;
        redireciona('listagem.php');
        die();
    } catch (Exception $e) {
        // Rollback em caso de erro
        $conn->rollBack();
        $_SESSION['result'] = false;
        $_SESSION['erro'] = $e->getMessage();
        redireciona('listagem.php');
        die();
    }
}
?>
