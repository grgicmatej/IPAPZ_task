Upute:
javno:

	-statistika zauzetosti djelatnika unutar radnog vremena
		task (staviti koliko traje jedan task)
	-statistika koliko je odrađeno sve skupa(projekt) u nekom vremenskom razdoblju 
	
privatno
	-user kreira (sam sebi) task.
		task ima kategoriju, status izvršenja, kratak opis, tagove(n)
	-admin kreira taskove drugima (sebi ne)
		drugi mogu odbiti task, dodjeljuje određenom useru, admin to vidi preko statusa izvršenja
		admin može birati u kojoj roli radi (user/admin)
		admin unosi crud kategorije, statuse, tagove
		admin može sve CRUD.

--
Poželjno 6:
	rad sa slikama
		svakom tasku se može dodjeliti galerija slika, admin može vidjeti slike, 
		korisnik može vidjeti slike, drugi useri (koji nisu napravili taj task) ne mogu vidjet
		useri mogu vidjeti opise taskova drugih usera
		qr kod kreiranje za svakog usera(to je default dok user ne zamjeni svojom ako želi)
izvještaj:
	task izvještaj (po jednom sa svim info)
ms excel
	excel prikazuje sve taskove sa datumima (datum u excelu mora biti tip-datetime) početka i kraja, list se zove podaci("sheet 1")

funkcionalnost putem ajaxa
	
opcionalno 7 - svakom tasku se može dodjeliti jedan pokemon (dati izbor)

opcionalno 8 - napravi api za trazenje taskova i dodavanje nove slike u postojeci task

opc 9 - cron job svake noci u 4 sata, gleda nedovrsene taskove a proslo je vrijeme izvrsenja i salje tom useru email upozorenja.
