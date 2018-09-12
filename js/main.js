function deleteAd(id, element) {

    if (confirm('Da li ste sigurni da želite da obrišete ovaj oglas?')) {
        $.ajax({
            url: 'ajax.php?func=deleteAd&ad=' + id,
        })
            .done(function () {
                $(element)
                    .parents('.card')
                    .append('<div class="deletedAd"><div class="alert alert-success" role="alert">Uspešno ste obrisali oglas</div></div>');
            });
    }

    return false;
}

function deletePhoto(id, element) {

    if (confirm('Da li ste sigurni da želite da obrišete ovu fotografiju?')) {
        $.ajax({
            url: 'ajax.php?func=deletePhoto&photo=' + id,
        })
            .done(function () {
                $(element)
                    .parent()
                    .replaceWith('<li class="list-group-item"><input name="photos[]" type="file" class="form-control-file"></li>');
            });
    }

    return false;
}

function renewAd(id, element) {
    $.ajax({
        url: 'ajax.php?func=renewAd&ad=' + id,
    })
        .done(function () {
            $(element)
                .parent()
                .replaceWith('<div class="alert alert-success" role="alert">Uspešno ste obnovili oglas</div>');
        });

    return false;
}