DROP DATABASE IF EXISTS catalogo_connessioni_rete;
CREATE DATABASE catalogo_connessioni_rete;

USE catalogo_connessioni_rete;

CREATE TABLE utente
(
    nome_login VARCHAR(25) PRIMARY KEY,
    pass VARCHAR(32) NOT NULL,
    nome VARCHAR(25) NOT NULL,
    cognome VARCHAR(25) NOT NULL,
    ruolo ENUM('Amministratore','Operatore','Viewer') NOT NULL
);

CREATE TABLE switch
(
    id VARCHAR(25) PRIMARY KEY,
    modello VARCHAR(25) NOT NULL,
    posizione VARCHAR(60) NOT NULL,
    numero_porte INT NOT NULL
);

CREATE TABLE cavo
(
    id INT,
    tipo VARCHAR(35),
    descrizione VARCHAR(80) DEFAULT '-',
    PRIMARY KEY(tipo, id)
);

CREATE TABLE dispositivo
(
    id INT,
    tipo VARCHAR(35),
    descrizione VARCHAR(80) DEFAULT '-',
    PRIMARY KEY(tipo, id)
);

CREATE TABLE porta
(
    switch_id VARCHAR(25),
    numero_porta INT,
    cavo_tipo VARCHAR(35),
    dispositivo_tipo VARCHAR(35),
    PRIMARY KEY (switch_id, numero_porta),
    FOREIGN KEY (switch_id) REFERENCES switch(id),
    FOREIGN KEY (cavo_tipo) REFERENCES cavo(tipo),
    FOREIGN KEY (dispositivo_tipo) REFERENCES dispositivo(tipo)
);

INSERT INTO utente VALUES('Admin', 'fa838cb64417ac5d8eedc7112d54e11c', 'Admin', 'Admin', 'Amministratore');

DROP USER IF EXISTS 'switchroot'@'localhost';
CREATE USER 'switchroot'@'localhost' IDENTIFIED BY 'Password&1';
GRANT ALL ON catalogo_connessioni_rete.* TO 'switchroot'@'localhost';