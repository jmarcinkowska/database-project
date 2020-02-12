create or replace view lekarz_dyzury as SELECT * from projekt.lekarz l join projekt.dyzur d on l.id_lekarza = d.id_lekarza
    join projekt.gabinet g on d.id_dyzuru = g.id_dyzuru;

create or replace view pacjent_infor as SELECT p.id_pacjenta, w.id_wizyty, w.data_wizyty, l.imie, l.nazwisko, l.specjalizacja,
    wz.id_wizyta_choroby, c.id_choroby, c.nazwa, c.objawy, lecz.id_leczenia, lecz.opis, cl.id_choroby_lekarstwa, lek.id_lekarstwa, lek.nazwa_lekarstwa,
    lek.dawka from projekt.pacjent p join projekt.wizyta w on w.id_pacjenta = p.id_pacjenta join projekt.lekarz l on l.id_lekarza = w.id_lekarza join
    projekt.wizyta_choroby wz on w.id_wizyty = wz.id_wizyty join projekt.choroby c on c.id_choroby = wz.id_choroby join projekt.leczenie lecz 
    on lecz.id_choroby = c.id_choroby join projekt.choroby_lekarstwa cl on cl.id_choroby = c.id_choroby join projekt.lekarstwa lek on
    lek.id_lekarstwa = cl.id_lekarstwa;

create or replace view lekarz_wizyty as SELECT p.imie, p.nazwisko, p.pesel, p.id_pacjenta, w.id_wizyty,w.data_wizyty, l.id_lekarza, 
		wc.id_wizyta_choroby, c.id_choroby, c.nazwa, c.objawy, lecz.opis, cl.id_choroby_lekarstwa, lek.id_lekarstwa, lek.nazwa_lekarstwa,
		lek.dawka from projekt.pacjent p join projekt.wizyta w on w.id_pacjenta = p.id_pacjenta join projekt.lekarz l on l.id_lekarza = w.id_lekarza
        join projekt.wizyta_choroby wc on wc.id_wizyty = w.id_wizyty join projekt.choroby c on c.id_choroby = wc.id_choroby join projekt.leczenie lecz on
        lecz.id_choroby = c.id_choroby join projekt.choroby_lekarstwa cl on cl.id_choroby=c.id_choroby join projekt.lekarstwa lek on lek.id_lekarstwa = cl.id_lekarstwa;

create or replace view pacjent_wizyty as SELECT p.id_pacjenta, p.login, p.haslo, p.pesel, p.data_urodzenia, p.adres, w.id_wizyty, 
w.data_wizyty, w.godzina, l.id_lekarza, l.imie, l.nazwisko, l.specjalizacja, l.miasto, l.telefon from projekt.pacjent p join projekt.wizyta w on w.id_pacjenta = p.id_pacjenta
    join projekt.lekarz l on l.id_lekarza = w.id_lekarza;

create or replace view lek_wiz as SELECT w.data_wizyty, w.godzina, w.id_wizyty, w.id_lekarza,p.imie, p.nazwisko, p.pesel, p.adres from projekt.wizyta w join projekt.pacjent p on p.id_pacjenta = w.id_pacjenta;

CREATE OR REPLACE view lekarz_specjalizacja as SELECT specjalizacja from projekt.lekarz group by specjalizacja;

create or replace function zwolnij_lekarza(id_lek integer)
returns void
language plpgsql
as $body$
BEGIN
delete from projekt.lekarz where id_lekarza = $1;
END
$body$;

CREATE OR REPLACE FUNCTION wyswietl_lekarzy (spec varchar)
RETURNS SETOF projekt.lekarz 
LANGUAGE plpgsql 
AS '
BEGIN
   RETURN QUERY	
		SELECT * 
		FROM projekt.lekarz 
		WHERE specjalizacja = $1;
END;
';

CREATE OR REPLACE FUNCTION pacjent_rejestracja (im varchar, naz varchar, log varchar, pass varchar, pes varchar, dat date, adr varchar)
RETURNS void
LANGUAGE plpgsql 
AS '
BEGIN
		insert into projekt.pacjent(imie, nazwisko, login, haslo, pesel, data_urodzenia, adres)
        values($1, $2, $3, $4, $5, $6, $7);
END;
';

CREATE OR REPLACE FUNCTION pacjent_check (log varchar, pass varchar)
RETURNS SETOF projekt.pacjent 
LANGUAGE plpgsql 
AS '
BEGIN
   RETURN QUERY	
		SELECT * 
		FROM projekt.pacjent 
		WHERE login = $1 and haslo = $2;
END;
';

CREATE OR REPLACE FUNCTION lekarz_login (id integer, pass varchar)
RETURNS SETOF projekt.lekarz 
LANGUAGE plpgsql 
AS '
BEGIN
   RETURN QUERY	
		SELECT * 
		FROM projekt.lekarz 
		WHERE id_lekarza = $1 and haslo = $2;
END;
';

CREATE OR REPLACE FUNCTION pacjent_i (id integer)
RETURNS SETOF projekt.pacjent_infor 
LANGUAGE plpgsql 
AS '
BEGIN
   RETURN QUERY	
		SELECT * 
		FROM projekt.pacjent_infor 
		WHERE id_pacjenta = $1 and data_wizyty <= NOW();
END;
';

CREATE OR REPLACE FUNCTION wizyta_lek (id integer)
RETURNS SETOF projekt.lek_wiz 
LANGUAGE plpgsql 
AS '
BEGIN
   RETURN QUERY	
		SELECT * 
		FROM projekt.lek_wiz 
		WHERE id_lekarza = $1 and data_wizyty >= NOW();
END;
';

CREATE OR REPLACE FUNCTION dodaj_lekarstow (naz varchar, daw varchar)
RETURNS void
LANGUAGE plpgsql 
AS '
BEGIN
		INSERT into projekt.lekarstwa(nazwa_lekarstwa, dawka) values($1, $2);
END;
';

