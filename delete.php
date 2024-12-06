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

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $stmt = $pdo->prepare("DELETE FROM Hats WHERE id = :id");
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
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title text-center">Delete Hat</h5>
                        <p>Are you sure you want to delete this hat?</p>
                        <ul>
                            <li><strong>Name:</strong> <?= htmlspecialchars($hat['name']); ?></li>
                            <li><strong>Year:</strong> <?= htmlspecialchars($hat['year']); ?></li>
                            <li><strong>Price:</strong> <?= htmlspecialchars($hat['price']); ?></li>
                        </ul>
                        <form action="delete.php?id=<?= $hatId; ?>" method="POST">
                            <button type="submit" class="btn btn-danger w-100">Delete Hat</button>
                        </form>
                        <a href="index.php" class="btn btn-secondary w-100 mt-2">Cancel</a>
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
