<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Happy Pets</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="css/main.css" />
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
</head>

<body>
    <div class="fluid-container">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="index.php">Happy Pets</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="index.php">Pocetna</a>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false">
                            Udomljavanje Zivotinja
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <?php
                                $categories = $db->getCategories();
                                foreach($categories as $category) {
                                    ?>
                                        <a 
                                            class="dropdown-item <?php 
                                                echo $_GET['page'] === 'category' && $_GET['category'] == $category['id'] ? 'active' : ''; 
                                            ?>" 
                                            href="index.php?page=category&category=<?php echo $category['id']; ?>"
                                        >
                                          <?php echo $category['name']; ?>
                                        </a>
                                    <?php
                                }
                            ?>
                        </div>
                    </li>
                </ul>
                <span class="navbar-text">
                    <ul class="navbar-nav mr-auto">
                        <?php
                            if ($_SESSION['loggedIn']) {
                                ?>
                                    <li class="nav-item">
                                        <a class="nav-link <?php echo $_GET['page'] === 'create' ? 'active' : ''; ?>" href="index.php?page=create">Dodaj oglas</a>
                                    </li>
                                    <li class="nav-item">
                                     <a class="nav-link" href="index.php?page=logout">Odjavi se</a>
                                    </li>
                                <?php
                            } else {
                                ?>
                                    <li class="nav-item">
                                        <a class="nav-link <?php echo $_GET['page'] === 'register' ? 'active' : ''; ?>" href="index.php?page=register">Registracija</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link <?php echo $_GET['page'] === 'login' ? 'active' : ''; ?>" href="index.php?page=login">Prijava</a>
                                    </li>
                                <?php
                            }

                            ?>
                    </ul>
                </span>
            </div>
        </nav>