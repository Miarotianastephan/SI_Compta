liste des tables:person()
                devise()
                historicDevise()
                societe()
                type_numero()
                S_detailscan()
                S_deviseReference()
                S_phonelist()
                S_emaiList()
                racine_compte()
                plancomptable()
                -- code_compte_collectif()
                -- compte_collectif()
                compte_tier()
                journaux()
                ecriture_journaux()

create or replace view v_societe_dirigeant as
select p.namelead,p.addres,p.phone,p.mail from societe s join person p on s.dirigeantid= p.id;

create or replace view v_societe_info_and_devise as 
select s.id,s.soc_name,s.soc_objet,s.capital,s.dirigeantid,s.soc_creationdate,s.soc_adresse,s.soc_emptotal,s.datedebut,d.id iddevise,d.nomdevise,d.taux,d.datecourant from societe s
join devise d on d.id=s.devise_tenu_compte;

select * from v_societe_info_and_devise;

create or replace view v_societe_info_devise_ref as 
select dr.id,d.id iddevise,dr.idsociete,d.nomdevise,d.taux,d.datecourant from S_deviseReference dr 
join devise d on d.id=dr.idref_devise;

select * from v_societe_info_devise_ref;

update plancomptable set idracinecompte=8 where idracinecompte=1;
create or replace view v_plan_tier as 
select  cpt.id , 
        cpt.idcompte_collectif idplancompte , 
        pl.idracinecompte , 
        pl.numerocompte cpt_num_gen , 
        pl.intitule intitule_gen , 
        cpt.numerocompte cpt_num_aux , 
        cpt.intitule intitule_aux
from compte_tier cpt
join plancomptable pl on pl.id=cpt.idcompte_collectif;

create or replace view v_compte_tier_alldetail as 
select  pl.id , 
        pl.idplancompte,
        rc.numerocompte , 
        rc.intitule , 
        rc.code , 
        pl.cpt_num_gen , 
        pl.intitule_gen , 
        pl.cpt_num_aux , 
        pl.intitule_aux
from v_plan_tier pl 
join racine_compte rc on rc.id=pl.idracinecompte;

select * from v_plan_tier;
select * from v_compte_tier_alldetail;

-- View Plan comptable ne contenant que les plan des tiers 
create or replace view v_plan_compta_tier as 
select pl.id,
pl.idracinecompte,
rcp.numerocompte racine_num,
rcp.intitule racine_intitule,
pl.numerocompte plancompta_num,
pl.intitule plancompta_intitule,
rcp.code
from plancomptable pl 
join racine_compte rcp on pl.idracinecompte=rcp.id
where rcp.numerocompte=40 or rcp.numerocompte=41;

select * from v_plan_compta_tier;