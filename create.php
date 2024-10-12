<?php
$jsonData = file_get_contents('hats.json');
$hat = json_decode($jsonData, true);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the form data
    $name = $_POST['name'];
    $year = $_POST['year'];
    $price = $_POST['price'];
    $bio = $_POST['bio'];
    $details = $_POST['details'];

    // Handle file upload
    $uploadDir = 'images/'; // Directory where the image will be saved
    $uploadedFile = $uploadDir . basename($_FILES['picFile']['name']);

    // Move the uploaded file to the specified directory
    if (move_uploaded_file($_FILES['picFile']['tmp_name'], $uploadedFile)) {
        // If the upload is successful, prepare new hat entry
        $newHat = [
            'picFile' => $uploadedFile,
'name' => $name,
'year' => $year,
'price' => (float)$price, // Convert price to float for consistency
'bio' => $bio,
'details' => $details // Include details
];

// Find the next available index
$nextIndex = count($hat); // This will give the count, which is the next index
$hat[$nextIndex] = $newHat;

// Save the updated data back to the JSON file
$newJsonData = json_encode($hat, JSON_PRETTY_PRINT);
file_put_contents('hats.json', $newJsonData);

// Optionally redirect to avoid resubmission
header('Location: create.php');
exit();
} else {
echo "File upload failed!";
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
