<?php
require 'conexao.php';

$id = filter_input(INPUT_POST, "id", FILTER_SANITIZE_NUMBER_INT);

if (empty($id)) {
    echo "Erro ao excluir imagem";
    exit;
}

// Delete the image from the database
$sql = "DELETE FROM imgProprietario WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->execute([$id]);

echo "Imagem excluída com sucesso";
?>