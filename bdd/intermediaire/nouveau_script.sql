#------------------------------------------------------------
#        Script MySQL.
#------------------------------------------------------------


#------------------------------------------------------------
# Table: SECTEUR
#------------------------------------------------------------

CREATE TABLE SECTEUR(
        SEC_CODE    Char (1) NOT NULL ,
        SEC_LIBELLE Varchar (20) NOT NULL
	,CONSTRAINT SECTEUR_PK PRIMARY KEY (SEC_CODE)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: REGION
#------------------------------------------------------------

CREATE TABLE REGION(
        REG_CODE Varchar (2) NOT NULL ,
        REG_NOM  Varchar (20) NOT NULL ,
        SEC_CODE Char (1) NOT NULL
	,CONSTRAINT REGION_PK PRIMARY KEY (REG_CODE)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: TYPE_PRATICIEN
#------------------------------------------------------------

CREATE TABLE TYPE_PRATICIEN(
        TYP_CODE    Text NOT NULL ,
        TYP_LIBELLE Varchar (50) NOT NULL ,
        TYP_LIEU    Varchar (50) NOT NULL
	,CONSTRAINT TYPE_PRATICIEN_PK PRIMARY KEY (TYP_CODE)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: PRATICIEN
#------------------------------------------------------------

CREATE TABLE PRATICIEN(
        PRA_NUM           Varchar (50) NOT NULL ,
        PRA_NOM           Varchar (50) NOT NULL ,
        PRA_COEFNOTORIETE Varchar (50) NOT NULL ,
        PRA_COEFCONFIANCE Varchar (50) NOT NULL ,
        TYP_CODE          Text NOT NULL
	,CONSTRAINT PRATICIEN_PK PRIMARY KEY (PRA_NUM)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: SPECIALITE
#------------------------------------------------------------

CREATE TABLE SPECIALITE(
        SPE_CODE    Varchar (50) NOT NULL ,
        SPE_LIBELLE Varchar (50) NOT NULL
	,CONSTRAINT SPECIALITE_PK PRIMARY KEY (SPE_CODE)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: DOSAGE
#------------------------------------------------------------

CREATE TABLE DOSAGE(
        DOS_CODE     Int  Auto_increment  NOT NULL ,
        DOS_QUANTITE Int NOT NULL ,
        DOS_UNITE    Varchar (50) NOT NULL
	,CONSTRAINT DOSAGE_PK PRIMARY KEY (DOS_CODE)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: TYPE_INDIVIDU
#------------------------------------------------------------

CREATE TABLE TYPE_INDIVIDU(
        TIN_Code    Int  Auto_increment  NOT NULL ,
        TIN_LIBELLE Varchar (50) NOT NULL
	,CONSTRAINT TYPE_INDIVIDU_PK PRIMARY KEY (TIN_Code)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: FAMILLE
#------------------------------------------------------------

CREATE TABLE FAMILLE(
        FAM_CODE    Varchar (50) NOT NULL ,
        FAM_LIBELLE Int  Auto_increment  NOT NULL
	,CONSTRAINT FAMILLE_PK PRIMARY KEY (FAM_CODE)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: MEDICAMENT
#------------------------------------------------------------

CREATE TABLE MEDICAMENT(
        MED_DEPOTLEGAL      Int NOT NULL ,
        MED_NOMCOMMERCIAL   Text NOT NULL ,
        MED_COMPOSITION     Text NOT NULL ,
        MED_EFFETS          Text NOT NULL ,
        MED_CONTREINDIC     Varchar (50) NOT NULL ,
        MED_PRIXECHANTILLON Float NOT NULL ,
        FAM_CODE            Varchar (50) NOT NULL
	,CONSTRAINT MEDICAMENT_PK PRIMARY KEY (MED_DEPOTLEGAL)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: PRESENTATION
#------------------------------------------------------------

CREATE TABLE PRESENTATION(
        PRE_CODE    Int  Auto_increment  NOT NULL ,
        PRE_LIBELLE Varchar (50) NOT NULL
	,CONSTRAINT PRESENTATION_PK PRIMARY KEY (PRE_CODE)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: HABILITATION
#------------------------------------------------------------

CREATE TABLE HABILITATION(
        HAB_ID  Int NOT NULL ,
        HAB_LIB Varchar (50) NOT NULL
	,CONSTRAINT HABILITATION_PK PRIMARY KEY (HAB_ID)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: ETAT_RAPPORT
#------------------------------------------------------------

CREATE TABLE ETAT_RAPPORT(
        ID_ETAT  Char (5) NOT NULL ,
        LIB_ETAT Varchar (50) NOT NULL
	,CONSTRAINT ETAT_RAPPORT_PK PRIMARY KEY (ID_ETAT)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: MOTIF_VISITE
#------------------------------------------------------------

CREATE TABLE MOTIF_VISITE(
        MOT_ID  Int  Auto_increment  NOT NULL ,
        MOT_LIB Varchar (50) NOT NULL
	,CONSTRAINT MOTIF_VISITE_PK PRIMARY KEY (MOT_ID)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: POSSEDER
#------------------------------------------------------------

CREATE TABLE POSSEDER(
        SPE_CODE             Varchar (50) NOT NULL ,
        PRA_NUM              Varchar (50) NOT NULL ,
        POS_DIPLOME          Varchar (50) NOT NULL ,
        POS_COEFPRESCRIPTION Varchar (50) NOT NULL
	,CONSTRAINT POSSEDER_PK PRIMARY KEY (SPE_CODE,PRA_NUM)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: PRESCRIRE
#------------------------------------------------------------

CREATE TABLE PRESCRIRE(
        DOS_CODE       Int NOT NULL ,
        MED_DEPOTLEGAL Int NOT NULL ,
        TIN_Code       Int NOT NULL ,
        PRE_POSOLOGIE  Varchar (50) NOT NULL
	,CONSTRAINT PRESCRIRE_PK PRIMARY KEY (DOS_CODE,MED_DEPOTLEGAL,TIN_Code)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: INTERAGIR
#------------------------------------------------------------

CREATE TABLE INTERAGIR(
        MED_DEPOTLEGAL            Int NOT NULL ,
        MED_DEPOTLEGAL_MEDICAMENT Int NOT NULL
	,CONSTRAINT INTERAGIR_PK PRIMARY KEY (MED_DEPOTLEGAL,MED_DEPOTLEGAL_MEDICAMENT)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: FORMULER
#------------------------------------------------------------

CREATE TABLE FORMULER(
        PRE_CODE       Int NOT NULL ,
        MED_DEPOTLEGAL Int NOT NULL
	,CONSTRAINT FORMULER_PK PRIMARY KEY (PRE_CODE,MED_DEPOTLEGAL)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: COLLABORATEUR
#------------------------------------------------------------

CREATE TABLE COLLABORATEUR(
        COL_MATRICULE       Varchar (4) NOT NULL ,
        COL_NOM             Varchar (20) NOT NULL ,
        COL_PRENOM          Varchar (20) NOT NULL ,
        COL_ADRESSE         Varchar (50) NOT NULL ,
        COL_CP              Varchar (5) NOT NULL ,
        COL_VILLE           Varchar (20) NOT NULL ,
        COL_DATE_D_EMBAUCHE Date NOT NULL ,
        SEC_CODE            Char (1) ,
        HAB_ID              Int NOT NULL ,
        LOG_ID              Int NOT NULL
	,CONSTRAINT COLLABORATEUR_PK PRIMARY KEY (COL_MATRICULE)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: RAPPORT_VISITE
#------------------------------------------------------------

CREATE TABLE RAPPORT_VISITE(
        COL_MATRICULE     Varchar (4) NOT NULL ,
        RAP_NUM           Int NOT NULL ,
        RAP_DATE_VISITE   Date NOT NULL ,
        RAp_DATE_SAISIE   Date NOT NULL ,
        RAP_BILAN         Varchar (100) NOT NULL ,
        RAP_MOTIF_AUTRE   Varchar (50) NOT NULL ,
        PRA_NUM           Varchar (50) NOT NULL ,
        ID_ETAT           Char (5) NOT NULL ,
        MOT_ID            Int NOT NULL ,
        MED_DEPOTLEGAL    Int ,
        MED_DEPOTLEGAL_2  Int ,
        PRA_NUM_PRATICIEN Varchar (50)
	,CONSTRAINT RAPPORT_VISITE_PK PRIMARY KEY (COL_MATRICULE,RAP_NUM)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: LOGIN
#------------------------------------------------------------

CREATE TABLE LOGIN(
        LOG_ID         Int NOT NULL ,
        LOG_LOGIN      Varchar (50) NOT NULL ,
        LOG_MOTDEPASSE Varchar (255) NOT NULL ,
        COL_MATRICULE  Varchar (4) NOT NULL
	,CONSTRAINT LOGIN_PK PRIMARY KEY (LOG_ID)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: TRAVAILLER
#------------------------------------------------------------

CREATE TABLE TRAVAILLER(
        COL_MATRICULE Varchar (4) NOT NULL ,
        REG_CODE      Varchar (2) NOT NULL ,
        TRA_ROLE      Varchar (20) NOT NULL
	,CONSTRAINT TRAVAILLER_PK PRIMARY KEY (COL_MATRICULE,REG_CODE)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: OFFRIR
#------------------------------------------------------------

CREATE TABLE OFFRIR(
        COL_MATRICULE  Varchar (4) NOT NULL ,
        RAP_NUM        Int NOT NULL ,
        MED_DEPOTLEGAL Int NOT NULL ,
        QTE_ECH        Int NOT NULL
	,CONSTRAINT OFFRIR_PK PRIMARY KEY (COL_MATRICULE,RAP_NUM,MED_DEPOTLEGAL)
)ENGINE=InnoDB;




ALTER TABLE REGION
	ADD CONSTRAINT REGION_SECTEUR0_FK
	FOREIGN KEY (SEC_CODE)
	REFERENCES SECTEUR(SEC_CODE);

ALTER TABLE PRATICIEN
	ADD CONSTRAINT PRATICIEN_TYPE_PRATICIEN0_FK
	FOREIGN KEY (TYP_CODE)
	REFERENCES TYPE_PRATICIEN(TYP_CODE);

ALTER TABLE MEDICAMENT
	ADD CONSTRAINT MEDICAMENT_FAMILLE0_FK
	FOREIGN KEY (FAM_CODE)
	REFERENCES FAMILLE(FAM_CODE);

ALTER TABLE POSSEDER
	ADD CONSTRAINT POSSEDER_SPECIALITE0_FK
	FOREIGN KEY (SPE_CODE)
	REFERENCES SPECIALITE(SPE_CODE);

ALTER TABLE POSSEDER
	ADD CONSTRAINT POSSEDER_PRATICIEN1_FK
	FOREIGN KEY (PRA_NUM)
	REFERENCES PRATICIEN(PRA_NUM);

ALTER TABLE PRESCRIRE
	ADD CONSTRAINT PRESCRIRE_DOSAGE0_FK
	FOREIGN KEY (DOS_CODE)
	REFERENCES DOSAGE(DOS_CODE);

ALTER TABLE PRESCRIRE
	ADD CONSTRAINT PRESCRIRE_MEDICAMENT1_FK
	FOREIGN KEY (MED_DEPOTLEGAL)
	REFERENCES MEDICAMENT(MED_DEPOTLEGAL);

ALTER TABLE PRESCRIRE
	ADD CONSTRAINT PRESCRIRE_TYPE_INDIVIDU2_FK
	FOREIGN KEY (TIN_Code)
	REFERENCES TYPE_INDIVIDU(TIN_Code);

ALTER TABLE INTERAGIR
	ADD CONSTRAINT INTERAGIR_MEDICAMENT0_FK
	FOREIGN KEY (MED_DEPOTLEGAL)
	REFERENCES MEDICAMENT(MED_DEPOTLEGAL);

ALTER TABLE INTERAGIR
	ADD CONSTRAINT INTERAGIR_MEDICAMENT1_FK
	FOREIGN KEY (MED_DEPOTLEGAL_MEDICAMENT)
	REFERENCES MEDICAMENT(MED_DEPOTLEGAL);

ALTER TABLE FORMULER
	ADD CONSTRAINT FORMULER_PRESENTATION0_FK
	FOREIGN KEY (PRE_CODE)
	REFERENCES PRESENTATION(PRE_CODE);

ALTER TABLE FORMULER
	ADD CONSTRAINT FORMULER_MEDICAMENT1_FK
	FOREIGN KEY (MED_DEPOTLEGAL)
	REFERENCES MEDICAMENT(MED_DEPOTLEGAL);

ALTER TABLE COLLABORATEUR
	ADD CONSTRAINT COLLABORATEUR_SECTEUR0_FK
	FOREIGN KEY (SEC_CODE)
	REFERENCES SECTEUR(SEC_CODE);

ALTER TABLE COLLABORATEUR
	ADD CONSTRAINT COLLABORATEUR_HABILITATION1_FK
	FOREIGN KEY (HAB_ID)
	REFERENCES HABILITATION(HAB_ID);

ALTER TABLE COLLABORATEUR
	ADD CONSTRAINT COLLABORATEUR_LOGIN2_FK
	FOREIGN KEY (LOG_ID)
	REFERENCES LOGIN(LOG_ID);

ALTER TABLE COLLABORATEUR 
	ADD CONSTRAINT COLLABORATEUR_LOGIN0_AK 
	UNIQUE (LOG_ID);

ALTER TABLE RAPPORT_VISITE
	ADD CONSTRAINT RAPPORT_VISITE_COLLABORATEUR0_FK
	FOREIGN KEY (COL_MATRICULE)
	REFERENCES COLLABORATEUR(COL_MATRICULE);

ALTER TABLE RAPPORT_VISITE
	ADD CONSTRAINT RAPPORT_VISITE_PRATICIEN1_FK
	FOREIGN KEY (PRA_NUM)
	REFERENCES PRATICIEN(PRA_NUM);

ALTER TABLE RAPPORT_VISITE
	ADD CONSTRAINT RAPPORT_VISITE_ETAT_RAPPORT2_FK
	FOREIGN KEY (ID_ETAT)
	REFERENCES ETAT_RAPPORT(ID_ETAT);

ALTER TABLE RAPPORT_VISITE
	ADD CONSTRAINT RAPPORT_VISITE_MOTIF_VISITE3_FK
	FOREIGN KEY (MOT_ID)
	REFERENCES MOTIF_VISITE(MOT_ID);

ALTER TABLE RAPPORT_VISITE
	ADD CONSTRAINT RAPPORT_VISITE_MEDICAMENT4_FK
	FOREIGN KEY (MED_DEPOTLEGAL,MED_DEPOTLEGAL_2)
	REFERENCES MEDICAMENT(MED_DEPOTLEGAL,MED_DEPOTLEGAL);

ALTER TABLE RAPPORT_VISITE
	ADD CONSTRAINT RAPPORT_VISITE_PRATICIEN5_FK
	FOREIGN KEY (PRA_NUM_PRATICIEN)
	REFERENCES PRATICIEN(PRA_NUM);

ALTER TABLE LOGIN
	ADD CONSTRAINT LOGIN_COLLABORATEUR0_FK
	FOREIGN KEY (COL_MATRICULE)
	REFERENCES COLLABORATEUR(COL_MATRICULE);

ALTER TABLE LOGIN 
	ADD CONSTRAINT LOGIN_COLLABORATEUR0_AK 
	UNIQUE (COL_MATRICULE);

ALTER TABLE TRAVAILLER
	ADD CONSTRAINT TRAVAILLER_COLLABORATEUR0_FK
	FOREIGN KEY (COL_MATRICULE)
	REFERENCES COLLABORATEUR(COL_MATRICULE);

ALTER TABLE TRAVAILLER
	ADD CONSTRAINT TRAVAILLER_REGION1_FK
	FOREIGN KEY (REG_CODE)
	REFERENCES REGION(REG_CODE);

ALTER TABLE OFFRIR
	ADD CONSTRAINT OFFRIR_RAPPORT_VISITE0_FK
	FOREIGN KEY (COL_MATRICULE,RAP_NUM)
	REFERENCES RAPPORT_VISITE(COL_MATRICULE,RAP_NUM);

ALTER TABLE OFFRIR
	ADD CONSTRAINT OFFRIR_MEDICAMENT1_FK
	FOREIGN KEY (MED_DEPOTLEGAL)
	REFERENCES MEDICAMENT(MED_DEPOTLEGAL);
