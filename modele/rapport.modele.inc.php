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
            `COL_MATRICULE`, `RAP_NUM`, `PRA_NUM`, `RAP_DATE_VISITE`,
            `RAP_BILAN`, `RAP_MOTIF_AUTRE`, `REMP_NUM`, `MOT_ID`, `ETAT_ID`,
            `RAP_DATE_SAISIE`, `MED_PRESENTER_1`, `MED_PRESENTER_2` 
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