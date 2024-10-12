<?php
    $jsonData=file_get_contents('hats.json');
    $hat=json_decode($jsonData, true);

        ?>

<html>
    <head>
        <title>My Hat Collection</title>
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
                    <a class="nav-link" style="color:gray" disabled>Edit</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" style="color:gray" disabled>Delete</a>
                </li>
            </ul>
        </header>
        <hr>
        <article>
            <div class="card-container" style="display: grid; grid-template-columns: repeat(5, 150px); column-gap: 100px; row-gap: 10px;">
                <?php
    for($i=0; $i < count($hat); $i++) {
        echo '
        <div class="card" style="width: 150px;">
                <img src="' . $hat[$i]['picFile'] . '" class="card-img-top" style="width:150px; height:200px">
                <div class="card-body">
                    <h5 class="card-title">' . $hat[$i]['name'] . '</h5>
                    <p class="card-text">$' . $hat[$i]['price'] . '</p>
                    <a href="detail.php?id=' . $i .'" class="btn btn-primary">Learn More</a>
                </div>
            </div>
            ';
            }
            ?>
           </div>

        </article>
        <footer class="bg-dark text-white text-center py-3">
            <div class="container">
                <p class="mb-0">&copy; 2024 Do Not Steal My Work Inc. All rights reserved.</p>
            </div>
        </footer>
    </body>
</html>
