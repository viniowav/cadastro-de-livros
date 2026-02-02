<?php
include_once "dao/DAO.php";
include_once "controller/Controller.php";

$dao = new DAO();
$controller = new Controller($dao);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller->store($_POST);
    header("Location: index.php");
    exit;
}

// Não sei pq isso ta AQUI mas funciona
if (isset($_GET['delete'])) {
    $controller->delete((int) $_GET['delete']);
}

if (isset($_POST['insert'])) {
    $controller->store($_POST);
}

if (isset($_POST['update'])) {
    $controller->update((array) $_GET['update']);
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:ital,wght@0,100..800;1,100..800&display=swap" rel="stylesheet">
    <title>Cadastro de livros</title>
</head>
<body>
    <div class="container">

        <div class="navbar">
            <div class="container">
                <a href="#" class="nav">
                    Cadastro de livros
                </a>
            </div>
        </div>

<form action="index.php" method="post">
    <div class="form">
        <label>ID</label>
        <input type="number" name="id" required><br>

        <label>Título</label>
        <input type="text" name="title" required><br>

        <label>Autor</label>
        <input type="text" name="author" required><br>

        <label>Ano de publicação</label>
        <input type="number" name="year" required><br>

        <button type="submit">Cadastrar</button>
    </div>
</form>

<div class="table">
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Título</th>
                <th>Autor</th>
                <th>Ano</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($dao->read() as $book): ?>
                <tr>
                    <td><?=$book['id']?></td>
                    <td><?=$book['title']?></td>
                    <td><?=$book['author']?></td>
                    <td><?=$book['year']?></td>
                    <td>
                        <span class="delete-btn">
                            <a href="index.php?delete=<?= $book["id"] ?>">Excluir</a>
                        </span>

                        <span class="edit-btn">
                            <a href="update.php?id=<?= $book["id"] ?>">Editar</a>
                        </span>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
</body>
</html>
