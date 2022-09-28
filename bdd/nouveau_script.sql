#------------------------------------------------------------
#        Script MySQL.
#------------------------------------------------------------


#------------------------------------------------------------
# Table: SECTEUR
#------------------------------------------------------------

CREATE TABLE SECTEUR(
        SEC_CODE        Char (1) NOT NULL ,
        Libelle_secteur Varchar (20) NOT NULL
	,CONSTRAINT SECTEUR_PK PRIMARY KEY (SEC_CODE)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: REGION
#------------------------------------------------------------

CREATE TABLE REGION(
        REG_CODE Varchar (2) NOT NULL ,
        Nom      Varchar (20) NOT NULL ,
        SEC_CODE Char (1) NOT NULL
	,CONSTRAINT REGION_PK PRIMARY KEY (REG_CODE)

	,CONSTRAINT REGION_SECTEUR_FK FOREIGN KEY (SEC_CODE) REFERENCES SECTEUR(SEC_CODE)
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
        PRA_ADDRESSE      Varchar (50) NOT NULL ,
        PRA_CP            Varchar (50) NOT NULL ,
        PRA_VILLE         Varchar (50) NOT NULL ,
        PRA_COEFNOTORIETE Varchar (50) NOT NULL ,
        TYP_CODE          Text NOT NULL
	,CONSTRAINT PRATICIEN_PK PRIMARY KEY (PRA_NUM)

	,CONSTRAINT PRATICIEN_TYPE_PRATICIEN_FK FOREIGN KEY (TYP_CODE) REFERENCES TYPE_PRATICIEN(TYP_CODE)
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

	,CONSTRAINT MEDICAMENT_FAMILLE_FK FOREIGN KEY (FAM_CODE) REFERENCES FAMILLE(FAM_CODE)
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

	,CONSTRAINT POSSEDER_SPECIALITE_FK FOREIGN KEY (SPE_CODE) REFERENCES SPECIALITE(SPE_CODE)
	,CONSTRAINT POSSEDER_PRATICIEN0_FK FOREIGN KEY (PRA_NUM) REFERENCES PRATICIEN(PRA_NUM)
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

	,CONSTRAINT PRESCRIRE_DOSAGE_FK FOREIGN KEY (DOS_CODE) REFERENCES DOSAGE(DOS_CODE)
	,CONSTRAINT PRESCRIRE_MEDICAMENT0_FK FOREIGN KEY (MED_DEPOTLEGAL) REFERENCES MEDICAMENT(MED_DEPOTLEGAL)
	,CONSTRAINT PRESCRIRE_TYPE_INDIVIDU1_FK FOREIGN KEY (TIN_Code) REFERENCES TYPE_INDIVIDU(TIN_Code)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: INTERAGIR
#------------------------------------------------------------

CREATE TABLE INTERAGIR(
        MED_DEPOTLEGAL            Int NOT NULL ,
        MED_DEPOTLEGAL_MEDICAMENT Int NOT NULL
	,CONSTRAINT INTERAGIR_PK PRIMARY KEY (MED_DEPOTLEGAL,MED_DEPOTLEGAL_MEDICAMENT)

	,CONSTRAINT INTERAGIR_MEDICAMENT_FK FOREIGN KEY (MED_DEPOTLEGAL) REFERENCES MEDICAMENT(MED_DEPOTLEGAL)
	,CONSTRAINT INTERAGIR_MEDICAMENT0_FK FOREIGN KEY (MED_DEPOTLEGAL_MEDICAMENT) REFERENCES MEDICAMENT(MED_DEPOTLEGAL)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: FORMULER
#------------------------------------------------------------

CREATE TABLE FORMULER(
        PRE_CODE       Int NOT NULL ,
        MED_DEPOTLEGAL Int NOT NULL
	,CONSTRAINT FORMULER_PK PRIMARY KEY (PRE_CODE,MED_DEPOTLEGAL)

	,CONSTRAINT FORMULER_PRESENTATION_FK FOREIGN KEY (PRE_CODE) REFERENCES PRESENTATION(PRE_CODE)
	,CONSTRAINT FORMULER_MEDICAMENT0_FK FOREIGN KEY (MED_DEPOTLEGAL) REFERENCES MEDICAMENT(MED_DEPOTLEGAL)
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

	,CONSTRAINT COLLABORATEUR_SECTEUR_FK FOREIGN KEY (SEC_CODE) REFERENCES SECTEUR(SEC_CODE)
	,CONSTRAINT COLLABORATEUR_HABILITATION0_FK FOREIGN KEY (HAB_ID) REFERENCES HABILITATION(HAB_ID)
	,CONSTRAINT COLLABORATEUR_LOGIN1_FK FOREIGN KEY (LOG_ID) REFERENCES LOGIN(LOG_ID)
	,CONSTRAINT COLLABORATEUR_LOGIN_AK UNIQUE (LOG_ID)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: RAPPORT_VISITE
#------------------------------------------------------------

CREATE TABLE RAPPORT_VISITE(
        COL_MATRICULE Varchar (4) NOT NULL ,
        RAP_NUM       Int NOT NULL ,
        RAP_DATE      Date NOT NULL ,
        RAP_BILAN     Varchar (100) NOT NULL ,
        ID_ETAT       Char (5) NOT NULL ,
        MOT_ID        Int
	,CONSTRAINT RAPPORT_VISITE_PK PRIMARY KEY (COL_MATRICULE,RAP_NUM)

	,CONSTRAINT RAPPORT_VISITE_COLLABORATEUR_FK FOREIGN KEY (COL_MATRICULE) REFERENCES COLLABORATEUR(COL_MATRICULE)
	,CONSTRAINT RAPPORT_VISITE_ETAT_RAPPORT0_FK FOREIGN KEY (ID_ETAT) REFERENCES ETAT_RAPPORT(ID_ETAT)
	,CONSTRAINT RAPPORT_VISITE_MOTIF_VISITE1_FK FOREIGN KEY (MOT_ID) REFERENCES MOTIF_VISITE(MOT_ID)
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

	,CONSTRAINT LOGIN_COLLABORATEUR_FK FOREIGN KEY (COL_MATRICULE) REFERENCES COLLABORATEUR(COL_MATRICULE)
	,CONSTRAINT LOGIN_COLLABORATEUR_AK UNIQUE (COL_MATRICULE)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: TRAVAILLER
#------------------------------------------------------------

CREATE TABLE TRAVAILLER(
        COL_MATRICULE Varchar (4) NOT NULL ,
        REG_CODE      Varchar (2) NOT NULL ,
        Role          Varchar (20) NOT NULL
	,CONSTRAINT TRAVAILLER_PK PRIMARY KEY (COL_MATRICULE,REG_CODE)

	,CONSTRAINT TRAVAILLER_COLLABORATEUR_FK FOREIGN KEY (COL_MATRICULE) REFERENCES COLLABORATEUR(COL_MATRICULE)
	,CONSTRAINT TRAVAILLER_REGION0_FK FOREIGN KEY (REG_CODE) REFERENCES REGION(REG_CODE)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: CONCERNER
#------------------------------------------------------------

CREATE TABLE CONCERNER(
        PRA_NUM           Varchar (50) NOT NULL ,
        COL_MATRICULE     Varchar (4) NOT NULL ,
        RAP_NUM           Int NOT NULL ,
        PRA_NUM_PRATICIEN Varchar (50) NOT NULL
	,CONSTRAINT CONCERNER_PK PRIMARY KEY (PRA_NUM,COL_MATRICULE,RAP_NUM,PRA_NUM_PRATICIEN)

	,CONSTRAINT CONCERNER_PRATICIEN_FK FOREIGN KEY (PRA_NUM) REFERENCES PRATICIEN(PRA_NUM)
	,CONSTRAINT CONCERNER_RAPPORT_VISITE0_FK FOREIGN KEY (COL_MATRICULE,RAP_NUM) REFERENCES RAPPORT_VISITE(COL_MATRICULE,RAP_NUM)
	,CONSTRAINT CONCERNER_PRATICIEN1_FK FOREIGN KEY (PRA_NUM_PRATICIEN) REFERENCES PRATICIEN(PRA_NUM)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: OFFRIR
#------------------------------------------------------------

CREATE TABLE OFFRIR(
        COL_MATRICULE  Varchar (4) NOT NULL ,
        RAP_NUM        Int NOT NULL ,
        MED_DEPOTLEGAL Int NOT NULL ,
        OFF_QTE        Int NOT NULL
	,CONSTRAINT OFFRIR_PK PRIMARY KEY (COL_MATRICULE,RAP_NUM,MED_DEPOTLEGAL)

	,CONSTRAINT OFFRIR_RAPPORT_VISITE_FK FOREIGN KEY (COL_MATRICULE,RAP_NUM) REFERENCES RAPPORT_VISITE(COL_MATRICULE,RAP_NUM)
	,CONSTRAINT OFFRIR_MEDICAMENT0_FK FOREIGN KEY (MED_DEPOTLEGAL) REFERENCES MEDICAMENT(MED_DEPOTLEGAL)
)ENGINE=InnoDB;

