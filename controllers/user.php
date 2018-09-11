<?php
if (!defined('IN_PAGE')) {
    die ('Otkud ti ovde?');
}
$me = $_SESSION['user'];

$currentUser = $db->getUser($_GET['user']);

if (!$currentUser) {
    include('pages/404.php');
} else {


    include('layout/header.php');

    ?>

    <div class="container-fluid mt-3">
        <h2>
            Oglasi korisnika <?php echo htmlspecialchars($currentUser['name']); ?>
        </h2>
        <?php
            $ads = $db->getAdsByUser($_GET['user']);
            $chunks = array_chunk($ads, 3);

            foreach($chunks as $chunk){
                ?>
                    <div class="card-deck mb-3">
                <?php
                    foreach($chunk as $ad) {
                        $adView = new View('views/components/ad.php');
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
    <?php
}