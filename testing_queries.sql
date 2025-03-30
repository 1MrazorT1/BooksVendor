-- Question 2)a/
\set recherche 'Hu'
SELECT *
FROM auteurs
WHERE nom ILIKE '%' || :'recherche' || '%';

-- Question 2)b/
\set rechercheTitre 'Livre'
SELECT *
FROM ouvrage
WHERE nom ILIKE '%' || :'rechercheTitre' || '%';

-- Question 2)c/
\set codeAuteur 1
SELECT o.*
FROM ouvrage o
JOIN ecrit_par ep ON o.code = ep.code_ouvrage
WHERE ep.code_auteur = :'codeAuteur';

-- Question 2)d/
\set codeOuvrage 1
SELECT ed.nom AS editeur, e.prix
FROM exemplaire e
JOIN editeurs ed ON e.code_editeur = ed.code
WHERE e.code_ouvrage = :'codeOuvrage';

