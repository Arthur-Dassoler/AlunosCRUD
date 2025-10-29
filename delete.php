<?php
require 'conexao.php';
$conn = (new Conexao())->conectar();

if (isset($_POST['id'])) {
    $id = $_POST['id'];

    $sql = "DELETE FROM alunos WHERE id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();

    echo "<p style='text-align:center; color:green;'>Aluno excluído com sucesso!</p>";
}

echo "<p style='text-align:center;'><a href='view.php'>Voltar</a></p>";
?>
