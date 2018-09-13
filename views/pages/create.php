<div class="container-fluid mt-3">
    <h2>
        Dodavanje oglasa
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
                                    <option <?php echo $category['id'] == $this->postData['category'] ? 'selected' : ''; ?> value="<?php echo $category['id']; ?>"><?php echo $this->escape($category['name']); ?></option>
                                <?php
                            }
                        ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="title">Naslov oglasa</label>
                    <input name="title" type="text" class="form-control" placeholder="Unesite naslov oglasa" value=<?php echo $this->escape($this->postData['title']); ?>>
                </div>

                <div class="form-group">
                    <label for="description">Tekst oglasa</label>
                    <textarea name="description" class="form-control" placeholder="Unesite tekst oglasa"><?php echo $this->escape($this->postData['description']); ?></textarea>
                </div>

                <div class="form-group">
                    <label for="phone">Telefon</label>
                    <input name="phone" type="text" class="form-control" placeholder="Unesite telefon ukoliko se razlikuje od vašeg" value=<?php echo $this->escape($this->postData['phone']); ?>>
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
                    <a href="index.php?page=ad&ad=<?php echo $this->adId; ?>">Pogledaj oglas</a>
                </div>
            <?php
        }
    ?>
</div>