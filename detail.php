<?php
    $jsonData=file_get_contents('hats.json');
    $hat=json_decode($jsonData, true);

    if (isset($_GET['id'])) {
        $i = $_GET['id'];
        ?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My Hat</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <header>
        <?php
        echo '
            <ul class="nav justify-content-end">
                <h2>My Hat Collection</h2>
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="create.php">Add</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="edit.php?id=' . $i . '">Edit</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="delete.php?id=' . $i .'">Delete</a>
                </li>
            </ul>
        </header>
    <hr>
        <article>
            <h1 style="text-align: center">' . $hat[$i]['name'] . ' Hat</h1>
            <h3 style="text-align: center">' . $hat[$i]['year'] . ' | $' . $hat[$i]['price'] . '</h3>
            <hr>
            <div style="text-align:center">
                <img src="' . $hat[$i]['picFile'] . '" style="width: 200px; height: 250px; border: 5px black solid">
            </div>
            <h5 style="margin-top:15px; margin-left:15px; margin-right: 15px">' . $hat[$i]['bio'] . '</h5>
            <h5 style="margin-left:15px; margin-right: 15px">' . $hat[$i]['details'] . '</h5>
            ';
            ?>
        </article>
 <?php } ?>
    <footer class="bg-dark text-white text-center py-3">
        <div class="container">
            <p class="mb-0">&copy; 2024 Do Not Steal My Work Inc. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>
