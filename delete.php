<?php
$jsonData = file_get_contents('hats.json');
$hat = json_decode($jsonData, true);

$i = isset($_GET['id']) ? (int)$_GET['id'] : null;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['id'])) {
        $id = (int)$_POST['id'];
        unset($hat[$id]);
        $hat = array_values($hat);
        $newJsonData = json_encode($hat, JSON_PRETTY_PRINT);
        file_put_contents('hats.json', $newJsonData);
        header('Location: index.php');
        exit();
    }
}
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Delete Hat</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
<header>
    <ul class="nav justify-content-end">
        <h2>My Hat Collection</h2>
        <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="index.php">Home</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="create.php">Add</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="edit.php">Edit</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="delete.php">Delete</a>
        </li>
    </ul>
</header>
<hr>
<article>
    <div style="padding: 25px">
        <h1>Delete Hat</h1>
        <form action="delete.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?= htmlspecialchars($i); ?>"> <!-- Ensure $i is set correctly -->
            <input type="submit" value="Delete Hat Entry">
        </form>
    </div>
</article>

<footer class="bg-dark text-white text-center py-3">
    <div class="container">
        <p class="mb-0">&copy; 2024 Do Not Steal My Work Inc. All rights reserved.</p>
    </div>
</footer>
</body>
</html>
