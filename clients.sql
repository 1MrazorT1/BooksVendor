CREATE TABLE client (
    code_client SERIAL PRIMARY KEY,
    nom          VARCHAR(50) NOT NULL,
    prenom       VARCHAR(50) NOT NULL,
    adresse      TEXT,
    cp           VARCHAR(10),
    ville        VARCHAR(50),
    pays         VARCHAR(50),
    date_inscription DATE DEFAULT CURRENT_DATE
);

CREATE TABLE panier (
    code_client     INTEGER NOT NULL,
    code_exemplaire INTEGER NOT NULL,
    quantite        INTEGER NOT NULL,
    PRIMARY KEY (code_client, code_exemplaire),
    CONSTRAINT fk_panier_client FOREIGN KEY (code_client)
        REFERENCES client (code_client),
    CONSTRAINT fk_panier_exemplaire FOREIGN KEY (code_exemplaire)
        REFERENCES exemplaire (code)
);

CREATE TABLE commande (
    code_client     INTEGER NOT NULL,
    code_exemplaire INTEGER NOT NULL,
    quantite        INTEGER NOT NULL,
    prix            NUMERIC(10,2) NOT NULL,
    date_commande   DATE DEFAULT CURRENT_DATE,
    PRIMARY KEY (code_client, code_exemplaire, date_commande),
    CONSTRAINT fk_commande_client FOREIGN KEY (code_client)
        REFERENCES client (code_client),
    CONSTRAINT fk_commande_exemplaire FOREIGN KEY (code_exemplaire)
        REFERENCES exemplaire (code)
);

