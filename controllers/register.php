<?php
if (!defined('IN_PAGE')) {
    die ('Otkud ti ovde?');
}

$error = null;

if (!empty($_POST)) {
    if (!$_POST['name'] || strlen($_POST['name']) < 2) {
        $error = 'Ime mora sadržati najmanje 2 karaktera';
    }

    if (!$_POST['phone'] || strlen($_POST['phone']) < 9) {
        $error = 'Telefon mora sadržati najmanje 9 cifara';
    }

    if (!is_numeric($_POST['phone'])) {
        $error = 'Telefon je neispravan';
    }

    if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $error = 'E-Mail je neispravan';
    }

    if (!$_POST['password'] || strlen($_POST['password']) < 6) {
        $error = 'Lozinka mora sadržati najmanje 6 karaktera';
    }
} 

include('layout/header.php');
?>

 <div class="container-fluid mt-3">
    <h2>
        Registracija
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
            <form method="POST">
                <div class="form-group">
                    <label for="exampleInputEmail1">Ime</label>
                    <input name="name" type="text" class="form-control" placeholder="Unesite ime" value=<?php echo $_POST['name']; ?>>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Telefon</label>
                    <input name="phone" type="text" class="form-control" placeholder="Unesite telefon" value=<?php echo $_POST['phone']; ?>>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">E-Mail adresa</label>
                    <input name="email" type="email" class="form-control" placeholder="Unesite E-Mail adresu" value=<?php echo $_POST['email']; ?>>
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Lozinka</label>
                    <input name="password" type="password" class="form-control" placeholder="Unesite lozinku">
                </div>
                
                <button type="submit" class="btn btn-primary">Registruj se</button>
            </form>
    <?php
        } else {
            $db->register($_POST['name'], $_POST['phone'], $_POST['email'], $_POST['password']);
            ?>
                 <div class="alert alert-success" role="alert">
                    Registracija je uspešno završena, sada se možete <a href="index.php?page=login">prijaviti</a>
                </div>
            <?php
        }
    ?>
</div>