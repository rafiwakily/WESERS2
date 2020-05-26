use rafi;
create view peopleWithCountries as SELECT * FROM ppl 
JOIN countries on ppl.Nationality = countries.COUNTRY_ID