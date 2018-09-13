<div class="container-fluid mt-3">
    <h2>
        Oglasi korisnika <?php echo $this->escape($this->currentUser['name']); ?>
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

                    if (strtotime($ad['expires_at']) < time()) {
                        $adView->expired = true;
                    } else {
                        $adView->expired = false;
                    }
                    if (strtotime($ad['expires_at']) < strtotime('+5 days') && isset($me) && $me['id'] == $_GET['user'] && !$adView->expired) {
                        $adView->expiresSoon = true;
                    } 

                    echo $adView;
                }
            ?>
                </div>
            <?php
        }
    ?>
</div>