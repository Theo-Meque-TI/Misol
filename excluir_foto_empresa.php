<?php
require 'conexao.php';

$id_emp = filter_input(INPUT_POST, "id_emp", FILTER_SANITIZE_NUMBER_INT);

if (empty($id_emp)) {
    echo "Erro ao excluir imagem";
    exit;
}

// Delete the image from the database
$sql = "DELETE FROM imgEmpresa WHERE id_emp = ?";
$stmt = $conn->prepare($sql);
$stmt->execute([$id_emp]);

echo "Imagem excluída com sucesso";
?>