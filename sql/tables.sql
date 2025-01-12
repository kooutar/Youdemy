CREATE TABLE user (
    iduser INT PRIMARY KEY AUTO_INCREMENT,
    nom VARCHAR(255) NOT NULL,
    prenom VARCHAR(255) NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    role ENUM('etudiant', 'Enseignant', 'admin') NOT NULL,
    status ENUM('accepter', 'refuser', 'en attente'), -- pour le statut du compte prof
    EstActive BOOLEAN -- pour le statut du compte étudiant
);

create table tag(
    idtag int primary key AUTO_INCREMENT,
    tag varchar(255)
);
create table categorie(
    idcategorie int not null,
    categorie varchar(255),
    
)
create table cours(
    idcours int primary key AUTO_INCREMENT,
    titre varchar(255) NOT NULL,
    documentation text,
    path_vedio varchar(255),
    idcategorie int not null,
    foreign key idcategorie references categorie(idcategorie)
);
create table tag_cours(
    idcours int not null,
    idtag int not null,
    foreign key (idcours) references cours(idcours),
    foreign key (idtag) references tag(idtag),
    primary key(idcours,idtag)
);
