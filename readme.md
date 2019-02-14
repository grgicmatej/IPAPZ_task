Upute:
Dodatne upute i pojašnjena uz glavne upute

Nužne funkcionalnosti
--
javno
	- statistika zauzetosti djelatnika unutar radnog vremena
	- task (staviti koliko traje jedan task)
	- statistika koliko je odrađeno sve skupa(taskova/projekata) u nekom vremenskom razdoblju 
	
privatno
	- user kreira (sam sebi) task.
	- admin kreira taskove drugima, određuje kojem useru (sebi ne, da bi sebi kreirao, mora si promjeniti ulogu)
		- task ima kategoriju, status izvršenja, kratak opis, tagove(n)
		- admin može birati u kojoj roli radi (user/admin)
		- dodjeljuje određenom useru
		- user moze odbiti task, admin to vidi preko statusa izvršenja
	- admin može CRUD svega (kategorija, status, tag, opis, vrijeme izvrsenja...)

Poželjne funkcionalnosti
--
Točka 6:
	- rad sa slikama
		- svakom tasku se može dodjeliti galerija slika, 
		- admin može vidjeti slike, 
		- User koji je kreirao ili je zadužen za neki task, može vidjeti slike
		- Useri koji nisu napravili/dobili taj task, ne mogu vidjeti njegove slike
		- Drugi useri mogu vidjeti samo Naziv i kratak opis taska
		
	
Opcionalne funkcionalnosti
--
Dodatne upute:
	- kreiranje QR koda
		- Kod registracije usera, generira se qr kod kao profilna slika (default) svaki korisnik to moze zamjeniti
	- PDF izvještaj
		- izvještaj po jednom tasku (u izvještaju se nalaze ime, opis, autor, slike i sve ostale info od taska)
	- MS excel
		- excel tablica ispisuje sve taskove sa datumima (u dobrom formatu) početka i kraja
		- list (sheet) se zove "podaci".
	- funkcionalnost putem ajaxa
	- spajanje API
		- svakom tasku se može dodjeliti jedan pokemon, kreator taska sam odabire koji
	- Kreiranje REST API
		- napraviti API za pretraživanje po taskovima i dodavanje slika u odabrani task
	- Slanje emaila
		- cron job svake noci u 04 sata gleda ne dovrsene taskove (sa isteklim vremenom izvrsenja) i 
		  salje email upozorenja tom useru o ne dovrsenom tasku

