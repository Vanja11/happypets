<?php
    if (!defined('IN_PAGE')) {
        die('Ovo nije dozvoljeno');
    }
?>
<div class="container-fluid mt-3">
    <h2>
        Oglasi za kategoriju <?php echo $this->escape($this->currentCategory['name']); ?>
    </h2>
    <?php
        foreach($this->chunks as $chunk){
            ?>
                <div class="card-deck mb-3">
            <?php
            foreach($chunk as $ad) {
                $adView = new View('views/components/ad.php', false);
                $adView->ad = $ad;
                $adView->currentCategory = $currentCategory;

                echo $adView;
            }
            ?>
                </div>
            <?php
        }
    ?>
</div>