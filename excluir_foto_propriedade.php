<?php
require 'conexao.php';

$id_propri = filter_input(INPUT_POST, 'id_propri', FILTER_SANITIZE_NUMBER_INT);
$id_img = filter_input(INPUT_POST, 'id_img', FILTER_SANITIZE_NUMBER_INT);

if ($id_propri && $id_img) {
    // Excluir a imagem da tabela imgPropriedade
    $sql = "UPDATE imgPropriedade SET imagem" . $id_img . " = NULL WHERE id_propri = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$id_propri]);
}
?>