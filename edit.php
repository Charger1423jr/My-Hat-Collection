<?php
$jsonData = file_get_contents('hats.json');
$hat = json_decode($jsonData, true);
if (isset($_GET['id'])) {
    $i = $_GET['id'];

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $hat[$i]['name'] = $_POST['name'];
        $hat[$i]['year'] = $_POST['year'];
        $hat[$i]['price'] = (float)$_POST['price'];
        $hat[$i]['bio'] = $_POST['bio'];
        $hat[$i]['details'] = $_POST['details'];
        $hat[$i]['picFile'] = $hat[$i]['picFile'];

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
    <title>Edit Hat</title>
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
        <h1>Edit Hat</h1>
        <form action="edit.php?id=<?= $i; ?>" method="POST" enctype="multipart/form-data">
            <label for="name">Hat Name:</label><br>
            <input type="text" id="name" name="name" value="<?= $hat[$i]['name']; ?>" required><br><br>

            <label for="year">Year:</label><br>
            <input type="text" id="year" name="year" value="<?= $hat[$i]['year']; ?>" required><br><br>

            <label for="price">Price:</label><br>
            <input type="text" id="price" name="price" value="<?= $hat[$i]['price'] ?>" required><br><br>

            <label for="bio">Bio:</label><br>
            <textarea id="bio" name="bio" required> <?= $hat[$i]['bio']; ?> </textarea><br><br>

            <label for="details">Details:</label><br>
            <textarea id="details" name="details" required> <?= $hat[$i]['details']; ?> </textarea><br><br>

            <input type="submit" value="Save Changes">
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
