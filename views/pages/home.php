
<div class="container-fluid mt-3">
    <div class="jumbotron">
        <h1 class="display-4">Udomi me!</h1>
        <p class="lead">Ovaj sajt je namenjen svima onima koji žele da usvoje neku životinjicu kao i onima koji žele da oglase ljubimce za usvajanje.</p>
        <hr class="my-4">
        <p>Odaberite neku od kategorija kako biste pronašli svog novog ljubimca</p>
        <a class="btn btn-primary btn-lg" href="<?php
            if ($this->loggedIn) {
                echo 'index.php?page=create';
            } else {
                echo 'index.php?page=login&returnTo=create';
            }
        ?>" role="button">Postavi oglas</a>
    </div>
    <h2>
        Kategorije
    </h2>
    <?php
        foreach($this->categories as $category) {
            ?>
                <div class="card mr-3 mb-3 float-left" style="width: 18rem;">
                    <img class="card-img-top" src="images/categories/<?php echo $category['id']; ?>.jpg" alt="<?php echo $category['name']; ?>">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $category['name']; ?></h5>
                        <a href="index.php?page=category&category=<?php echo $category['id']; ?>" class="btn btn-primary">Otvori kategoriju</a>
                    </div>
                </div>
            <?php
        }
    ?>
</div>