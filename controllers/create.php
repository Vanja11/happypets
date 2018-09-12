<?php
if (!defined('IN_PAGE')) {
    die ('Otkud ti ovde?');
}

$error = null;

if (!empty($_POST)) {
    if (!$_POST['category'] || $_POST['category'] === '') {
        $error = 'Odaberite kategoriju';
    } else if (!$_POST['title'] ) {
        $error = 'Unesite naslov oglasa';
    } else if (!$_POST['description'] ) {
        $error = 'Unesite tekst oglasa';
    } else if ($_POST['phone'] && strlen($_POST['phone']) < 9) {
        $error = 'Telefon mora sadržati najmanje 9 cifara';
    } else if ($_POST['phone'] && !is_numeric($_POST['phone'])) {
        $error = 'Telefon je neispravan';
    }


    if (!$error) {
        $adId = $db->create($_POST['category'], $_POST['title'], $_POST['description'], $_POST['phone'], $_FILES['photos']);
    }
} 

include('layout/header.php');
?>

 <div class="container-fluid mt-3">
    <h2>
        Dodavanje oglasa
    </h2>
    <?php
        if ($error || empty($_POST)) {
                if ($error) {
                    ?>
                        <div class="alert alert-danger" role="alert">
                            <?php echo $error; ?>
                        </div>
                    <?php
                }
            ?>
            <form method="POST" enctype="multipart/form-data">
               
                <div class="form-group">
                    <label for="category">Kategorija</label>
                    <select name="category" class="form-control" >
                        <option value="">Odaberite kategoriju</option>
                        <?php 
                            $categories = $db->getCategories();
                            foreach($categories as $category) {
                                ?>
                                    <option <?php echo $category['id'] == $_POST['category'] ? 'selected' : ''; ?> value="<?php echo $category['id']; ?>"><?php echo $category['name']; ?></option>
                                <?php
                            }
                        ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="title">Naslov oglasa</label>
                    <input name="title" type="text" class="form-control" placeholder="Unesite naslov oglasa" value=<?php echo $_POST['title']; ?>>
                </div>

                <div class="form-group">
                    <label for="description">Tekst oglasa</label>
                    <textarea name="description" class="form-control" placeholder="Unesite tekst oglasa"><?php echo $_POST['description']; ?></textarea>
                </div>

                <div class="form-group">
                    <label for="phone">Telefon</label>
                    <input name="phone" type="text" class="form-control" placeholder="Unesite telefon ukoliko se razlikuje od vašeg" value=<?php echo $_POST['phone']; ?>>
                </div>

                <div class="form-group">
                    <label>Slike</label>
                    <li class="list-group-item">
                        <input name="photos[]" type="file" class="form-control-file">
                    </li>
                    <li class="list-group-item">
                        <input name="photos[]" type="file" class="form-control-file">
                    </li>
                    <li class="list-group-item">
                        <input name="photos[]" type="file" class="form-control-file">
                    </li>
                    <li class="list-group-item">
                        <input name="photos[]" type="file" class="form-control-file">
                    </li>
                    <li class="list-group-item">
                        <input name="photos[]" type="file" class="form-control-file">
                    </li>
                </div>

                

                
                <button type="submit" class="btn btn-primary">Postavi oglas</button>
            </form>
    <?php
        } else {
            ?>
                 <div class="alert alert-success" role="alert">
                    Vaš oglas je uspešno postavljen.<br>
                    <a href="index.php?page=ad&ad=<?php echo $adId; ?>">Pogledaj oglas</a>
                </div>
            <?php
        }
    ?>
</div>