CREATE OR REPLACE FUNCTION inscription(
  p_nom    VARCHAR,
  p_prenom VARCHAR,
  p_adresse TEXT,
  p_cp      VARCHAR,
  p_ville   VARCHAR,
  p_pays    VARCHAR
) RETURNS INTEGER AS $$
DECLARE
    v_code INTEGER;
BEGIN
    SELECT code_client INTO v_code
      FROM client
     WHERE nom = p_nom
       AND prenom = p_prenom
       AND adresse = p_adresse;
       
    IF FOUND THEN
       RETURN 0;
    ELSE
       INSERT INTO client(nom, prenom, adresse, cp, ville, pays, date_inscription)
       VALUES (p_nom, p_prenom, p_adresse, p_cp, p_ville, p_pays, CURRENT_DATE)
       RETURNING code_client INTO v_code;
       
       RETURN v_code;
    END IF;
END;
$$ LANGUAGE plpgsql;

