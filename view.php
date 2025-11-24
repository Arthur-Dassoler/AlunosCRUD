<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Alunos</title>
</head>
<body>
    <?php
    require 'conexao.php';
    $conn = (new Conexao())->conectar();
	?>

    <div class="view-info">
        <?php 
        
    $stmt = $conn->query("SELECT nota FROM alunos");
    $notas = $stmt->fetchAll(PDO::FETCH_COLUMN);
    $m = count($notas) ? array_sum($notas)/count($notas) : 0;
    $media = number_format($m, 1, ',', '');
    echo '<h3 class="view-title">Dados gerais</h3>';
    echo "<p>Média: $media</p>";
        
        
        
   if (!empty($notas)) {
    $normalized = array_map('trim', $notas); // remove espaços estranhos
    $contagem = array_count_values($normalized);
    if (!empty($contagem)) {
        $modas = array_keys($contagem, max($contagem));
        $moda = $modas[0]; // primeira moda (se houver empate, pega a primeira)
        echo "<p>Moda: $moda</p>";
    } else {
        echo "<p>Moda: ---</p>";
    }
} else {
    echo "<p>Moda: ---</p>";
}
        
        
        
    $stmt = $conn->query("SELECT MAX(nota) FROM alunos");
    $maiorNota = $stmt->fetchColumn();
    $stmt = $conn->prepare("SELECT nome FROM alunos WHERE nota = :nota LIMIT 1");
    $stmt->bindParam(":nota", $maiorNota);
    $stmt->execute();
    $alunos = $stmt->fetchAll(PDO::FETCH_COLUMN);
    foreach ($alunos as $aluno) {
        echo "<p>Maior nota: $maiorNota | $aluno </p>";
    }

        

    $stmt = $conn->query("SELECT MIN(nota) FROM alunos");
    $menorNota = $stmt->fetchColumn();
    $stmt = $conn->prepare("SELECT nome FROM alunos WHERE nota = :nota LIMIT 1");
    $stmt->bindParam(":nota", $menorNota);
    $stmt->execute();
    $alunos = $stmt->fetchAll(PDO::FETCH_COLUMN);
    foreach ($alunos as $aluno) {
        echo "<p>Menor nota: $menorNota | $aluno </p>";
    }
    ?>
        <form action="recuperacao.php" method="GET">
    <button type="submit" class="form-button">Alunos em recuperação</button>
	</form>
    </div>

    <?php
    $stmt = $conn->query("SELECT * FROM alunos");
    $alunos = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo '<h2 class="title">Alunos cadastrados:</h2>';
    echo '<table class="table">';
    echo "<tr><th>Nome</th><th>Idade</th><th>Nota</th><th>Ações</th></tr>";

    foreach ($alunos as $aluno) {
        echo "<tr>";
        echo "<td>{$aluno['nome']}</td>";
        echo "<td>{$aluno['idade']}</td>";
        echo "<td>{$aluno['nota']}</td>";
        echo "<td>";
        echo "<form action='edit.php' method='POST' style='display:inline;'>
                <input type='hidden' name='id' value='{$aluno['id']}'>
                <button type='submit' class='form-button'>Editar</button>
              </form>";
        echo "<form action='delete.php' method='POST' style='display:inline;'>
                <input type='hidden' name='id' value='{$aluno['id']}'>
                <button type='submit' class='form-button' onclick='return confirm(\"Tem certeza que deseja excluir?\")'>Excluir</button>
              </form>";
        echo "</td>";
        echo "</tr>";
    }

    echo "</table>";
    ?>

    <div style="position:fixed; bottom: 20px; left: 20px; font-size:xx-large">
        <a href="index.php">Cadastrar aluno</a>
    </div>
</body>
</html>
