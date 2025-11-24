<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Alunos em Recuperação</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <?php
    require 'conexao.php';
    $conn = (new Conexao())->conectar();


    $stmt = $conn->query("SELECT * FROM alunos WHERE nota < 7");
    $alunosRec = $stmt->fetchAll(PDO::FETCH_ASSOC);


    $qtd = count($alunosRec);

    echo '<h2 class="title">Alunos em recuperação: ' . $qtd . '</h2>';

    if ($qtd == 0) {
        echo "<p>Nenhum aluno está em recuperação.</p>";
    } else {

        echo '<table class="table">';
        echo "<tr><th>Nome</th><th>Idade</th><th>Nota</th></tr>";

        foreach ($alunosRec as $aluno) {
            echo "<tr>";
            echo "<td>{$aluno['nome']}</td>";
            echo "<td>{$aluno['idade']}</td>";
            echo "<td>{$aluno['nota']}</td>";
            echo "</tr>";
        }

        echo "</table>";
    }
    ?>

    <div style="margin-top:20px;">
        <a href="index.php">Voltar</a>
    </div>

</body>

</html>