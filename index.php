<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AlunosCRUD</title>
    <link rel="stylesheet" href="style.css">
</head>
<body class="body">
    <div class="div-title">
    <h1 class="title">Cadastrar aluno</h1>
    </div>
    <form action="" method="POST" class="form">
            <h4 style="margin-right:310px">Nome</h4>
            <input type="text" name="nome" placeholder="Digite o nome aqui" class="input">
            <h4 style="margin-right:310px">Idade</h4>
            <input type="number" name="idade" placeholder="Digite a idade aqui" class="input">
            <h4 style="margin-right:310px">Nota</h4>
            <input type="number" name="nota" placeholder="Digite a nota aqui" class="input">
            <button type="submit" name="cadastrar" class="form-button">Cadastrar</button>
        </form>
    
    <div style="position:fixed; bottom: 20px; right: 20px; font-size:xx-large">
        <a class="a" href="view.php">Mostrar alunos</a>
    </div>
    <div class="div-formBack">
    </div>
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

?>