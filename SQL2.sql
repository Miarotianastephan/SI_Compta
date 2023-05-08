insert into plancomptable(idracinecompte,numerocompte,intitule)values 
(1,40110,'Frns d''exploitation locaux'),
(1,40120 ,'Frns d''exploitation étrangers'),
(1,40310 ,'Frns d''exploitation étrangers'),
(1,40810 ,'Frns expl.: facture à recevoir'),
(1,40910 ,'Frns: avances & acomptes'),
(1,40910 ,'Frns: avances & acomptes'),
(1,40980 ,'Frns: rabais à obtenir'),
(2,41110 ,'Clients locaux'),
(2,41120 ,'Clients étrangers'),
(2,41400 ,'Clients douteux'),
(2,41810 ,'Clients: facture à établir');

insert into plancomptable(idracinecompte,numerocompte,intitule)values 
(13,60000,'Achat'),
(13,61000,'Achat marchandise'),
(14,70000,'Vente');

insert into plancomptable(idracinecompte,numerocompte,intitule)values 
(10,44561,'TVAD'),
(10,44571,'TVAC');

insert into plancomptable(idracinecompte,numerocompte,intitule)values 
(11,51200,'Banque BOA');



-- achat
insert into ecriture_journaux(id_code_journaux,dat_ecriture,numero_piece,idcompte_general,idcompte_tier,libelle,iddevise,debit,credit,typeval)values
(1,'2023-03-01','CH/001',12,null,'Achat ps5',1,5000,0,0),
(1,'2023-03-01','CH/001',15,null,'Achat ps5',1,500,0,0),
(1,'2023-03-01','CH/001',1,5,'Achat ps5',1,5500,0,0);
insert into ecriture_journaux(id_code_journaux,dat_ecriture,numero_piece,idcompte_general,idcompte_tier,libelle,iddevise,debit,credit,typeval)values
(4,'2023-04-01','CH/001',1,5,'Reglement facture par cheque BOA aux fournisseur',1,5500,0,0),
(4,'2023-04-01','CH/001',17,null,'Reglement facture par cheque BOA aux fournisseur',1,0,5500,0);
-- vente
insert into ecriture_journaux(id_code_journaux,dat_ecriture,numero_piece,idcompte_general,idcompte_tier,libelle,iddevise,debit,credit,typeval)values
(1,'2023-03-06','FC/010',14,null,'Vente voiture',1,0,3500,0),
(1,'2023-03-06','FC/010',16,null,'Vente voiture',1,0,250,0),
(1,'2023-03-06','FC/010',8,7,'Vente voiture',1,0,3750,0);
-->

insert into journaux(code,intitule)values
('AC','Achats'),
('AN','A Nouveau'),
('BN','Banque BNI'),
('BO','Banque BOA'),
('CA','Caisse'),
('OD','Opérations diverses'),
('VL','Ventes locales'),
('VL','Ventes à l''exportaion');

insert into racine_compte(numerocompte,intitule,code)values
(10,'Capital','Ca'),--1
(11,'Report à nouveaux','Rep'),
(12,'Résultat','Res'),
(16,'Emprunts','Emp'),
(20,'Immo incorporel','incor'),
(21,'Immo corporel','cor'),
(3,'Stock','ST'),
(40,'Fournisseur','Fo'),
(41,'Client','Cl'),
(445,'TVA','T'),
(512,'Banque','Bn'),
(53,'Caisse','Ca'),
(6,'Charge','Ch'),
(7,'Produit','Pr'),
(766,'Gain de change','G'),
(666,'Perte de change','P'),
(77,'Produits extra','Ex'),
(67,'Charge extra','ChEx');

insert into compte_tier(idcompte_collectif,numerocompte,intitule)values
(1,'MASSIN','FRNS:MASSIN'),
(1,'KOTOITU','FRNS:KOTO'),
(8,'JOHN','CLT:JOHN'),
(8,'RABE','CLT:RABE');
 select *from compte_tier;
--  VIEW FOR INFO COMPTE TIER.
CREATE OR REPLACE VIEW info_tier as
select *from compte_tier t join plancomptable pl on t.idcompte_collectif=pl.id;


insert into societe(soc_name,soc_objet,capital,dirigeantID,soc_creationdate,soc_adresse,soc_emptotal,datedebut,devise_tenu_compte)
values 
('%s,%s,%s,%s,%s,%s,%s,%s,%s,%s');

insert into type_numero(libelle) values
('NIF'),
('STAT'),
('RCS');

insert into devise(nomdevise,taux,datecourant) values 
('Ariary',1,now()),
('Euro',2000,now()),
('Livre',2500,now());

-- OK
insert into S_detailscan(idsociete,idtype,numero,scanpdf) values 
(3,1,'013579','scan_nif.jpg'),
(3,2,'A01010','scan_stat.jpg'),
(3,3,'B98765','scan_rcs.jpg');
('%s,%s,%s,%s');
-- OK
insert into S_devisereference(idsociete,idref_devise) values 
('%s,%s');
-- OK
insert into S_phonelist(idsociete,phonenumber) values 
(3,0322232232),
(3,0340004500);
('%s,%s');
-- OK
insert into S_emaiList(idsociete,email) values 
(3,'dimpex_ent@yahoo.mg'),
(3,'dimpex_receps@gmail.mg');
('%s,%s');



insert into pointage_piece(references_piece,signification) values ('AC','Avoir Client');
insert into pointage_piece(references_piece,signification) values ('AF','Avoir Fournisseur');
insert into pointage_piece(references_piece,signification) values ('BE','Bordereau d'' escompte');
insert into pointage_piece(references_piece,signification) values ('CH','Chèque');
insert into pointage_piece(references_piece,signification) values ('FC','Facture Client');
insert into pointage_piece(references_piece,signification) values ('FF','Facture Fournisseur');
insert into pointage_piece(references_piece,signification) values ('LC','Lettre de change');



insert into pointage_piece(references_piece,signification) values ('PC','Pièce de caisse');
insert into pointage_piece(references_piece,signification) values ('RL','Relevé');
insert into pointage_piece(references_piece,signification) values ('SA','Salaire');
insert into pointage_piece(references_piece,signification) values ('VI','Virement');



--script d'insertion de la societe 
--non etape 1:
-- verification des informations si tous sont coorects
--ok etape 2:
-- insertion de la personne qui va diriger la societe
-- maka ny id an'iny avy inserer iny 
-- etape 3:
--ok inserer ny societe sy detail:
--non     . scan nif,stat,rcs 
--ok     . devis reference 
--     . email list
--     . phone list 
--     etape 4 verification si oke