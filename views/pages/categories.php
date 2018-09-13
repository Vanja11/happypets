<div class="container-fluid mt-3">
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