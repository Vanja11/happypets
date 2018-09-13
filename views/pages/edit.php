<?php
    if (!defined('IN_PAGE')) {
        die('Ovo nije dozvoljeno');
    }
?>
<div class="container-fluid mt-3">
    <h2>
        Izmena oglasa <?php echo $this->escape($this->ad['title']); ?>
    </h2>
    <?php
        if ($this->error || !$this->posted) {
                if ($this->error) {
                    ?>
                        <div class="alert alert-danger" role="alert">
                            <?php echo $this->error; ?>
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
                            foreach($this->categories as $category) {
                                ?>
                                    <option <?php echo $category['id'] == (isset($this->postData['category']) ? $this->postData['category'] : $this->ad['categories_id']) ? 'selected' : ''; ?> value="<?php echo $category['id']; ?>"><?php echo $this->escape($category['name']); ?></option>
                                <?php
                            }
                        ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="title">Naslov oglasa</label>
                    <input name="title" type="text" class="form-control" placeholder="Unesite naslov oglasa" value="<?php echo isset($this->postData['title']) ? $this->postData['title'] : $this->ad['title']; ?>">
                </div>

                <div class="form-group">
                    <label for="description">Tekst oglasa</label>
                    <textarea name="description" class="form-control" placeholder="Unesite tekst oglasa"><?php echo $this->escape(isset($this->postData['description']) ? $this->postData['description'] : $this->ad['description']); ?></textarea>
                </div>

                <div class="form-group">
                    <label for="phone">Telefon</label>
                    <input name="phone" type="text" class="form-control" placeholder="Unesite telefon ukoliko se razlikuje od vašeg" value="<?php echo isset($this->postData['phone']) ? $this->postData['phone'] : $this->ad['phone']; ?>">
                </div>

                <div class="form-group">
                    <label>Slike</label>
                    <ul class="list-group list-group-flush">
                        <?php 
                            foreach($this->photos as $photo) {
                                ?>
                                    <li class="list-group-item">
                                        <img width="100" src="uploads/<?php echo $photo['path']; ?>" /> 
                                        <a href="#" onclick="return deletePhoto(<?php echo $photo['id']; ?>, this)">Obriši</a>
                                    </li>
                                <?php
                            }
                            $count = count($this->photos);
                            for ($i = 0; $i < 5 - $count; $i++) {
                                ?>
                                    <li class="list-group-item">
                                        <input name="photos[]" type="file" class="form-control-file">
                                    </li>
                                <?php
                            }
                        ?>
                        
                    </ul>
                </div>

                

                
                <button type="submit" class="btn btn-primary">Sačuvaj oglas</button>
            </form>
    <?php
        } else {
            ?>
                 <div class="alert alert-success" role="alert">
                    Vaš oglas je uspešno izmenjen.<br>
                    <a href="index.php?page=ad&ad=<?php echo $this->ad['id']; ?>">Pogledaj oglas</a>
                </div>
            <?php
        }
    ?>
</div>