# Codeigniter Gravatar Library
Třída pro snadné zobrazení Gravataru v PHP frameworku Codeigniter.



## Instalace
Soubor `Gravatar.php` vložte do složky `application/libraries/`.



## Použití
Pro zjištění URL adresy k obrázku Gravataru je třeba nejdříve třídu inicializovat zápisem:

`$this->load->library('gravatar');`



poté je třeba nastavit pro jakou emailovou adresu se má Gravatar zobrazit:

`$this->gravatar->set_email('user@example.com');`



a zjistíme URL k obrázku:

`$image_url = $this->gravatar->get();`



ten můžeme pak zobrazit:

`<img src="<?= $image_url; ?>" alt="Gravatar">`



## Možné volby
Nastavení velikosti obrázku (výchozí velikost je 80x80 pixelů, maximum 2048)

`$this->gravatar->set_size(100); // 100x100 px`



Nastavení typu výchozího obrázku pokud není nahrán vlastní (výchozí "monsterid")

`$this->gravatar->set_type('wavatar'); // monsterid, wavatar, identicon, mm, 404`



Nastavení hodnocení obrázku (výchozí "g")

`$this->gravatar->set_rating('pg'); // g, pg, r, x`



## Příklad
```php
$this->load->library('gravatar');
$this->gravatar->set_email('user@example.com');
$this->gravatar->set_size(200);
$this->gravatar->set_type('identicon');
$img = $this->gravatar->get();
```
