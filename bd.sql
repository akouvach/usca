SELECT * 
FROM grupos
WHERE descripcion LIKE CONCAT('%','zouk','%') OR grupo LIKE CONCAT('%','zouk','%') OR tags LIKE CONCAT('%','zouk','%')
