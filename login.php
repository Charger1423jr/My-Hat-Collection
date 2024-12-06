<?php
$host = 'localhost';
$dbname = 'myhats';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $inputUsername = $_POST['username'] ?? '';
        $inputPassword = $_POST['password'] ?? '';

        $stmt = $pdo->prepare('SELECT * FROM Users WHERE username = :username LIMIT 1');
        $stmt->bindParam(':username', $inputUsername, PDO::PARAM_STR);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && $inputPassword === $user['password']) {

            session_start();
            $_SESSION['username'] = $user['username'];
            $_SESSION['admin'] = $user['adminStatus'];

            echo '<div class="alert alert-success text-center">Redirecting...</div>';
            header('refresh:3;url=index.php');
        } else {
            echo '<div class="alert alert-danger text-center">Invalid username or password.</div>';
        }
    }
} catch (PDOException $e) {
    echo "<div class='alert alert-danger text-center'>Database Connection Error: " . $e->getMessage() . "</div>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <header class="bg-light py-3">
        <div class="container">
            <h2 class="text-center">My Hat Collection</h2>
            <nav class="nav justify-content-center">
                <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                <a class="nav-link" href="create.php">Add</a>
                <a class="nav-link text-muted" tabindex="-1" aria-disabled="true">Edit</a>
                <a class="nav-link text-muted" tabindex="-1" aria-disabled="true">Delete</a>
                <a class="nav-link active" tabindex="-1" href="login.php">Log In</a>
            </nav>
        </div>
    </header>

    <hr>

    <main class="container">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title text-center">Login</h5>
                        <form action="login.php" method="POST">
                            <div class="mb-3">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" class="form-control" id="username" name="username" placeholder="Enter username" required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" name="password" placeholder="Enter password" required>
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Log In</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <footer class="bg-dark text-white text-center py-3">
        <div class="container">
            <p class="mb-0">&copy; 2024 Do Not Steal My Work Inc. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>
