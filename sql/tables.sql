CREATE TABLE ROLES (
    id INT(11) PRIMARY KEY AUTO_INCREMENT,
    nom VARCHAR(50) NOT NULL
);
INSERT INTO roles (nom) VALUES
('etudiant'),
('enseignant'),
('admin');
CREATE TABLE user (
    iduser INT PRIMARY KEY AUTO_INCREMENT,
    nom VARCHAR(255) NOT NULL,
    prenom VARCHAR(255) NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    role INT (11) NOT NULL, 
    status ENUM('accepter', 'refuser', 'en attente'), -- pour le statut du compte prof
    EstActive BOOLEAN, -- pour le statut du compte étudiant
    FOREIGN KEY (role) REFERENCES roles(id)
);


create table categorie(
    idcategorie INT PRIMARY KEY AUTO_INCREMENT,
    categorie varchar(255)
    
);
CREATE TABLE cours (
    idcours INT PRIMARY KEY AUTO_INCREMENT,
    titre VARCHAR(255) NOT NULL,
    description VARCHAR(255) NOT NULL,
    path_image varchar(255) ,
    documentation TEXT,
    path_vedio VARCHAR(255),
    idcategorie INT NOT NULL,
    idEnseignant INT NOT NULL,
    status ENUM('accepter', 'refuser', 'en attente') DEFAULT 'en attente',
    dateCreation TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (idcategorie) REFERENCES categorie(idcategorie) on delete cascade,
    FOREIGN KEY (idEnseignant) REFERENCES user(iduser) on delete cascade
);



create table tag(
    idtag int primary key AUTO_INCREMENT,
    tag varchar(255)
);

create table tag_cours(
    idcours int not null,
    idtag int not null,
    foreign key (idcours) references cours(idcours) on delete cascade ,
    foreign key (idtag) references tag(idtag) on delete cascade,
    primary key(idcours,idtag)
);

create table inscrire(
  idEtudiant int not null,
  idcours int not null,
  foreign key (idcours) references cours(idcours) on delete cascade,
  FOREIGN KEY (idEtudiant) REFERENCES user(iduser) on delete cascade
);

CREATE OR REPLACE VIEW vuecours AS
SELECT 
    c.idcours,
    c.titre,
    c.description,
    c.path_image,
    c.documentation,
    c.path_vedio,
    c.status as statusCours,
    cat.categorie,
    prof.*
FROM 
    cours c
INNER JOIN 
    categorie cat
ON 
    c.idcategorie = cat.idcategorie
INNER JOIN 
    user prof
ON 
    prof.iduser = c.idEnseignant
INNER JOIN 
    tag_cours t_c
ON 
    c.idcours = t_c.idcours
INNER JOIN 
    tag t
ON 
    t.idtag = t_c.idtag;



ALTER TABLE cours 
add COLUMN status ENUM('accepter', 'refuser', 'en attente') DEFAULT 'en attente';
