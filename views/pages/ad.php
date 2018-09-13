<?php
    if (!defined('IN_PAGE')) {
        die('Ovo nije dozvoljeno');
    }
?>
<div class="container-fluid mt-3">
    <h2>
        <?php echo $this->escape($this->ad['title']); ?>
    </h2>
    <div class="row">
        <div class="col-sm">
            <p>
                <?php echo nl2br($this->escape($this->ad['description'])); ?>
            </p>

            <p>
                Ovog ljubimca možete usvojiti pozivom na <strong><?php echo $this->escape($this->ad['phone'] ? $this->ad['phone'] : $this->ad['uphone']); ?> (<?php echo $this->escape($this->ad['name']); ?>)</strong>
            </p>
            <p>
                <a href="index.php?page=user&user=<?php echo $this->ad['users_id']; ?>">Svi oglasi korisnika <strong><?php echo $this->escape($this->ad['name']); ?></strong>
            </p>
        </div>
        <div class="col-sm">
        <div id="carousel" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                <?php
                foreach ($this->photos as $key => $photo) {
                    ?>
                <div class="carousel-item <?php echo $key === 0 ? 'active' : ''; ?>">
                    <img class="d-block w-100" src="uploads/<?php echo $photo['path']; ?>" alt="">
                </div>
                <?php 
            }
            ?>
            </div>
            <a class="carousel-control-prev" href="#carousel" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Prethodna</span>
            </a>
            <a class="carousel-control-next" href="#carousel" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Sledeća</span>
            </a>
            </div>
            </div>
    </div>
</div>