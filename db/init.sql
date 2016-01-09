CREATE TABLE booker
(
    bookerId BIGINT(20) UNSIGNED PRIMARY KEY NOT NULL,
    nom VARCHAR(20),
    info VARCHAR(100),
    motdepasse VARCHAR(100) NOT NULL
);
CREATE UNIQUE INDEX bookerId ON booker (bookerId);
CREATE TABLE groupe
(
    groupeId BIGINT(20) UNSIGNED PRIMARY KEY NOT NULL,
    nom VARCHAR(50),
    description VARCHAR(1000),
    bookerId BIGINT(20) UNSIGNED NOT NULL,
    CONSTRAINT groupe_booker_fk FOREIGN KEY (bookerId) REFERENCES booker (bookerId)
);
CREATE UNIQUE INDEX groupeId ON groupe (groupeId);
CREATE INDEX groupe_bookerId_index ON groupe (bookerId);
CREATE TABLE organisateur
(
    orgaId BIGINT(20) UNSIGNED PRIMARY KEY NOT NULL,
    nom VARCHAR(20),
    mail VARCHAR(50),
    tel VARCHAR(10),
    adresse VARCHAR(100),
    cp VARCHAR(5),
    Ville VARCHAR(50)
);
CREATE UNIQUE INDEX orgaId ON organisateur (orgaId);
CREATE TABLE evenement
(
    evenementId BIGINT(20) UNSIGNED PRIMARY KEY NOT NULL,
    nom VARCHAR(50),
    date VARCHAR(50),
    adresseLieu VARCHAR(100),
    villeLieu VARCHAR(100),
    cpLieu VARCHAR(100),
    description VARCHAR(1000),
    organisateurId BIGINT(20) UNSIGNED,
    CONSTRAINT evenement_organisateur_fk FOREIGN KEY (organisateurId) REFERENCES organisateur (orgaId)
);
CREATE UNIQUE INDEX evenementId ON evenement (evenementId);
CREATE INDEX evenement_organisateur_fk ON evenement (organisateurId);
CREATE TABLE artistes
(
    artisteId BIGINT(20) UNSIGNED PRIMARY KEY NOT NULL,
    nom VARCHAR(20),
    prenom VARCHAR(20),
    role VARCHAR(20),
    tel VARCHAR(10),
    adresse VARCHAR(100),
    cp VARCHAR(5),
    ville VARCHAR(100),
    description VARCHAR(1000),
    groupeId BIGINT(20) UNSIGNED,
    CONSTRAINT artistes_groupe_fk FOREIGN KEY (groupeId) REFERENCES groupe (groupeId)
);
CREATE UNIQUE INDEX artisteId ON artistes (artisteId);
CREATE INDEX artistes_groupe_fk ON artistes (groupeId);
CREATE TABLE participe
(
    participeId BIGINT(20) UNSIGNED PRIMARY KEY NOT NULL,
    groupeId BIGINT(20) UNSIGNED,
    evenementId BIGINT(20) UNSIGNED,
    CONSTRAINT participe_evenement_fk FOREIGN KEY (evenementId) REFERENCES evenement (evenementId),
    CONSTRAINT participe_groupe_fk FOREIGN KEY (groupeId) REFERENCES groupe (groupeId)
);
CREATE UNIQUE INDEX participeId ON participe (participeId);
CREATE INDEX participe_evenement_fk ON participe (evenementId);
CREATE INDEX participe_groupe_fk ON participe (groupeId);
CREATE TABLE paiement
(
    paiementId BIGINT(20) UNSIGNED PRIMARY KEY NOT NULL,
    montant INT(11),
    paiementDate VARCHAR(20),
    groupeId BIGINT(20) UNSIGNED,
    orgaId BIGINT(20) UNSIGNED,
    CONSTRAINT paiement_groupe_fk FOREIGN KEY (groupeId) REFERENCES groupe (groupeId),
    CONSTRAINT paiement_orga_fk FOREIGN KEY (orgaId) REFERENCES organisateur (orgaId)
);
CREATE UNIQUE INDEX paiementId ON paiement (paiementId);
CREATE INDEX paiement_groupe_fk ON paiement (groupeId);
CREATE INDEX paiement_orga_fk ON paiement (orgaId);
CREATE TABLE actualites
(
    id BIGINT(20) UNSIGNED PRIMARY KEY NOT NULL,
    titre VARCHAR(100),
    contenu VARCHAR(5000)
);
CREATE UNIQUE INDEX id ON actualites (id);