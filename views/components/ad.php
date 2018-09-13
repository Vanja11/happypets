<?php
    if (!defined('IN_PAGE')) {
        die('Ovo nije dozvoljeno');
    }
?>

<div class="card" style="width: 18rem;">
    <?php
        if ($this->ad['path']) {
            ?>
                <img class="card-img-top" src="uploads/<?php echo $this->ad['path']; ?>" alt="<?php echo $this->escape($this->ad['title']); ?>">
            <?php
        } else {
            ?>
                <img class="card-img-top" src="images/no-photo-available.png" alt="<?php echo $this->escape($this->ad['title']); ?>">
            <?php
        }
    ?>
    
    <div class="card-body">
        <h5 class="card-title"><?php echo $this->escape($this->ad['title']); ?></h5>
        <p>
            <?php echo nl2br($this->escape($this->ad['description'])); ?>
        </p>

        <?php if ($this->expired) {
            ?>
                <div class="alert alert-danger" role="alert">
                    Oglas je istekao. <a onclick="return renewAd(<?php echo $this->ad['id']; ?>, this)" href="#" class="alert-link">Obnovi oglas</a>.
                </div>
            <?
            }
        ?>
        <?php if ($this->expiresSoon) {
            ?>
                <div class="alert alert-warning" role="alert">
                    Oglas uskoro ističe. <a onclick="return renewAd(<?php echo $this->ad['id']; ?>, this)" href="#" class="alert-link">Obnovi oglas</a>.
                </div>
            <?
            }
        ?>
    </div>
    <div class="card-footer">
        <div class="row">
            <div class="col">
                <a href="index.php?page=ad&ad=<?php echo $this->ad['id']; ?>" class="btn btn-secondary btn-block">Otvori oglas</a>
            </div>
            <?php
                if (isset($_SESSION['user']) && $_SESSION['user']['id'] == $this->ad['users_id']) {
                    ?>
                        <div class="col">
                            <a onclick="return deleteAd(<?php echo $this->ad['id']; ?>, this)" href="#" class="btn btn-danger btn-block">Obriši oglas</a>
                        </div>
                        <div class="col">
                            <a href="index.php?page=edit&ad=<?php echo $this->ad['id']; ?>" class="btn btn-warning btn-block">Izmeni oglas</a>
                        </div>
                    <?php
                }
            ?>
        </div>
    </div>
    <div class="card-footer">
        <small class="text-muted">
            <span class="float-left">
                Od <a href="index.php?page=user&user=<?php echo $this->ad['users_id']; ?>"><?php echo $this->escape($this->ad['name']); ?></a>
            </span>
            <span class="float-right">
                Postavljen <?php echo date('d.m.Y.', strtotime($this->ad['created_at'])); ?> 
            </span>
        </small>
    </div>
</div>