<?php
session_start();

$host = 'localhost';
$dbname = 'myhats';
$username = 'root';
$password = '';

if (!isset($_SESSION['admin']) || $_SESSION['admin'] != 1) {
    header('Location: index.php');
}

if (isset($_GET['id'])) {
    $hatId = $_GET['id'];

    try {
        $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $pdo->prepare("SELECT * FROM Hats WHERE id = :id");
        $stmt->bindParam(':id', $hatId, PDO::PARAM_INT);
        $stmt->execute();
        $hat = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$hat) {
            echo "<div class='alert alert-danger text-center' role='alert'>Hat not found.</div>";
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = $_POST['name'];
            $year = $_POST['year'];
            $price = $_POST['price'];
            $bio = $_POST['bio'];
            $details = $_POST['details'];

            if (isset($_FILES['picFile']) && $_FILES['picFile']['error'] == UPLOAD_ERR_OK) {
                $uploadDir = 'images/';
                $uploadedFile = $uploadDir . basename($_FILES['picFile']['name']);
                move_uploaded_file($_FILES['picFile']['tmp_name'], $uploadedFile);
                $imageAddress = $uploadedFile;
            } else {
                $imageAddress = $hat['imageAddress'];
            }

            $stmt = $pdo->prepare("UPDATE Hats SET name = :name, year = :year, price = :price, bio = :bio, details = :details, imageAddress = :imageAddress WHERE id = :id");
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':year', $year);
            $stmt->bindParam(':price', $price);
            $stmt->bindParam(':bio', $bio);
            $stmt->bindParam(':details', $details);
            $stmt->bindParam(':imageAddress', $imageAddress);
            $stmt->bindParam(':id', $hatId, PDO::PARAM_INT);
            $stmt->execute();

            header('Location: index.php');
        }
    } catch (PDOException $e) {
        echo "<div class='alert alert-danger text-center' role='alert'>Database Connection Error: " . $e->getMessage() . "</div>";
    }
} else {
    echo "<div class='alert alert-danger text-center' role='alert'>No hat ID specified.</div>";
}
?>

<!DOCTYPE html>
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
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title text-center">Edit Hat</h5>
                        <form action="edit.php?id=<?= $hatId; ?>" method="POST" enctype="multipart/form-data">
                            <div class="mb-3">
                                <label for="name" class="form-label">Hat Name</label>
                                <input type="text" class="form-control" id="name" name="name" value="<?= htmlspecialchars($hat['name']); ?>" required>
                            </div>

                            <div class="mb-3">
                                <label for="year" class="form-label">Year</label>
                                <input type="text" class="form-control" id="year" name="year" value="<?= htmlspecialchars($hat['year']); ?>" required>
                            </div>

                            <div class="mb-3">
                                <label for="price" class="form-label">Price</label>
                                <input type="text" class="form-control" id="price" name="price" value="<?= htmlspecialchars($hat['price']); ?>" required>
                            </div>

                            <div class="mb-3">
                                <label for="bio" class="form-label">Bio</label>
                                <textarea class="form-control" id="bio" name="bio" required><?= htmlspecialchars($hat['bio']); ?></textarea>
                            </div>

                            <div class="mb-3">
                                <label for="details" class="form-label">Details</label>
                                <textarea class="form-control" id="details" name="details" required><?= htmlspecialchars($hat['details']); ?></textarea>
                            </div>

                            <div class="mb-3">
                                <label for="picFile" class="form-label">Upload New Image (Optional)</label>
                                <input type="file" class="form-control" id="picFile" name="picFile" accept="image/*">
                            </div>

                            <button type="submit" class="btn btn-primary w-100">Save Changes</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</article>

<footer class="bg-dark text-white text-center py-3">
    <div class="container">
        <p class="mb-0">&copy; 2024 Do Not Steal My Work Inc. All rights reserved.</p>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
