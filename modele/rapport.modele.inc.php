<?php

require_once 'bd.inc.php';

/**
 * Permet de recupéré la liste des rapports en cours de saisie d'un visiteur
 *
 * @param string $matricule le matricule d'un visiteur
 * @return array liste des rapports en cours de saisie (COL_MATRICULE, RAP_NUM, PRA_NUM, RAP_DATE_VISITE, MOTIF)
 */
function getIdRapportNonValides(string $matricule): array
{
    $req = connexionPDO()->prepare('
    SELECT
        r.COL_MATRICULE,
        r.RAP_NUM,
        r.PRA_NUM,
        r.RAP_DATE_VISITE,
        CASE
            WHEN r.MOT_ID = \'OTH\' THEN r.RAP_MOTIF_AUTRE
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
    $req->bindValue(':matricule', $matricule, PDo::PARAM_STR);
    $req->execute();
    $res = $req->fetchAll(PDO::FETCH_ASSOC);
    if (!$res) {
        $res = array();
    }
    
    return $res;
}