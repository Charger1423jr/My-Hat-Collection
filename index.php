<?php
$host = 'localhost';
$dbname = 'myhats';
$username = 'root';
$password = '';

session_start();


if (isset($_GET['action']) && $_GET['action'] === 'logout') {
    session_unset();
    session_destroy();
    header('Location: index.php');
    exit();
}

try {

    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $pdo->query('SELECT id, imageAddress, name, price FROM Hats');
    $hats = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "<div class='alert alert-danger' role='alert'>Database Connection Error: " . $e->getMessage() . "</div>";
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title>My Hat Collection</title>
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
                    <?php else: ?>
                        <a class="nav-link text-muted" href="#" tabindex="-1" aria-disabled="true">Add</a>
                    <?php endif; ?>

                    <a class="nav-link text-muted" tabindex="-1" aria-disabled="true">Edit</a>
                    <a class="nav-link text-muted" tabindex="-1" aria-disabled="true">Delete</a>
                    

                    <?php if (isset($_SESSION['username'])): ?>
                        <a class="nav-link" href="index.php?action=logout">Sign Out</a>
                    <?php else: ?>
                        <a class="nav-link active" href="login.php">Log In</a>
                    <?php endif; ?>
                </nav>
            </div>
        </header>

        <hr>

        <main class="container">
            <?php if (isset($_SESSION['username'])): ?>

                <p class="text-center">Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</p>
            <?php endif; ?>

            <div class="card-container" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(150px, 1fr)); gap: 20px;">
                <?php
                if (!empty($hats)) {
                    foreach ($hats as $hat) {
                        echo '
                        <div class="card" style="width: 150px;">
                            <img src="' . htmlspecialchars($hat['imageAddress']) . '" class="card-img-top" style="width:150px; height:200px;" alt="Image of ' . htmlspecialchars($hat['name']) . '">
                            <div class="card-body">
                                <h5 class="card-title">' . htmlspecialchars($hat['name']) . '</h5>
                                <p class="card-text">$' . number_format($hat['price'], 2) . '</p>
                                <a href="detail.php?id=' . htmlspecialchars($hat['id']) . '" class="btn btn-primary">Learn More</a>
                            </div>
                        </div>
                        ';
                    }
                } else {
                    echo '<p class="text-center">No hats found in your collection.</p>';
                }
                ?>
            </div>
        </main>

        <footer class="bg-dark text-white text-center py-3">
            <div class="container">
                <p class="mb-0">&copy; 2024 Do Not Steal My Work Inc. All rights reserved.</p>
            </div>
        </footer>
    </body>
</html>
