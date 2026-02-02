<?php
$path = 'books.json';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $books = json_decode(file_get_contents($path), true);

    foreach ($books as &$book) {
        if ($book['id'] == $_POST['id']) {
            $book['title']  = $_POST['title'];
            $book['author'] = $_POST['author'];
            $book['year']   = $_POST['year'];
            break;
        }
    }

    file_put_contents($path, json_encode($books, JSON_PRETTY_PRINT));
    header("Location: index.php");
    exit;
}

if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit;
}

$books = json_decode(file_get_contents($path), true);
$bookToEdit = null;

foreach ($books as $book) {
    if ($book['id'] == $_GET['id']) {
        $bookToEdit = $book;
        break;
    }
}

if (!$bookToEdit) {
    header("Location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Editar livro</title>
    <link rel="stylesheet" href="update/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:ital,wght@0,100..800;1,100..800&display=swap" rel="stylesheet">
</head>
<body>
    <div class="container">
        <form action="update.php" method="post">
        <div class="form">
            <input type="hidden" name="id" value="<?= $bookToEdit['id'] ?>">

            <label>Título</label>
            <input type="text" name="title" value="<?= $bookToEdit['title'] ?>" required><br>

            <label>Autor</label>
            <input type="text" name="author" value="<?= $bookToEdit['author'] ?>" required><br>

            <label>Ano</label>
            <input type="number" name="year" value="<?= $bookToEdit['year'] ?>" required><br>

            <button type="submit">Atualizar</button>
        </div>
        </form>
    </div>

    
</body>
</html>
