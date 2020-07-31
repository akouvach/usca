SELECT * FROM (SELECT mensaje, JSON_EXTRACT(`emociones`,'$.1') AS likes fROM blogs WHERE id=1) temp
 WHERE  JSON_EXTRACT(`likes`,'$.cant')>2
/*
UPDATE blogs SET emociones = '"1":{"cant":2,"usuarios":[1,3]}, "2":{"cant":3,"usuarios":[1,3,8]}} ' WHERE id=1
*/


/*
SELECT * FROM blogs WHERE JSON_EXTRACT(`emociones`,'$.idUsuario.1')>0
*/

/*
UPDATE blogs SET emociones = json_array_append(`emociones`,"$",'{"idUsuario":1,{idEmocion":2, "fecha":"2020-05-05"}') WHERE id = 1
*/

/*
SELECT * FROM blogs WHERE id=1
*/


/*
SELECT mensaje, JSON_STORAGE_FREE(emociones) AS uno FROM blogs WHERE id=1
*/

/*
UPDATE blogs SET emociones = '{"1":{"cant":2,"usuarios":[1,3]},"2":{"cant":3,"usuarios":[1,3,8]}} ' WHERE id=1
*/

/*
SELECT JSON_EXTRACT(`emociones`,'$.1') fROM blogs WHERE id=1
*/



