<?php
    if (!defined('IN_PAGE')) {
        die('Ovo nije dozvoljeno');
    }
?>
<div class="container-fluid mt-3">
    <h2>
        Prijava
    </h2>
    <?php
        if ($this->error || !$this->isPosted) {
                if ($this->error) {
                    ?>
                        <div class="alert alert-danger" role="alert">
                            <?php echo $this->error; ?>
                        </div>
                    <?php
                }
            ?>
            <form method="POST">
                <div class="form-group">
                    <label for="exampleInputEmail1">E-Mail adresa</label>
                    <input name="email" type="email" class="form-control" placeholder="Unesite E-Mail adresu" value=<?php echo $this->escape($this->postData['email']); ?>>
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