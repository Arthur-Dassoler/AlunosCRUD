<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <div style="position:fixed; bottom: 20px; right: 900px; font-size:xx-large">
        <a href="index.php">Cadastrar aluno</a>
    </div>

    <form action="" method="POST">
        <button name=media>Calcular média</button>
    </form>

    <form action="" method="POST">
        <button name=max>Mostrar maior nota</button>
    </form>

    <form action="" method="POST">
        <button name=min>Mostrar menor nota</button>
    </form>

</body>

</html>
<?php
require 'conexao.php';
$conn = (new Conexao())->conectar();

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
    echo "<td>";
    echo "<form action='editar.php' method='POST' style='display:inline;'>";
    echo   "<input type='hidden' name='id' value='{$aluno['id']}'>";
    echo    "<button type='submit'>Editar</button>";
    echo "</form>";
    echo "<form action='excluir.php' method='POST' style='display:inline;'>";
    echo   "<input type='hidden' name='id' value='{$aluno['id']}'>";
    echo   "<button type='submit' onclick='return confirm(\"Tem certeza que deseja excluir?\")'>Excluir</button>";
    echo "</form>";
    echo "</td>";
    echo "</tr>";
}

echo "</table>";

if (isset($_POST['media'])) {
    $stmt = $conn->query("SELECT nota FROM alunos");
    $notas = $stmt->fetchAll(PDO::FETCH_COLUMN);
    $media = array_sum($notas) / count($notas);
    echo "A média dessa turma é $media";
}

if (isset($_POST['max'])) {
    $stmt = $conn->query("SELECT MAX(nota) FROM alunos");
    $maiorNota = $stmt->fetchColumn();

    $stmt = $conn->prepare("SELECT nome FROM alunos WHERE nota = :nota");
    $stmt->bindParam(":nota", $maiorNota);
    $stmt->execute();

    $alunos = $stmt->fetchAll(PDO::FETCH_COLUMN);


    foreach ($alunos as $aluno) {
        echo "$aluno é o aluno(a) com a maior nota: $maiorNota<br>";
    }
}


if (isset($_POST['min'])) {
    $stmt = $conn->query("SELECT MIN(nota) FROM alunos");
    $menorNota = $stmt->fetchColumn();

    $stmt = $conn->prepare("SELECT nome FROM alunos WHERE nota = :nota");
    $stmt->bindParam(":nota", $menorNota);
    $stmt->execute();

    $alunos = $stmt->fetchAll(PDO::FETCH_COLUMN);


    foreach ($alunos as $aluno) {
        echo "$aluno é o aluno(a) com a menor nota: $menorNota<br>";
    }
}
?>