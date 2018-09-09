<?php
if (!defined('IN_PAGE')) {
    die ('Otkud ti ovde?');
}

$error = null;

if (!empty($_POST)) {

    if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $error = 'E-Mail je neispravan';
    }

    if (!$_POST['password'] ) {
        $error = 'Unesite lozinku';
    }


    if (!$error) {
        $user = $db->login($_POST['email'], $_POST['password']);
        if ($user) {
            $_SESSION['loggedIn'] = true;
            $_SESSION['user'] = $user;
            if (isset($_GET['returnTo'])) {
                header('Location: index.php?page=' . $_GET['returnTo']);
                exit;
            }
        } else {
            $error = 'Uneli ste pogrešan E-Mail ili lozinku';
        }
    }
} 

include('layout/header.php');


?>

 <div class="container-fluid mt-3">
    <h2>
        Prijava
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
                    <label for="exampleInputEmail1">E-Mail adresa</label>
                    <input name="email" type="email" class="form-control" placeholder="Unesite E-Mail adresu" value=<?php echo $_POST['email']; ?>>
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Lozinka</label>
                    <input name="password" type="password" class="form-control" placeholder="Unesite lozinku">
                </div>
                
                <button type="submit" class="btn btn-primary">Prijavi se</button>
            </form>
    <?php
        } else {
            ?>
                 <div class="alert alert-success" role="alert">
                    Uspešno ste se prijavili
                </div>
            <?php
        }
    ?>
</div>