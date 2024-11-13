<?php
session_start();
require 'logica-autenticacao.php';

if (!isAdmin() && !isProprietario()) {
    $_SESSION["restrito"] = true;
    redireciona();
    die();
}

require 'conexao.php';

$id = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);

if (!$id) {
    $_SESSION['result'] = false;
    $_SESSION['erro'] = "ID inválido.";
    redireciona('listagem.php');
    die();
}

if (isProprietario()) { // É PROPRIETÁRIO
    if (id_usuario() != $id) {
        $_SESSION["result"] = false;
        $_SESSION["erro"] = "Operação não permitida";
        redireciona("index.php");
        die();
    }

    // Inicia a transação para garantir a exclusão de todas as propriedades e do proprietário
    try {
        $conn->beginTransaction();

        // Exclui todas as propriedades do proprietário
        $sqlPropriedades = "DELETE FROM propriedade WHERE id = ?";
        $stmtPropriedades = $conn->prepare($sqlPropriedades);
        $stmtPropriedades->execute([$id]);

        // Exclui o proprietário
        $sqlProprietario = "DELETE FROM proprietario WHERE id = ?";
        $stmtProprietario = $conn->prepare($sqlProprietario);
        $stmtProprietario->execute([$id]);

        // Confirma a transação
        $conn->commit();

        $_SESSION["result"] = true;

        // Se o proprietário está se autoexcluindo, encerra a sessão
        if (id_usuario() == $id) {
            redireciona("sair.php");
            die();
        } else {
            $_SESSION['result'] = true;
            redireciona('listagem.php'); 
            die();
        }
    } catch (Exception $e) {
        // Se houver algum erro, faz o rollback para desfazer qualquer alteração
        $conn->rollBack();
        $_SESSION['result'] = false;
        $_SESSION['erro'] = $e->getMessage();
        redireciona('form_alterar_proprietario.php?id=' . $_SESSION["idUsuario"]);
        die();
    }

} else { // É ADMIN
    // Inicia a transação para garantir a exclusão de todas as propriedades e do proprietário
    try {
        $conn->beginTransaction();

        // Exclui todas as propriedades do proprietário
        $sqlPropriedades = "DELETE FROM propriedade WHERE id = ?";
        $stmtPropriedades = $conn->prepare($sqlPropriedades);
        $stmtPropriedades->execute([$id]);

        // Exclui o proprietário
        $sqlProprietario = "DELETE FROM proprietario WHERE id = ?";
        $stmtProprietario = $conn->prepare($sqlProprietario);
        $stmtProprietario->execute([$id]);

        // Confirma a transação
        $conn->commit();

        $_SESSION["result"] = true;
        redireciona('listagem.php');
        die();
    } catch (Exception $e) {
        // Se houver algum erro, faz o rollback para desfazer qualquer alteração
        $conn->rollBack();
        $_SESSION['result'] = false;
        $_SESSION['erro'] = $e->getMessage();
        redireciona('listagem.php'); 
        die();
    }
}
?>
