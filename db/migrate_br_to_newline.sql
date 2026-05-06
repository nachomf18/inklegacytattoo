-- Migrar descripciones de <br> a saltos de línea en la BD
UPDATE tatuadores SET descripcion = REPLACE(descripcion, '<br>', '\n');
