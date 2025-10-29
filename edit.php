<?php
require 'conexao.php';
$conn = (new Conexao())->conectar();

$aluno = [
    'id' => '',
    'nome' => '',
    'idade' => '',
    'nota' => ''
];

if (isset($_POST['id'])) {
    $id = $_POST['id'];
    $stmt = $conn->prepare("SELECT * FROM alunos WHERE id = :id");
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    $aluno = $stmt->fetch(PDO::FETCH_ASSOC);
}

if (isset($_POST['atualizar'])) {
    $id = $_POST['id'];
    $nome = $_POST['nome'];
    $idade = $_POST['idade'];
    $nota = $_POST['nota'];

    $sql = "UPDATE alunos SET nome = :nome, idade = :idade, nota = :nota WHERE id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':nome', $nome);
    $stmt->bindParam(':idade', $idade);
    $stmt->bindParam(':nota', $nota);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();

    echo "<p style='text-align:center; color:green;'>Aluno atualizado com sucesso!</p>";
    echo "<p style='text-align:center;'><a href='view.php'>Voltar</a></p>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Editar Aluno</title>
</head>
<body style="text-align:center;">
    <h2>Editar aluno</h2>

    <form method="POST" action="">
        <input type="hidden" name="id" value="<?php echo htmlspecialchars($aluno['id']); ?>">
        <input type="text" name="nome" value="<?php echo htmlspecialchars($aluno['nome']); ?>" placeholder="Nome"><br><br>
        <input type="number" name="idade" value="<?php echo htmlspecialchars($aluno['idade']); ?>" placeholder="Idade"><br><br>
        <input type="number" name="nota" value="<?php echo htmlspecialchars($aluno['nota']); ?>" placeholder="Nota"><br><br>
        <button type="submit" name="atualizar">Salvar alterações</button>
    </form>

    <p><a href="view.php">Voltar</a></p>
</body>
</html>
