--
-- PostgreSQL database dump
--

-- Dumped from database version 10.18
-- Dumped by pg_dump version 10.18

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET xmloption = content;
SET client_min_messages = warning;
SET row_security = off;

--
-- Name: plpgsql; Type: EXTENSION; Schema: -; Owner: 
--

CREATE EXTENSION IF NOT EXISTS plpgsql WITH SCHEMA pg_catalog;


--
-- Name: EXTENSION plpgsql; Type: COMMENT; Schema: -; Owner: 
--

COMMENT ON EXTENSION plpgsql IS 'PL/pgSQL procedural language';


--
-- Name: check_value_exists(text, text, text); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.check_value_exists(table_name text, column_name text, value_to_check text) RETURNS boolean
    LANGUAGE plpgsql
    AS $$
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
$$;


ALTER FUNCTION public.check_value_exists(table_name text, column_name text, value_to_check text) OWNER TO postgres;

--
-- Name: limitnumber(integer, integer); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.limitnumber(my_number integer, length_limit integer) RETURNS boolean
    LANGUAGE plpgsql
    AS $$
BEGIN
  IF LENGTH(CAST(my_number AS TEXT)) <= length_limit THEN
    RETURN TRUE;
  ELSE
    RETURN FALSE;
  END IF;
END;
$$;


ALTER FUNCTION public.limitnumber(my_number integer, length_limit integer) OWNER TO postgres;

SET default_tablespace = '';

SET default_with_oids = false;

--
-- Name: compte_tier; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.compte_tier (
    id integer NOT NULL,
    idcompte_collectif integer,
    numerocompte character varying(255),
    intitule character varying(255)
);


ALTER TABLE public.compte_tier OWNER TO postgres;

--
-- Name: compte_tier_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.compte_tier_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.compte_tier_id_seq OWNER TO postgres;

--
-- Name: compte_tier_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.compte_tier_id_seq OWNED BY public.compte_tier.id;


--
-- Name: devise; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.devise (
    id integer NOT NULL,
    nomdevise character varying(100),
    taux double precision,
    datecourant date
);


ALTER TABLE public.devise OWNER TO postgres;

--
-- Name: devise_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.devise_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.devise_id_seq OWNER TO postgres;

--
-- Name: devise_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.devise_id_seq OWNED BY public.devise.id;


--
-- Name: ecriture_journaux; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.ecriture_journaux (
    id integer NOT NULL,
    id_code_journaux integer,
    dat_ecriture date,
    numero_piece character varying(255),
    idcompte_general integer,
    idcompte_tier integer,
    libelle text,
    iddevise integer,
    debit double precision,
    credit double precision,
    typeval integer
);


ALTER TABLE public.ecriture_journaux OWNER TO postgres;

--
-- Name: ecriture_journaux_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.ecriture_journaux_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.ecriture_journaux_id_seq OWNER TO postgres;

--
-- Name: ecriture_journaux_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.ecriture_journaux_id_seq OWNED BY public.ecriture_journaux.id;


--
-- Name: historicdevise; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.historicdevise (
    id integer NOT NULL,
    iddevise integer,
    anctaux double precision,
    ancdate date
);


ALTER TABLE public.historicdevise OWNER TO postgres;

--
-- Name: historicdevise_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.historicdevise_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.historicdevise_id_seq OWNER TO postgres;

--
-- Name: historicdevise_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.historicdevise_id_seq OWNED BY public.historicdevise.id;


--
-- Name: journaux; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.journaux (
    id integer NOT NULL,
    code character varying(2),
    intitule character varying(255)
);


ALTER TABLE public.journaux OWNER TO postgres;

--
-- Name: journaux_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.journaux_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.journaux_id_seq OWNER TO postgres;

--
-- Name: journaux_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.journaux_id_seq OWNED BY public.journaux.id;


--
-- Name: person; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.person (
    id integer NOT NULL,
    namelead character varying(100),
    addres character varying(250),
    phone integer,
    mail character varying(100)
);


ALTER TABLE public.person OWNER TO postgres;

--
-- Name: person_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.person_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.person_id_seq OWNER TO postgres;

--
-- Name: person_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.person_id_seq OWNED BY public.person.id;


--
-- Name: plancomptable; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.plancomptable (
    id integer NOT NULL,
    idracinecompte integer,
    numerocompte integer,
    intitule character varying(255)
);


ALTER TABLE public.plancomptable OWNER TO postgres;

--
-- Name: plancomptable_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.plancomptable_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.plancomptable_id_seq OWNER TO postgres;

--
-- Name: plancomptable_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.plancomptable_id_seq OWNED BY public.plancomptable.id;


--
-- Name: racine_compte; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.racine_compte (
    id integer NOT NULL,
    numerocompte integer,
    intitule character varying(50),
    code character varying(50)
);


ALTER TABLE public.racine_compte OWNER TO postgres;

--
-- Name: racine_compte_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.racine_compte_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.racine_compte_id_seq OWNER TO postgres;

--
-- Name: racine_compte_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.racine_compte_id_seq OWNED BY public.racine_compte.id;


--
-- Name: s_detailscan; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.s_detailscan (
    id integer NOT NULL,
    idsociete integer,
    idtype integer,
    numero character varying(255),
    scanpdf character varying(255)
);


ALTER TABLE public.s_detailscan OWNER TO postgres;

--
-- Name: s_detailscan_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.s_detailscan_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.s_detailscan_id_seq OWNER TO postgres;

--
-- Name: s_detailscan_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.s_detailscan_id_seq OWNED BY public.s_detailscan.id;


--
-- Name: s_devisereference; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.s_devisereference (
    id integer NOT NULL,
    idsociete integer,
    idref_devise integer
);


ALTER TABLE public.s_devisereference OWNER TO postgres;

--
-- Name: s_devisereference_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.s_devisereference_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.s_devisereference_id_seq OWNER TO postgres;

--
-- Name: s_devisereference_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.s_devisereference_id_seq OWNED BY public.s_devisereference.id;


--
-- Name: s_emailist; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.s_emailist (
    id integer NOT NULL,
    idsociete integer,
    email character varying(250)
);


ALTER TABLE public.s_emailist OWNER TO postgres;

--
-- Name: s_emailist_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.s_emailist_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.s_emailist_id_seq OWNER TO postgres;

--
-- Name: s_emailist_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.s_emailist_id_seq OWNED BY public.s_emailist.id;


--
-- Name: s_phonelist; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.s_phonelist (
    id integer NOT NULL,
    idsociete integer,
    phonenumber integer
);


ALTER TABLE public.s_phonelist OWNER TO postgres;

--
-- Name: s_phonelist_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.s_phonelist_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.s_phonelist_id_seq OWNER TO postgres;

--
-- Name: s_phonelist_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.s_phonelist_id_seq OWNED BY public.s_phonelist.id;


--
-- Name: societe; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.societe (
    id integer NOT NULL,
    soc_name character varying(350),
    soc_objet text,
    capital double precision,
    dirigeantid integer,
    soc_creationdate date,
    soc_adresse character varying(500),
    soc_emptotal integer,
    datedebut date,
    devise_tenu_compte integer
);


ALTER TABLE public.societe OWNER TO postgres;

--
-- Name: societe_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.societe_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.societe_id_seq OWNER TO postgres;

--
-- Name: societe_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.societe_id_seq OWNED BY public.societe.id;


--
-- Name: type_numero; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.type_numero (
    id integer NOT NULL,
    libelle character varying(255)
);


ALTER TABLE public.type_numero OWNER TO postgres;

--
-- Name: type_numero_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.type_numero_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.type_numero_id_seq OWNER TO postgres;

--
-- Name: type_numero_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.type_numero_id_seq OWNED BY public.type_numero.id;


--
-- Name: v_plan_tier; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW public.v_plan_tier AS
 SELECT cpt.id,
    cpt.idcompte_collectif AS idplancompte,
    pl.idracinecompte,
    pl.numerocompte AS cpt_num_gen,
    pl.intitule AS intitule_gen,
    cpt.numerocompte AS cpt_num_aux,
    cpt.intitule AS intitule_aux
   FROM (public.compte_tier cpt
     JOIN public.plancomptable pl ON ((pl.id = cpt.idcompte_collectif)));


ALTER TABLE public.v_plan_tier OWNER TO postgres;

--
-- Name: v_compte_tier_alldetail; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW public.v_compte_tier_alldetail AS
 SELECT pl.id,
    pl.idplancompte,
    rc.numerocompte,
    rc.intitule,
    rc.code,
    pl.cpt_num_gen,
    pl.intitule_gen,
    pl.cpt_num_aux,
    pl.intitule_aux
   FROM (public.v_plan_tier pl
     JOIN public.racine_compte rc ON ((rc.id = pl.idracinecompte)));


ALTER TABLE public.v_compte_tier_alldetail OWNER TO postgres;

--
-- Name: v_plan_compta_tier; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW public.v_plan_compta_tier AS
 SELECT pl.id,
    pl.idracinecompte,
    rcp.numerocompte AS racine_num,
    rcp.intitule AS racine_intitule,
    pl.numerocompte AS plancompta_num,
    pl.intitule AS plancompta_intitule,
    rcp.code
   FROM (public.plancomptable pl
     JOIN public.racine_compte rcp ON ((pl.idracinecompte = rcp.id)))
  WHERE ((rcp.numerocompte = 40) OR (rcp.numerocompte = 41));


ALTER TABLE public.v_plan_compta_tier OWNER TO postgres;

--
-- Name: v_societe_dirigeant; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW public.v_societe_dirigeant AS
 SELECT p.namelead,
    p.addres,
    p.phone,
    p.mail
   FROM (public.societe s
     JOIN public.person p ON ((s.dirigeantid = p.id)));


ALTER TABLE public.v_societe_dirigeant OWNER TO postgres;

--
-- Name: v_societe_info_and_devise; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW public.v_societe_info_and_devise AS
 SELECT s.id,
    s.soc_name,
    s.soc_objet,
    s.capital,
    s.dirigeantid,
    s.soc_creationdate,
    s.soc_adresse,
    s.soc_emptotal,
    s.datedebut,
    d.id AS iddevise,
    d.nomdevise,
    d.taux,
    d.datecourant
   FROM (public.societe s
     JOIN public.devise d ON ((d.id = s.devise_tenu_compte)));


ALTER TABLE public.v_societe_info_and_devise OWNER TO postgres;

--
-- Name: v_societe_info_devise_ref; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW public.v_societe_info_devise_ref AS
 SELECT dr.id,
    d.id AS iddevise,
    dr.idsociete,
    d.nomdevise,
    d.taux,
    d.datecourant
   FROM (public.s_devisereference dr
     JOIN public.devise d ON ((d.id = dr.idref_devise)));


ALTER TABLE public.v_societe_info_devise_ref OWNER TO postgres;

--
-- Name: compte_tier id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.compte_tier ALTER COLUMN id SET DEFAULT nextval('public.compte_tier_id_seq'::regclass);


--
-- Name: devise id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.devise ALTER COLUMN id SET DEFAULT nextval('public.devise_id_seq'::regclass);


--
-- Name: ecriture_journaux id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.ecriture_journaux ALTER COLUMN id SET DEFAULT nextval('public.ecriture_journaux_id_seq'::regclass);


--
-- Name: historicdevise id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.historicdevise ALTER COLUMN id SET DEFAULT nextval('public.historicdevise_id_seq'::regclass);


--
-- Name: journaux id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.journaux ALTER COLUMN id SET DEFAULT nextval('public.journaux_id_seq'::regclass);


--
-- Name: person id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.person ALTER COLUMN id SET DEFAULT nextval('public.person_id_seq'::regclass);


--
-- Name: plancomptable id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.plancomptable ALTER COLUMN id SET DEFAULT nextval('public.plancomptable_id_seq'::regclass);


--
-- Name: racine_compte id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.racine_compte ALTER COLUMN id SET DEFAULT nextval('public.racine_compte_id_seq'::regclass);


--
-- Name: s_detailscan id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.s_detailscan ALTER COLUMN id SET DEFAULT nextval('public.s_detailscan_id_seq'::regclass);


--
-- Name: s_devisereference id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.s_devisereference ALTER COLUMN id SET DEFAULT nextval('public.s_devisereference_id_seq'::regclass);


--
-- Name: s_emailist id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.s_emailist ALTER COLUMN id SET DEFAULT nextval('public.s_emailist_id_seq'::regclass);


--
-- Name: s_phonelist id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.s_phonelist ALTER COLUMN id SET DEFAULT nextval('public.s_phonelist_id_seq'::regclass);


--
-- Name: societe id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.societe ALTER COLUMN id SET DEFAULT nextval('public.societe_id_seq'::regclass);


--
-- Name: type_numero id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.type_numero ALTER COLUMN id SET DEFAULT nextval('public.type_numero_id_seq'::regclass);


--
-- Data for Name: compte_tier; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.compte_tier (id, idcompte_collectif, numerocompte, intitule) FROM stdin;
5	1	MASSIN	FRNS:MASSIN
6	1	KOTOITU	FRNS:KOTO
7	8	JOHN	CLT:JOHN
8	8	RABE	CLT:RABE
\.


--
-- Data for Name: devise; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.devise (id, nomdevise, taux, datecourant) FROM stdin;
1	Ariary	1	2023-03-17
2	Euro	2000	2023-03-17
3	Livre	2500	2023-03-17
\.


--
-- Data for Name: ecriture_journaux; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.ecriture_journaux (id, id_code_journaux, dat_ecriture, numero_piece, idcompte_general, idcompte_tier, libelle, iddevise, debit, credit, typeval) FROM stdin;
\.


--
-- Data for Name: historicdevise; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.historicdevise (id, iddevise, anctaux, ancdate) FROM stdin;
\.


--
-- Data for Name: journaux; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.journaux (id, code, intitule) FROM stdin;
8	VE	Ventes destine a  l'exportaion 
1	AC	Toute Achats
7	VL	Ventes locale
4	BO	Banque BOA
9	BI	Banque BNI
29	OI	Banque BMOI
30	A	AZ
31	B	BO
32	C	Co
33	D	OIO
34	F	FF
\.


--
-- Data for Name: person; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.person (id, namelead, addres, phone, mail) FROM stdin;
1	Koto	Sabotsy Namehana	322101475	koto@gmail.com
\.


--
-- Data for Name: plancomptable; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.plancomptable (id, idracinecompte, numerocompte, intitule) FROM stdin;
12	13	60000	Achat
13	13	61000	Achat marchandise
14	14	70000	Vente
15	10	44561	TVAD
16	10	44571	TVAC
17	11	51200	Banque BOA
1	8	40110	Frns d'exploitation locaux
2	8	40120	Frns d'exploitation ‚trangers
3	8	40310	Frns d'exploitation ‚trangers
4	8	40810	Frns expl.: facture … recevoir
5	8	40910	Frns: avances & acomptes
6	8	40910	Frns: avances & acomptes
7	8	40980	Frns: rabais … obtenir
8	9	41110	Clients locaux
9	9	41120	Clients ‚trangers
10	9	41400	Clients douteux
11	9	41810	Clients: facture … ‚tablir
\.


--
-- Data for Name: racine_compte; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.racine_compte (id, numerocompte, intitule, code) FROM stdin;
1	10	Capital	Ca
2	11	Report … nouveaux	Rep
3	12	R‚sultat	Res
5	20	Immo incorporel	incor
6	21	Immo corporel	cor
7	3	Stock	ST
8	40	Fournisseur	Fo
9	41	Client	Cl
10	445	TVA	T
11	512	Banque	Bn
12	53	Caisse	Ca
15	766	Gain de change	G
16	666	Perte de change	P
17	77	Produits extra	Ex
18	67	Charge extra	ChEx
4	16	Emprunts	Emp
13	60	Charge	Ch
14	70	Produit	Pr
\.


--
-- Data for Name: s_detailscan; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.s_detailscan (id, idsociete, idtype, numero, scanpdf) FROM stdin;
1	3	1	013579	scan_nif.jpg
2	3	2	A01010	scan_stat.jpg
3	3	3	B98765	scan_rcs.jpg
\.


--
-- Data for Name: s_devisereference; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.s_devisereference (id, idsociete, idref_devise) FROM stdin;
3	3	2
4	3	3
\.


--
-- Data for Name: s_emailist; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.s_emailist (id, idsociete, email) FROM stdin;
1	3	dimpex_ent@yahoo.mg
2	3	dimpex_receps@gmail.mg
\.


--
-- Data for Name: s_phonelist; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.s_phonelist (id, idsociete, phonenumber) FROM stdin;
1	3	322232232
2	3	340004500
\.


--
-- Data for Name: societe; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.societe (id, soc_name, soc_objet, capital, dirigeantid, soc_creationdate, soc_adresse, soc_emptotal, datedebut, devise_tenu_compte) FROM stdin;
3	DIMPEX Dago Import Export	Production et vente de marchandises 	2000000000	1	2023-03-10	ENCEINTE ITU ANDOHARANOFOTSY BP 1960 Antananarivo 101	50	2023-03-17	1
\.


--
-- Data for Name: type_numero; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.type_numero (id, libelle) FROM stdin;
1	NIF
2	STAT
3	RCS
\.


--
-- Name: compte_tier_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.compte_tier_id_seq', 8, true);


--
-- Name: devise_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.devise_id_seq', 3, true);


--
-- Name: ecriture_journaux_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.ecriture_journaux_id_seq', 1, false);


--
-- Name: historicdevise_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.historicdevise_id_seq', 1, false);


--
-- Name: journaux_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.journaux_id_seq', 34, true);


--
-- Name: person_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.person_id_seq', 1, true);


--
-- Name: plancomptable_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.plancomptable_id_seq', 17, true);


--
-- Name: racine_compte_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.racine_compte_id_seq', 18, true);


--
-- Name: s_detailscan_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.s_detailscan_id_seq', 3, true);


--
-- Name: s_devisereference_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.s_devisereference_id_seq', 4, true);


--
-- Name: s_emailist_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.s_emailist_id_seq', 2, true);


--
-- Name: s_phonelist_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.s_phonelist_id_seq', 2, true);


--
-- Name: societe_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.societe_id_seq', 3, true);


--
-- Name: type_numero_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.type_numero_id_seq', 3, true);


--
-- Name: compte_tier compte_tier_numerocompte_key; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.compte_tier
    ADD CONSTRAINT compte_tier_numerocompte_key UNIQUE (numerocompte);


--
-- Name: compte_tier compte_tier_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.compte_tier
    ADD CONSTRAINT compte_tier_pkey PRIMARY KEY (id);


--
-- Name: devise devise_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.devise
    ADD CONSTRAINT devise_pkey PRIMARY KEY (id);


--
-- Name: ecriture_journaux ecriture_journaux_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.ecriture_journaux
    ADD CONSTRAINT ecriture_journaux_pkey PRIMARY KEY (id);


--
-- Name: historicdevise historicdevise_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.historicdevise
    ADD CONSTRAINT historicdevise_pkey PRIMARY KEY (id);


--
-- Name: journaux journaux_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.journaux
    ADD CONSTRAINT journaux_pkey PRIMARY KEY (id);


--
-- Name: person person_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.person
    ADD CONSTRAINT person_pkey PRIMARY KEY (id);


--
-- Name: plancomptable plancomptable_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.plancomptable
    ADD CONSTRAINT plancomptable_pkey PRIMARY KEY (id);


--
-- Name: racine_compte racine_compte_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.racine_compte
    ADD CONSTRAINT racine_compte_pkey PRIMARY KEY (id);


--
-- Name: s_detailscan s_detailscan_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.s_detailscan
    ADD CONSTRAINT s_detailscan_pkey PRIMARY KEY (id);


--
-- Name: s_devisereference s_devisereference_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.s_devisereference
    ADD CONSTRAINT s_devisereference_pkey PRIMARY KEY (id);


--
-- Name: s_emailist s_emailist_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.s_emailist
    ADD CONSTRAINT s_emailist_pkey PRIMARY KEY (id);


--
-- Name: s_phonelist s_phonelist_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.s_phonelist
    ADD CONSTRAINT s_phonelist_pkey PRIMARY KEY (id);


--
-- Name: societe societe_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.societe
    ADD CONSTRAINT societe_pkey PRIMARY KEY (id);


--
-- Name: type_numero type_numero_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.type_numero
    ADD CONSTRAINT type_numero_pkey PRIMARY KEY (id);


--
-- Name: compte_tier compte_tier_idcompte_collectif_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.compte_tier
    ADD CONSTRAINT compte_tier_idcompte_collectif_fkey FOREIGN KEY (idcompte_collectif) REFERENCES public.plancomptable(id);


--
-- Name: ecriture_journaux ecriture_journaux_id_code_journaux_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.ecriture_journaux
    ADD CONSTRAINT ecriture_journaux_id_code_journaux_fkey FOREIGN KEY (id_code_journaux) REFERENCES public.journaux(id);


--
-- Name: ecriture_journaux ecriture_journaux_idcompte_general_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.ecriture_journaux
    ADD CONSTRAINT ecriture_journaux_idcompte_general_fkey FOREIGN KEY (idcompte_general) REFERENCES public.plancomptable(id);


--
-- Name: ecriture_journaux ecriture_journaux_idcompte_tier_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.ecriture_journaux
    ADD CONSTRAINT ecriture_journaux_idcompte_tier_fkey FOREIGN KEY (idcompte_tier) REFERENCES public.compte_tier(id);


--
-- Name: ecriture_journaux ecriture_journaux_iddevise_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.ecriture_journaux
    ADD CONSTRAINT ecriture_journaux_iddevise_fkey FOREIGN KEY (iddevise) REFERENCES public.devise(id);


--
-- Name: historicdevise historicdevise_iddevise_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.historicdevise
    ADD CONSTRAINT historicdevise_iddevise_fkey FOREIGN KEY (iddevise) REFERENCES public.devise(id);


--
-- Name: plancomptable plancomptable_idracinecompte_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.plancomptable
    ADD CONSTRAINT plancomptable_idracinecompte_fkey FOREIGN KEY (idracinecompte) REFERENCES public.racine_compte(id);


--
-- Name: s_detailscan s_detailscan_idsociete_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.s_detailscan
    ADD CONSTRAINT s_detailscan_idsociete_fkey FOREIGN KEY (idsociete) REFERENCES public.societe(id);


--
-- Name: s_detailscan s_detailscan_idtype_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.s_detailscan
    ADD CONSTRAINT s_detailscan_idtype_fkey FOREIGN KEY (idtype) REFERENCES public.type_numero(id);


--
-- Name: s_devisereference s_devisereference_idref_devise_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.s_devisereference
    ADD CONSTRAINT s_devisereference_idref_devise_fkey FOREIGN KEY (idref_devise) REFERENCES public.devise(id);


--
-- Name: s_devisereference s_devisereference_idsociete_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.s_devisereference
    ADD CONSTRAINT s_devisereference_idsociete_fkey FOREIGN KEY (idsociete) REFERENCES public.societe(id);


--
-- Name: s_emailist s_emailist_idsociete_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.s_emailist
    ADD CONSTRAINT s_emailist_idsociete_fkey FOREIGN KEY (idsociete) REFERENCES public.societe(id);


--
-- Name: s_phonelist s_phonelist_idsociete_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.s_phonelist
    ADD CONSTRAINT s_phonelist_idsociete_fkey FOREIGN KEY (idsociete) REFERENCES public.societe(id);


--
-- Name: societe societe_devise_tenu_compte_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.societe
    ADD CONSTRAINT societe_devise_tenu_compte_fkey FOREIGN KEY (devise_tenu_compte) REFERENCES public.devise(id);


--
-- Name: societe societe_dirigeantid_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.societe
    ADD CONSTRAINT societe_dirigeantid_fkey FOREIGN KEY (dirigeantid) REFERENCES public.person(id);


--
-- PostgreSQL database dump complete
--

