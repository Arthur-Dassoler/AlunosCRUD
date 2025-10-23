<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AlunosCRUD</title>
</head>
<body style="text-align:center;">
    <h1>Informações de alunos</h1>
    <form action="" method="POST">
        <input type="text" name="nome" placeholder="Nome">
        <input type="number" name="idade" placeholder="Idade">
        <input type="number" name="nota" placeholder="Nota (Trimestre)">
        <button type="submit" name="cadastrar">Cadastrar</button>
        <button type="submit" name="mostrar">Mostrar alunos</button>
    </form>
</body>
</html>
<?php
require 'conexao.php';
$conn = (new Conexao())->conectar();

if (isset($_POST['cadastrar'])) {
    $nome = $_POST['nome'];
    $idade = $_POST['idade'];
    $nota = $_POST['nota'];


if (!empty($_POST['nome']) && !empty($_POST['idade']) && !empty($_POST['nota'])) {
    $sql = "INSERT INTO alunos (nome, idade, nota) VALUES (:nome, :idade, :nota)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(":nome", $nome);
    $stmt->bindParam(":idade", $idade);
    $stmt->bindParam(":nota", $nota);
    $stmt->execute();

    echo "Cadastro feito com sucesso!";
}
else {
    echo "Por favor, preencha todos os campos";
}
}

if (isset($_POST['mostrar'])) {
    $stmt = $conn->query("SELECT * FROM alunos");

    $alunos = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo "<h2>Alunos cadastrados:</h2>";
        echo "<table border='1' cellpadding='5' style='margin:0 auto;'>";
        echo "<tr><th>ID</th><th>Nome</th><th>Idade</th><th>Nota</th></tr>";

        foreach ($alunos as $aluno) {
            echo "<tr>";
            echo "<td>{$aluno['id']}</td>";
            echo "<td>{$aluno['nome']}</td>";
            echo "<td>{$aluno['idade']}</td>";
            echo "<td>{$aluno['nota']}</td>";
            echo "</tr>";
        }

        echo "</table>";
}
?>