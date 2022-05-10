DROP TABLE IF EXISTS Utilisateurs ;
CREATE TABLE Utilisateurs (id_Utilisateurs INT AUTO_INCREMENT NOT NULL,
prenom_Utilisateurs VARCHAR(32),
mdp_Utilisateurs TEXT,
age_Utilisateurs INT,
sexe_Utilisateurs VARCHAR(32),
email_Utilisateurs VARCHAR(128),
photo_Utilisateurs VARCHAR(32),
dateInscription_Utilisateurs DATETIME,
PRIMARY KEY (id_Utilisateurs)) ENGINE=InnoDB;

DROP TABLE IF EXISTS Compatible ;
CREATE TABLE Compatible (id_Match INT AUTO_INCREMENT NOT NULL, id_Utilisateurs_1 INT NOT NULL, id_Utilisateurs_2 INT NOT NULL,
date_Matchs DATETIME,
PRIMARY KEY (id_Match)) ENGINE=InnoDB;

DROP TABLE IF EXISTS Universite;
CREATE TABLE Universite (id_Universite INT AUTO_INCREMENT NOT NULL,
nom_Universite VARCHAR(32),
num_Departements INT,
PRIMARY KEY (id_Universite)) ENGINE=InnoDB;

DROP TABLE IF EXISTS Departements;
CREATE TABLE Departements (num_Departements INT AUTO_INCREMENT NOT NULL,
nom_Departements INT,
PRIMARY KEY (num_Departements)) ENGINE=InnoDB;

DROP TABLE IF EXISTS Questions;
CREATE TABLE Questions (id_Question INT AUTO_INCREMENT NOT NULL,
intitule_Question VARCHAR(128),
PRIMARY KEY (id_Question)) ENGINE=InnoDB;

DROP TABLE IF EXISTS Reponses ;
CREATE TABLE Reponses (idReponse_Reponses INT AUTO_INCREMENT NOT NULL,
reponse_Reponses VARCHAR(128),
id_Question INT,
PRIMARY KEY (idReponse_Reponses)) ENGINE=InnoDB;

DROP TABLE IF EXISTS ETUDIE_A ;
CREATE TABLE ETUDIE_A (id_Utilisateurs INT AUTO_INCREMENT NOT NULL,
id_Universite INT,
PRIMARY KEY (id_Utilisateurs,
 id_Universite)) ENGINE=InnoDB;

DROP TABLE IF EXISTS Repond ;
CREATE TABLE Repond (idReponse_Reponses INT AUTO_INCREMENT NOT NULL,
id_Utilisateurs INT NOT NULL,
PRIMARY KEY (idReponse_Reponses,
 id_Utilisateurs)) ENGINE=InnoDB;

ALTER TABLE Universite ADD CONSTRAINT FK_Universite_num_Departements FOREIGN KEY (num_Departements) REFERENCES Departements (num_Departements);

ALTER TABLE Reponses ADD CONSTRAINT FK_Reponses_id_Question FOREIGN KEY (id_Question) REFERENCES Questions (id_Question);
ALTER TABLE ETUDIE_A ADD CONSTRAINT FK_ETUDIE_A_id_Utilisateurs FOREIGN KEY (id_Utilisateurs) REFERENCES Utilisateurs (id_Utilisateurs);
ALTER TABLE ETUDIE_A ADD CONSTRAINT FK_ETUDIE_A_id_Universite FOREIGN KEY (id_Universite) REFERENCES Universite (id_Universite);
ALTER TABLE Compatible ADD CONSTRAINT FK_Compatible_id_Utilisateurs_1 FOREIGN KEY (id_Utilisateurs_1) REFERENCES Utilisateurs (id_Utilisateurs);
ALTER TABLE Compatible ADD CONSTRAINT FK_Compatible_id_Utilisateurs_2 FOREIGN KEY (id_Utilisateurs_2) REFERENCES Utilisateurs (id_Utilisateurs);
ALTER TABLE Repond ADD CONSTRAINT FK_Repond_idReponse_Reponses FOREIGN KEY (idReponse_Reponses) REFERENCES Reponses (idReponse_Reponses);
ALTER TABLE Repond ADD CONSTRAINT FK_Repond_id_Utilisateurs FOREIGN KEY (id_Utilisateurs) REFERENCES Utilisateurs (id_Utilisateurs);
