--compte general 5 caractères
--compte intitulé,libelle 35 caractères
--compte de tiers 13 caractères
create table person(
    Id serial primary key,
    namelead varchar(100),
    adress varchar(250),
    phone int,
    mail varchar(100)
);

create table devise(
    Id serial primary key,
    nomdevise varchar(100),
    taux float,
    dateCourant date
);

create table historicDevise(
    Id serial primary key,
    idDevise int,
    ancTaux float,
    ancDate date,
    foreign key (idDevise) references devise (Id)
);


create table societe(
    Id serial primary key,
    soc_name varchar(350),--'DIMPLEX'
    soc_objet text,--
    capital float,
    dirigeantID int,--FK_id person
    soc_creationdate date,--maintenant
    soc_adresse varchar(500),
    soc_emptotal int,
    datedebut date,
    devise_tenu_compte int,--FK devise
    --PCG int,--plan comptable general
    --nompcg varchar(200),
    foreign key (dirigeantID) references person(Id),
    foreign key (devise_tenu_compte) references devise(Id)
);

--mis a jour 
create table type_numero(
    Id serial primary key,
    libelle varchar(255)
);
create table S_detailscan(
    Id serial primary key,
    idsociete int,
    idtype int,
    numero varchar(255),
    scanpdf varchar(255),  
    foreign key(idsociete) references societe(Id),
    foreign key(idtype) references type_numero(Id)   
);

--
create table S_deviseReference(
    Id serial primary key,
    idsociete int,
    idref_devise int,
    foreign key (idsociete) references societe(Id),
    foreign key (idref_devise) references devise(Id)
);

create table S_phonelist(
    Id serial primary key,
    idsociete int,
    phonenumber int,
    foreign key (idsociete) references societe(Id)
);

create table S_emaiList(
    Id serial primary key,
    idsociete int,
    email varchar(250),
    foreign key (idsociete) references societe(Id)
);

create table racine_compte(
    Id serial primary key,
    numerocompte int,
    intitule varchar(50),
    code varchar(50)
);
--COMPTE GENERAL 
create table plancomptable(
    Id serial primary key,
    idracinecompte int,
    numerocompte int,--ne doit pas depasser 5 caractères (Manipulation via bdd)
    intitule varchar(255),--ne doit pas depasser 35 caractères (Manipulation via bdd)
    foreign key (idracinecompte) references racine_compte(Id)
);
--

--mis ajour compte collectif des tiers
--COMPTE COLLECTIF DES TIERS
--COMPTE AUXILLIAIRE
create table compte_tier(
    Id serial primary key,
    idcompte_collectif int,
    numerocompte varchar(255) unique,--ne doit pas depasser 13 caractères (Manipulation via bdd)
    intitule varchar(255),
    foreign key(idcompte_collectif) references plancomptable(Id)
);
--  
create table journaux(
    Id serial primary key,
    code varchar(2),
    intitule varchar(255)
);

create table ecriture_journaux(
    Id serial primary key,
    id_code_journaux int,
    dat_ecriture date,
    numero_piece varchar(255),--13 caractères maximum 
    --si misy tier de verifiena 
    --sinon le compte generaux ihany no verifieny 
    idcompte_general int, 
    idcompte_tier int default null, 
    --------------------------------------------->
    libelle text,--35 caractères au maximum
    iddevise int default null,
    debit float ,
    credit float,
    typeval int,
    foreign key (id_code_journaux) references journaux(Id),
    foreign key (iddevise) references devise(Id),
    foreign key (idcompte_general) references plancomptable(Id),
    foreign key (idcompte_tier) references compte_tier(Id)
);

create table pointage_piece(
    Id serial primary key,
    references_piece varchar(2),
    signification varchar(255)
);

-- to verify the length of one number
CREATE OR REPLACE FUNCTION limitNumber(my_number INTEGER, length_limit INTEGER)
RETURNS BOOLEAN AS $$
BEGIN
  IF LENGTH(CAST(my_number AS TEXT)) <= length_limit THEN
    RETURN TRUE;
  ELSE
    RETURN FALSE;
  END IF;
END;
$$ LANGUAGE plpgsql;

--verify if a value is already exist 
CREATE OR REPLACE FUNCTION check_value_exists(table_name TEXT, column_name TEXT, value_to_check TEXT)
RETURNS BOOLEAN AS $$
DECLARE
  value_exists BOOLEAN;
BEGIN
  SELECT EXISTS (
    SELECT 1 FROM
    (SELECT DISTINCT column_name FROM table_name) t
    WHERE t.column_name = value_to_check
  ) INTO value_exists;
  RETURN value_exists;
END;
$$ LANGUAGE plpgsql;