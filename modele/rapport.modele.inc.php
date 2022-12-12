<?php

require_once 'bd.inc.php';

/**
 * Permet de recupéré la liste des rapports en cours de saisie d'un visiteur
 *
 * @param string $matricule le matricule d'un visiteur
 * @return array liste des rapports en cours de saisie (COL_MATRICULE, RAP_NUM, PRA_NUM, RAP_DATE_VISITE, MOTIF)
 */
function getInfoRapportNonValides(string $matricule): array
{
    $req = connexionPDO()->prepare('
    SELECT
        r.COL_MATRICULE,
        r.RAP_NUM,
        r.RAP_DATE_VISITE,
        r.RAP_DATE_SAISIE,
        CASE
            WHEN r.MOT_ID = \'OTH\' THEN IFNULL(r.RAP_MOTIF_AUTRE, "Non définie")
            ELSE m.MOT_LIB
        END AS \'MOTIF\'
    FROM 
        rapport_visite r
    INNER JOIN
        motif_visite m
        ON m.MOT_ID = r.MOT_ID
    WHERE 
        r.COL_MATRICULE = :matricule
        AND
        r.ETAT_ID = \'C\'
    ;
    ');
    $req->bindValue(':matricule', $matricule, PDO::PARAM_STR);
    $req->execute();
    $res = $req->fetchAll(PDO::FETCH_ASSOC);
    if (!$res) {
        $res = array();
    }
    
    return $res;
}

/**
 * Permet de crée un nouveau rapport pour un collaborateur
 *
 * @param string $matricule le matricule du collaborateur
 * @return integer numéro du nouveau rapport du collaborateur
 */
function newRapport(string $matricule): int
{
    $PDO = connexionPDO();
    //num rapport
    $req = $PDO->prepare('
        SELECT IFNULL((MAX(RAP_NUM) + 1), 1) AS "numRap" FROM rapport_visite WHERE COL_MATRICULE = :matricule;
    ');
    $req->bindValue(':matricule', $matricule, PDO::PARAM_STR);
    $req->execute();
    $rapNum = $req->fetch(PDO::FETCH_ASSOC)['numRap'];

    $req = $PDO->prepare('
        INSERT INTO rapport_visite(COL_MATRICULE, RAP_NUM, ETAT_ID) 
        VALUES (:matricule, :rapNum, \'C\');
    ');
    $req->bindValue(':matricule', $matricule, PDO::PARAM_STR);
    $req->bindValue(':rapNum', $rapNum, PDO::PARAM_INT);
    $req->execute();

    return $rapNum;
}

/**
 * Permet de recupérer spécifiqueemnt un rapport d'un collabolrateur 
 *
 * @param string $matricule le matricule du collaborateur
 * @param integer $rapNum le numéro d'un rapport d'un collaborateur
 * @return array|false les informations d'un rapport sous forme d'un tableau associatif, ou false si pas trouvé
 */
function getUnRapport(string $matricule, int $rapNum): mixed
{
    $req = connexionPDO()->prepare('
        SELECT
            COL_MATRICULE, RAP_NUM, PRA_NUM, RAP_DATE_VISITE,
            RAP_BILAN, RAP_MOTIF_AUTRE, REMP_NUM, MOT_ID, ETAT_ID,
            RAP_DATE_SAISIE, MED_PRESENTER_1, MED_PRESENTER_2 
        FROM
            rapport_visite 
        WHERE
            COL_MATRICULE = :matricule
            AND
            RAP_NUM = :rapNum
    ');
    $req->bindValue(':matricule', $matricule, PDO::PARAM_STR);
    $req->bindValue(':rapNum', $rapNum, PDO::PARAM_INT);
    $req->execute();

    return $req->fetch(PDO::FETCH_ASSOC);
}

/**
 * Permet de recupérer tous les informations de tous les motifs
 *
 * @return array|false les informations des motifs sous forme d'un tableau de tableau associatif, ou false si pas trouvé
 */
function getLesMotifs(): mixed {
    $req = connexionPDO()->query('SELECT MOT_ID, MOT_LIB FROM motif_visite');
    $req->execute();
    $motifs = $req->fetchAll(PDO::FETCH_ASSOC);
    return $motifs;
}

/**
 * Permet de recupérer tous les information d'un motif en fonction de son identifiant
 *
 * @param string $id identifiant du motif
 * @return array|false les informations du motif sous forme d'un tableau associatif, ou false si pas trouvé
 */
function getUnMotifById(string $id): mixed {
    $req = connexionPDO()->prepare('SELECT MOT_ID, MOT_LIB FROM motif_visite WHERE MOT_ID = :id');
    $req->bindValue(':id', $id, PDO::PARAM_STR);
    $req->execute();
    $motif = $req->fetch(PDO::FETCH_ASSOC);
    return $motif;
}

/**
 * Permet de recupérer tous les information d'un etat en fonction de son identifiant
 *
 * @param string $id identifiant de l'etat
 * @return array|false les informations de l'etat sous forme d'un tableau associatif, ou false si pas trouvé
 */
function getUnEtatById(string $id): mixed {
    $req = connexionPDO()->prepare('SELECT ETAT_ID, ETAT_LIB FROM etat_rapport WHERE ETAT_ID = :id');
    $req->bindValue(':id', $id, PDO::PARAM_STR);
    $req->execute();
    $etat = $req->fetch(PDO::FETCH_ASSOC);
    return $etat;
}

/**
 * Permet de mettre à jour un rapport de visite en fonction d'un matricule et d'un numero de rapport
 *
 * @param string $COL_MATRICULE le matricule deu collaborateur
 * @param integer $RAP_NUM le numero du rapport
 * @param ?integer $PRA_NUM un identifiant de praticien
 * @param ?string $RAP_DATE_VISITE une date de saisie
 * @param string $RAP_BILAN un text de bilan
 * @param string $RAP_MOTIF_AUTRE un texte pour le motif aute
 * @param ?integer $REMP_NUM l'identifiant d'un praticien remplacent
 * @param string $MOT_ID un identifiant de motif
 * @param string $ETAT_ID un identifiant d'etat
 * @param ?string $MED_PRESENTER_1 un identifiant du premier medicamnent
 * @param ?string $MED_PRESENTER_2 un identifiant du deuxieme medicamnent
 * @return bool true si bien mise à jour
 */
function updateUnRapport(
    string $COL_MATRICULE,
    int $RAP_NUM,
    ?int $PRA_NUM,
    ?string $RAP_DATE_VISITE,
    string $RAP_BILAN,
    string $RAP_MOTIF_AUTRE,
    ?int $REMP_NUM,
    string $MOT_ID,
    string $ETAT_ID,
    ?string $MED_PRESENTER_1,
    ?string $MED_PRESENTER_2
    ): bool
    {   
    $req = connexionPDO()->prepare('
        UPDATE 
            rapport_visite 
        SET 
            PRA_NUM=:PRA_NUM,
            RAP_DATE_VISITE=:RAP_DATE_VISITE,
            RAP_BILAN=:RAP_BILAN,
            RAP_MOTIF_AUTRE=:RAP_MOTIF_AUTRE,
            REMP_NUM=:REMP_NUM,
            MOT_ID=:MOT_ID,
            ETAT_ID=:ETAT_ID,
            MED_PRESENTER_1=:MED_PRESENTER_1,
            MED_PRESENTER_2=:MED_PRESENTER_2
        WHERE
            COL_MATRICULE=:COL_MATRICULE
            AND
            RAP_NUM=:RAP_NUM
        ;
    ');
    $req->bindValue(':COL_MATRICULE', $COL_MATRICULE, PDO::PARAM_STR);
    $req->bindValue(':RAP_NUM', $RAP_NUM, PDO::PARAM_INT);
    $req->bindValue(':RAP_BILAN', $RAP_BILAN, PDO::PARAM_STR);
    $req->bindValue(':RAP_MOTIF_AUTRE', $RAP_MOTIF_AUTRE, PDO::PARAM_STR);
    $req->bindValue(':MOT_ID', $MOT_ID, PDO::PARAM_STR);
    $req->bindValue(':ETAT_ID', $ETAT_ID, PDO::PARAM_STR);
    bindValueCanBeNull($req, ':PRA_NUM', $PRA_NUM, PDO::PARAM_INT);
    bindValueCanBeNull($req, ':REMP_NUM', $REMP_NUM, PDO::PARAM_INT);
    bindValueCanBeNull($req, ':RAP_DATE_VISITE', $RAP_DATE_VISITE, PDO::PARAM_STR);
    bindValueCanBeNull($req, ':MED_PRESENTER_1', $MED_PRESENTER_1, PDO::PARAM_STR);
    bindValueCanBeNull($req, ':MED_PRESENTER_2', $MED_PRESENTER_2, PDO::PARAM_STR);
    //check de la requet
    return $req->execute();
}

/**
 * Permet de récupérer les echantillions d'un rapport
 *
 * @param string $COL_MATRICULE matricule d'un collaborateur
 * @param integer $RAP_NUM numero du rappport du collaborateur
 * @return array un tableau de tableau associatif contenant les informations des echantillions
 */
function getLesEchantillions(string $COL_MATRICULE, int $RAP_NUM): array
{
    $req = connexionPDO()->prepare('
    SELECT 
        o.MED_DEPOTLEGAL AS "med",
        o.OFF_QTE AS "qte",
        m.MED_NOMCOMMERCIAL AS "medName"
    FROM 
        offrir o
    INNER JOIN 
        medicament m
        ON
        o.MED_DEPOTLEGAL=m.MED_DEPOTLEGAL
    WHERE
        COL_MATRICULE=:COL_MATRICULE
        AND
        RAP_NUM=:RAP_NUM
    ;');
    $req->bindValue(':COL_MATRICULE', $COL_MATRICULE, PDO::PARAM_STR);
    $req->bindValue(':RAP_NUM', $RAP_NUM, PDO::PARAM_INT);
    $req->execute();
    return $req->fetchAll(PDO::FETCH_ASSOC);
}

/**
 * Permet de mettre à jour les echantillions d'un rapport
 *
 * @param string $COL_MATRICULE matricule d'un collaborateur
 * @param integer $RAP_NUM numero du rappport du collaborateur
 * @param array $echs les echantillions sous forme d'un tableau de tableau associatif
 * @return void
 */
function updateLesEchantillions(string $COL_MATRICULE, int $RAP_NUM, array $echs): void
{
    $pdo = connexionPDO();
    $pdo->beginTransaction();
    try {
        //delete
        $del = $pdo->prepare('
            DELETE FROM
                offrir
            WHERE
                COL_MATRICULE=:COL_MATRICULE
                AND
                RAP_NUM=:RAP_NUM
        ;');
        $del->bindValue(':COL_MATRICULE', $COL_MATRICULE, PDO::PARAM_STR);
        $del->bindValue(':RAP_NUM', $RAP_NUM, PDO::PARAM_INT);
        $del->execute();

        //insert
        $mat = &$COL_MATRICULE;
        $num = &$RAP_NUM;
        $ins = $pdo->prepare('
            INSERT INTO 
                offrir(COL_MATRICULE, RAP_NUM, MED_DEPOTLEGAL, OFF_QTE)
            VALUES 
                (:COL_MATRICULE, :RAP_NUM, :MED_DEPOTLEGAL, :OFF_QTE)
        ;');
        $ins->bindParam(':COL_MATRICULE', $mat, PDO::PARAM_STR);
        $ins->bindParam(':RAP_NUM', $num, PDO::PARAM_INT);
        //pour chaque echantillion
        foreach ($echs as $ech) {
            $ins->bindValue(':OFF_QTE', $ech['qte'], PDO::PARAM_INT);
            $ins->bindValue(':MED_DEPOTLEGAL', $ech['med'], PDO::PARAM_STR);
            $ins->execute();
        }
    } catch (Exception $e) {//en cas d'erreur
        $pdo->rollBack();//annulation des requets
        throw $e;
    }
    $pdo->commit();//envoie des requets
}

/**
 * Permet d'obtenir la liste des rapports de visite d'un collaborateur avec des criteres de recherche
 *
 * @param string $matricule le matricule d'un collaborateur
 * @param string|null $startDate date de debut de l'interval de date rechercher
 * @param string|null $endDate date de fin de l'interval de date rechercher
 * @param integer|null $idPraticien identifiant du praticien concerner par le rapport
 * @return array|false tableau de tableau associtif contenant les informations d'un rapport, ou false en cas d'erreur
 */
function getSesRapports(string $matricule, ?string $startDate = null, ?string $endDate = null, mixed $idPraticien = null): mixed
{
    //constitution du where suplementaire
    $whereSup = '';
    if (!empty($startDate) && !empty($endDate)) {
        $whereSup .= ' AND r.RAP_DATE_VISITE BETWEEN :START_DATE AND :END_DATE';
    }
    if (!empty($idPraticien)) {
        $whereSup .= ' AND p.PRA_NUM=:PRA_NUM';
    }

    //requet principal
    $req = connexionPDO()->prepare('
    SELECT
        r.RAP_NUM,
        p.PRA_NUM,
        p.PRA_NOM,
        p.PRA_PRENOM,
        CASE
            WHEN r.MOT_ID = "OTH" THEN r.RAP_MOTIF_AUTRE
            ELSE mt.MOT_LIB
        END AS "MOTIF",
        r.RAP_DATE_VISITE,
        m1.MED_DEPOTLEGAL AS "MED1",
        m1.MED_NOMCOMMERCIAL AS "MED1_NAME",
        m2.MED_DEPOTLEGAL AS "MED2",
        m2.MED_NOMCOMMERCIAL AS "MED2_NAME",
        r.ETAT_ID,
        e.ETAT_LIB,
        r.ETAT_ID="C" AS "enCours"
    FROM 
        rapport_visite r
    INNER JOIN
        motif_visite mt
        ON mt.MOT_ID = r.MOT_ID
    INNER JOIN
        etat_rapport e
        ON e.ETAT_ID = r.ETAT_ID
    LEFT JOIN
        praticien p
        ON r.PRA_NUM = p.PRA_NUM
    LEFT JOIN
        medicament m1
        ON r.MED_PRESENTER_1 = m1.MED_DEPOTLEGAL
    LEFT JOIN
        medicament m2
        ON r.MED_PRESENTER_2 = m2.MED_DEPOTLEGAL
    WHERE 
        r.COL_MATRICULE=:MATRICULE
    ORDER BY
        enCours DESC,
        r.RAP_DATE_VISITE ASC
    ;');

    //parametre
    $req->bindValue(':MATRICULE', $matricule, PDO::PARAM_STR);//matricule

    if (!empty($startDate) && !empty($endDate)) {//interval de date
        $req->bindValue(':START_DATE', $startDate, PDO::PARAM_STR);
        $req->bindValue(':END_DATE', $endDate, PDO::PARAM_STR);
    }

    if (!empty($idPraticien)) {//praticien
        $req->bindValue(':PRA_NUM', $idPraticien, PDO::PARAM_INT);
    }
    
    //execution
    $req->execute();
    return $req->fetchAll(PDo::FETCH_ASSOC);
}

/**
 * Permet d'obtenir la liste des nouveaux rapports de visite de la region d'un délégué (rapport avec l'etat = V)
 *
 * @param string $matricule le matricule d'un collaborateur
 * @return array|false tableau de tableau associtif contenant les informations d'un rapport, ou false en cas d'erreur
 */
function getNewRapportRegions(string $matricule): mixed
{
    //requet principal
    $req = connexionPDO()->prepare('
        SELECT
            r.COL_MATRICULE,
            cr.COL_NOM,
            cr.COL_PRENOM,
            r.RAP_NUM,
            p.PRA_NUM,
            p.PRA_NOM,
            p.PRA_PRENOM,
            CASE
                WHEN r.MOT_ID = "OTH" THEN r.RAP_MOTIF_AUTRE
                ELSE mt.MOT_LIB
            END AS "MOTIF",
            r.RAP_DATE_VISITE,
            m1.MED_DEPOTLEGAL AS "MED1",
            m1.MED_NOMCOMMERCIAL AS "MED1_NAME",
            m2.MED_DEPOTLEGAL AS "MED2",
            m2.MED_NOMCOMMERCIAL AS "MED2_NAME",
            r.ETAT_ID,
            e.ETAT_LIB
        FROM 
            rapport_visite r
        INNER JOIN
            motif_visite mt
            ON mt.MOT_ID = r.MOT_ID
        INNER JOIN
            etat_rapport e
            ON e.ETAT_ID = r.ETAT_ID
        LEFT JOIN
            praticien p
            ON r.PRA_NUM = p.PRA_NUM
        LEFT JOIN
            medicament m1
            ON r.MED_PRESENTER_1 = m1.MED_DEPOTLEGAL
        LEFT JOIN
            medicament m2
            ON r.MED_PRESENTER_2 = m2.MED_DEPOTLEGAL
        INNER JOIN
            collaborateur cd
            ON
            cd.COL_MATRICULE=r.COL_MATRICULE
        INNER JOIN
            collaborateur cr
            ON
            cr.REG_CODE=cd.REG_CODE
        WHERE
            cd.COL_MATRICULE=:MATRICULE
            AND
            r.ETAT_ID=\'V\'
        ORDER BY
            r.COL_MATRICULE ASC,
            r.RAP_DATE_VISITE ASC
        ;');

    //parametre
    $req->bindValue(':MATRICULE', $matricule, PDO::PARAM_STR);//matricule
    
    //execution
    $req->execute();
    return $req->fetchAll(PDo::FETCH_ASSOC);
}

/**
 * Permet de mettre à jour l'etat d'un rapport de visite en fonction d'un matricule et d'un numero de rapport
 *
 * @param string $COL_MATRICULE le matricule deu collaborateur
 * @param integer $RAP_NUM le numero du rapport
 * @param string $ETAT_ID un identifiant d'etat
 * @return bool true si bien mise à jour
 */
function updateUnRapportEtat(string $COL_MATRICULE, int $RAP_NUM, string $ETAT_ID): bool
{   
    //requet de base
    $req = connexionPDO()->prepare('
        UPDATE 
            rapport_visite 
        SET
            ETAT_ID=:ETAT_ID
        WHERE
            COL_MATRICULE=:COL_MATRICULE
            AND
            RAP_NUM=:RAP_NUM
        ;
    ');

    //parametre
    $req->bindValue(':COL_MATRICULE', $COL_MATRICULE, PDO::PARAM_STR);
    $req->bindValue(':RAP_NUM', $RAP_NUM, PDO::PARAM_INT);
    $req->bindValue(':ETAT_ID', $ETAT_ID, PDO::PARAM_STR);
    
    //check de la requet
    return $req->execute();
}