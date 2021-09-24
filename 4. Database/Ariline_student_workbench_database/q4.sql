SELECT
ft.fight_no,COUNT(*) as numberOfflights
FROM flight_table as ft 
INNER JOIN airport_table as at_dep ON ft.departure_airport_code=at_dep.airport_code
INNER JOIN airport_table as at_arv ON ft.arrival_airport_code=at_arv.airport_code
INNER JOIN air_line_table as alt ON alt.air_line_code=ft.fight_no
WHERE at_dep.airport_name="Brisbane International Airport" and at_arv.airport_name="Sydney Airport"
