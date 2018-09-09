<?php
if (!defined('IN_PAGE')) {
    die ('Otkud ti ovde?');
}

$currentCategory = $db->getCategory($_GET['category']);

if (!$currentCategory) {
    include('pages/404.php');
} else {


    include('layout/header.php');

    ?>

    <div class="container-fluid mt-3">
        <h2>
            Oglasi za kategoriju <?php echo htmlspecialchars($currentCategory['name']); ?>
        </h2>
        <?php
            $ads = $db->getAds($_GET['category']);
            $chunks = array_chunk($ads, 3);

            foreach($chunks as $chunk){
                ?>
                    <div class="card-deck mb-3">
                <?php
                foreach($chunk as $ad) {
                    $adView = new View('views/components/ad.php');
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
    <?php
}