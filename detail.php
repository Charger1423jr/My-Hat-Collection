<?php
$host = 'localhost';
$dbname = 'myhats';
$username = 'root';
$password = '';

session_start();

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if (isset($_GET['id']) && is_numeric($_GET['id'])) {
        $id = intval($_GET['id']);
        
        $stmt = $pdo->prepare('SELECT * FROM Hats WHERE id = :id');
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $hat = $stmt->fetch(PDO::FETCH_ASSOC);
    }
} catch (PDOException $e) {
    echo "<div class='alert alert-danger text-center' role='alert'>Database Connection Error: " . $e->getMessage() . "</div>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My Hat</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>

<header class="bg-light py-3">
    <div class="container">
        <h2 class="text-center">My Hat Collection</h2>
        <nav class="nav justify-content-center">
            <a class="nav-link active" aria-current="page" href="index.php">Home</a>
            

            <?php if (isset($_SESSION['admin']) && $_SESSION['admin'] == 1): ?>
                <a class="nav-link" href="create.php">Add</a>
                <a class="nav-link" href="edit.php?id=<?= $hat['id']; ?>" tabindex="-1">Edit</a>
                <a class="nav-link" href="delete.php?id=<?= $hat['id']; ?>" tabindex="-1">Delete</a>
            <?php else: ?>

                <a class="nav-link text-muted" href="#" tabindex="-1" aria-disabled="true">Add</a>
                <a class="nav-link text-muted" href="#" tabindex="-1" aria-disabled="true">Edit</a>
                <a class="nav-link text-muted" href="#" tabindex="-1" aria-disabled="true">Delete</a>
            <?php endif; ?>
        </nav>
    </div>
</header>

<hr>

<main class="container">

    <?php if (isset($hat)): ?>
        <article>
            <h1 style="text-align: center"><?= htmlspecialchars($hat['name']); ?> Hat</h1>
            <h3 style="text-align: center"><?= htmlspecialchars($hat['year']); ?> | $<?= number_format($hat['price'], 2); ?></h3>
            <hr>
            <div style="text-align: center;">
                <img src="<?= htmlspecialchars($hat['imageAddress']); ?>" style="width: 200px; height: 250px; border: 5px black solid" alt="Image of <?= htmlspecialchars($hat['name']); ?>">
            </div>
            <h5 style="margin-top: 15px; margin-left: 15px; margin-right: 15px"><?= htmlspecialchars($hat['bio']); ?></h5>
            <h5 style="margin-left: 15px; margin-right: 15px"><?= htmlspecialchars($hat['details']); ?></h5>
        </article>
    <?php else: ?>
        <p class="text-center">Sorry, the requested hat details could not be found.</p>
    <?php endif; ?>
</main>

<footer class="bg-dark text-white text-center py-3">
    <div class="container">
        <p class="mb-0">&copy; 2024 Do Not Steal My Work Inc. All rights reserved.</p>
    </div>
</footer>

</body>
</html>
