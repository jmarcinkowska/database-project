create table lekarz(id_lekarza int, imie varchar, 
					nazwisko varchar, specjalizacja varchar,
				   miasto varchar, telefon varchar, haslo varchar,
				   primary key(id_lekarza)
				   );
				   
create table dyzur(id_dyzuru serial, id_lekarza int, 
				  dzien date, godzina_start varchar, godzina_koniec varchar,
				  primary key(id_dyzuru), CONSTRAINT  dyzur_id_lekarza_fkey FOREIGN KEY(id_lekarza) REFERENCES lekarz(id_lekarza) ON DELETE CASCADE);
				  
create table pacjent(id_pacjenta serial, imie varchar, nazwisko varchar,login varchar, haslo varchar, pesel varchar, 
					data_urodzenia date, miejsce_urodzenia varchar, primary key(id_pacjenta));
					
create table lekarstwa(id_lekarstwa serial, nazwa_lekarstwa varchar, dawka varchar,
					  primary key(id_lekarstwa));
					  
create table choroby(id_choroby serial, nazwa varchar, objawy varchar, leczenie varchar, 
					primary key(id_choroby));

create table leczenie(id_leczenia serial, opis varchar, id_choroby int, 
					primary key(id_lecznia), foreign key(id_choroby) references choroby(id_choroby));

create table gabinet(id_gabinetu serial, numer int, pietro int, id_dyzuru int,
					primary key(id_gabinetu), CONSTRAINT  gabinet_id_dyzuru_fkey FOREIGN KEY(id_dyzuru) REFERENCES dyzur(id_dyzuru) ON DELETE CASCADE);
				 
create table wizyta(id_wizyty serial, data_wizyty date, godzina time,
				   id_lekarza int, id_pacjenta int, primary key(id_wizyty), 
				   foreign key(id_lekarza) references lekarz(id_lekarza), 
				   foreign key(id_pacjenta) references pacjent(id_pacjenta));
				   	
create table choroby_lekarstwa(id_choroby_lekarstwa serial, id_choroby int, id_lekarstwa int, 
						primary key(id_choroby_lekarstwa), foreign key(id_choroby) references choroby(id_choroby), 
						foreign key(id_lekarstwa) references lekarstwa(id_lekarstwa) );

create table wizyta_choroby(id_wizyta_choroby serial, id_choroby  int, id_wizyty int, primary key(id_wizyta_choroby), 
						foreign key(id_choroby) references choroby(id_choroby), foreign key(id_wizyty) references wizyta(id_wizyty));



