<?php
$jsonData = file_get_contents('hats.json');
$hat = json_decode($jsonData, true);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $year = $_POST['year'];
    $price = $_POST['price'];
    $bio = $_POST['bio'];
    $details = $_POST['details'];

    $uploadDir = 'images/';
    $uploadedFile = $uploadDir . basename($_FILES['picFile']['name']);

    if (move_uploaded_file($_FILES['picFile']['tmp_name'], $uploadedFile)) {
        $newHat = [
            'picFile' => $uploadedFile,
            'name' => $name,
            'year' => $year,
            'price' => (float)$price,
            'bio' => $bio,
            'details' => $details
];

$nextIndex = count($hat);
$hat[$nextIndex] = $newHat;

$newJsonData = json_encode($hat, JSON_PRETTY_PRINT);
file_put_contents('hats.json', $newJsonData);

header('Location: index.php');
exit();
} else {
echo "File Failed";
}
}
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add New Hat</title>
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
        <h1>Add a New Hat</h1>
        <form action="create.php" method="POST" enctype="multipart/form-data">
            <label for="name">Hat Name:</label><br>
            <input type="text" id="name" name="name" required><br><br>

            <label for="year">Year:</label><br>
            <input type="text" id="year" name="year" required><br><br>

            <label for="price">Price:</label><br>
            <input type="text" id="price" name="price" required><br><br>

            <label for="bio">Bio:</label><br>
            <textarea id="bio" name="bio" required></textarea><br><br>

            <label for="details">Details:</label><br>
            <textarea id="details" name="details" required></textarea><br><br>

            <label for="picFile">Upload Image:</label><br>
            <input type="file" id="picFile" name="picFile" accept="image/*" required><br><br>

            <input type="submit" value="Add Hat">
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
