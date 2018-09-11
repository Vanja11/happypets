# HappyPets :cat2: :poodle:
## Seminarski rad za kurs PHP Programiranje na IT Akademiji
### Autor: Valentina Gmitrović
E-Mail [gmitrovicvalentina1@gmail.com](mailto:gmitrovicvalentina1@gmail.com)

Github [Vanja11](https://github.com/Vanja11)

## Opis aplikacije
Aplikacija **HappyPets** je namenjena ljubiteljima životinja koji žele da pomognu napuštenim, bolesnim i na bilo koji drugi način ugroženim životinjama. Trenutna verzija aplikacije omogućava brzo i jednostavno postavljanje oglasa za udomljavanje napuštenih životinja i prikazivanje potencijalnim udomiteljima.

Ideja za ovakav projekat je potekla od činjenice da je na ulicama svih gradova u Srbiji previše životinja koje su neodgovorni vlasnici izbacili, kao i onih o kojima nema ko da brine ili leči, s obzirom da nadležne institucije nisu zainteresovane za rešavanje ovog problema. Mali broj ljudi ima želju da pomogne ovim životinjama, ali oni nailaze na prepreke, kako novčane prirode, tako i teškog pronalaženja domova za njih.

## Korišćene tehnologije
- PHP
- MySQL
- Bootstrap
- jQuery

## Funkcije aplikacije

### Početna stranica
Na početnoj stranici korisnik može videti osnovne informacije o aplikaciji, čemu je namenjena, kao i prečice za dodavanje oglasa i kategorije postavljenih oglasa.

### Registracija
Da bi korisnik mogao da postavlja oglase, neophodno je da se registruje. 

Forma za registraciju sadrži polja:

- Ime, potrebno je da sadrži najmanje 2 karaktera
- Telefon, može biti sačinjen od cifara, kojih mora imati najmanje 9
- E-Mail Adresa, mora biti ispravna E-Mail adresa
- Lozinka, mora sadržati najmanje 6 karaktera

Ukoliko neko od ovih polja nije validno, korisniku će se prikazati greška, kao i forma za registraciju sa već popunjenim poljima.

Nakon uspešne registracije, korisniku će biti prikazana poruka o uspešnoj registraciji sa instrukcijama za prijavljivanje na aplikaciju.

### Prijava
Nakon registracije, kao i prilikom ponovne posete, neophodno je da se korisnik prijavi na aplikaciju.

Forma za prijavu sadrži polja:

- E-Mail adresa koja je korišćena prilikom registracije
- Lozinka 

Nakon prijave, korisniku su dostupne opcije za dodavanje oglasa kao i za odjavljivanje sa aplikacije.

### Odjava
Kada korisnik želi da završi korišćenje aplikacije, može se odjaviti.

### Dodavanje oglsa
Prijavljeni korisnici imaju mogućnost dodavanja oglasa. Forma za dodavanje oglasa sadrži sledeća polja:

- Kategorija, padajući meni u kome su izlistane sve postojeće kategorije
- Naslov oglasa
- Tekst oglasa
- Telefon, nije obavezno polje. Ukoliko nije unet broj telefona, na oglasu će se prikazati broj telefona korisnika
- Slike, 5 file inputa

### Izmena oglasa
Ova stranica je identična stranici "Dodavanje oglasa", osim što su polja već popunjena informacijama o tom oglasu.

Takodje postoji i opcija uredjivanja već postavljenih fotografija (brisanje i dodavanje)

### Izlistavanje kategorije
Na ovoj stranici korisnik može videti oglase u odabranoj kategoriji. Oglas sadrži fotografiju, naslov, opis, ime korisnika koji je postavio oglas sa linkom do svih njegovih oglasa i datum postavljanja oglasa. 

Korisnik će takodje videti i dugme "Otvori oglas" koje će ga odvesti na detaljnije informacije o tom oglasu.

Ukoliko je oglas vlasništvo prijavljenog korisnika, dostupne su mu dodatne opcije:

- Obriši oglas
- Izmeni oglas
- Obnovi oglas (ova opcija se pojavljuje ukoliko je ostalo manje od 5 dana do isteka ili je oglas istekao)

Oglasi su prikazani u vidu mreže, gde se u jednom redu prikazuje najviše 3 oglasa.

#### Brisanje oglasa
Kada korisnik pritisne dugme "Obriši oglas", postavlja mu se pitanje da li je siguran. Ukoliko korisnik odgovori potvrdno, oglas se briše, a na njegovom mestu se pojavljuje poruka da je oglas uspešno obrisan. Ova poruka je vidljiva samo korisniku koji je obrisao oglas, i to dok ne napusti stranicu.

#### Izmena oglasa
Dugme vodi na stranicu [Izmena oglasa](###-Izmena-oglasa) 

#### Obnavljanje oglasa
Klikom na ovaj link, korisnik će obnoviti oglas na mesec dana, a poruka o isteku oglasa će se zameniti porukom o uspešnom obnavljanju oglasa.

### Izlistavanje oglasa korisnika
Ova stranica je identična stranici "Izlistavanje kategorije", ali umesto oglasa iz kategorije, prikazuju se svi oglasi izabranog korisnika.

### Oglas
Na ovoj stranici su prikazane sve informacije o oglasu i to:

- Naslov
- Opis
- Ime i broj telefona korisnika koji je postavio oglas
- Slideshow sa najviše 5 fotografija

### Kontakt
Kontakt forma putem koje će posetilac moći da kontaktira autora aplikacije.

Ukoliko je korisnik prijavljen, polja za ime i E-Mail adresu će biti popunjena i onemogućena.

## Struktura projekta

Projekat je baziran na MVC (Model-View-Controller) arhitekturi koja je za potrebe ovog projekta uprošćena.

### Direktorijumi
U sledećoj tabeli su izlistani direktorijumi sa opisom

| Naziv direktorijuma | Opis |
| --- | --- |
| [controllers](controllers) | Kontroleri, pripremaju podatke potrebne za prikaz stranice |
| [css](css) | Stilovi |
| [images](images) | Statičke slike |
| [js](js) | JavaScript biblioteke i skripte potrebne za funkcionisanje aplikacije |
| [layout](layout) | Kostur aplikacije (header i footer) |
| [lib](lib) | Biblioteke aplikacije |
| [uploads](uploads) | Direktorijum za upload fotografija |
| [views](views) | Kontroler koristi view za konačno oblikovanje i prikaz stranice ili elementa |


