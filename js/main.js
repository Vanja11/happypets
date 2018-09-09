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