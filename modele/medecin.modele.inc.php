<?php

include_once 'bd.inc.php';

/**
 * Renvoie les numéros, noms et prénoms de tous les médecin
 *
 * @return array un tableau de tableau avec les informations
 */
function getAllNomMedecins(): array
{
    try {
        $monPdo = connexionPDO();
        $req = 'SELECT PRA_NUM, PRA_NOM, PRA_PRENOM FROM praticien ORDER BY PRA_NOM';
        $res = $monPdo->query($req);
        $result = $res->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    } catch (PDOException $e) {
        throw $e;
    }
}

/**
 * Fournie toutes les informations en fonction de l'ID du médecin
 *
 * @param integer $med identifiant du médecin
 * @return array|false si le médecin existe, renvoie un tableau sinon faux
 */
function getAllInformationsMedecin($med): array
{
    try {
        $monPdo = connexionPDO();
        $req = $monPdo->prepare('SELECT
        pr.`PRA_NUM`,
        pr.`PRA_NOM`,
        pr.`PRA_PRENOM`,
        pr.`PRA_ADRESSE`,
        pr.`PRA_CP`,
        pr.`PRA_VILLE`,
        pr.`TYP_CODE`,
        pr.`PRA_COEFNOTORIETE`,
        pr.`PRA_COEFCONFIANCE`,
        po.`POS_DIPLOME`,
        po.`POS_COEFPRESCRIPTION`
    FROM `praticien` pr
    LEFT JOIN posseder po ON
        pr.`PRA_NUM` = po.`PRA_NUM` AND
        (po.`POS_DIPLOME` IS NOT NULL OR po.`POS_COEFPRESCRIPTION` IS NOT NULL)
    WHERE pr.`PRA_NUM` = :med');
        $req->bindValue(':med', $med, PDO::PARAM_INT);
        $req->execute();
        return $req->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        throw $e;
    }
}

/**
 * Permet de savoir si l'id d'un médecin est contenue dans la bd
 *
 * @param integer $med identifiant du médecin
 * @return bool retourne true si le medecin existe
 */
function existMedecin(int $med): bool
{
    $req = connexionPDO()->prepare('SELECT PRA_NUM FROM praticien WHERE PRA_NUM=:med');
    $req->bindValue(':med', $med, PDO::PARAM_INT);
    $req->execute();
    return boolVal($req->fetch(PDO::FETCH_ASSOC));
}

/**
 * Fournie toutes les praticiens en fonction d'une région
 *
 * @param string $codeRegion Le nom de la région du visiteur délégué
 * @return array|false si des médecins existent, renvoie un tableau sinon faux
 */
function getMedecinRegion(String $codeRegion): array
{
    try {
        $monPdo = connexionPDO();
        $req = $monPdo->prepare('SELECT PRA_NUM,PRA_NOM,PRA_PRENOM FROM praticien WHERE SUBSTRING(PRA_CP, 1, 2) IN ( SELECT DEP_NUM FROM departement WHERE REG_CODE = ( SELECT REG_CODE FROM region WHERE REG_NOM = :regNom )); ');
        $req->bindValue(':regNom', $codeRegion, PDO::PARAM_STR);
        $req->execute();
        $region = $req->fetchAll(PDO::FETCH_ASSOC);
        return $region;
    } catch (PDOException $e) {
        throw $e;
    }
}

/**
 * Fournie toutes les praticiens en fonction de la région d'un collaborateur
 *
 * @param string $matricule le matricule d'un collaborateur
 * @return array|false si des médecins existent, renvoie un tableau sinon faux
 */
function getMedecinRegionCol(String $matricule): array
{
    $req = connexionPDO()->prepare('
        SELECT 
            PRA_NUM,
            PRA_NOM,
            PRA_PRENOM
        FROM 
            praticien 
        WHERE 
            SUBSTRING(PRA_CP, 1, 2) IN ( 
                                    SELECT 
                                        DEP_NUM 
                                    FROM 
                                        departement
                                    WHERE
                                        REG_CODE = ( 
                                                SELECT 
                                                    REG_CODE
                                                FROM 
                                                    collaborateur 
                                                WHERE 
                                                    COL_MATRICULE=:matricule
                                                )
                                    )
    ;');
    $req->bindValue(':matricule', $matricule, PDO::PARAM_STR);
    $req->execute();
    $region = $req->fetchAll(PDO::FETCH_ASSOC);
    return $region;
}

/**
 * Fonction permettant de mettre à jour les informations d'un médecin
 *
 * @param integer $numero ID du praticien
 * @param String $nom Nom du praticien
 * @param String $prenom Prenom du praticien
 * @param String $adresse Adresse du praticien
 * @param String $cp Code postal du praticien
 * @param String $ville Ville du praticien
 * @param float $coeffNotoriete Coefficien de notoriete du praticien
 * @param String $typeCode Type code du praticien
 * @param integer $coeffConfiance Coefficien de confiance du praticien
 * @param array $specialites Les spécialités du médecin
 * @param String $diplome Le diplome du médecin
 * @param float $coeffPrescription Le coefficient de prescription du médecin
 * @return void
 */
function updateUnMedecin($numero, $nom, $prenom, $adresse, $cp, $ville, $coeffNotoriete, $typeCode, $coeffConfiance, $specialites, $diplome, $coeffPrescription)
{
    try {
        $monPdo = connexionPDO();
        $req = $monPdo->prepare("UPDATE praticien SET PRA_NOM=:pra_nom,PRA_PRENOM=:pra_prenom,PRA_ADRESSE=:pra_adresse,PRA_CP=:pra_cp,PRA_VILLE=:pra_ville,PRA_COEFNOTORIETE=:coeff_notoriete,TYP_CODE=:typeCode,PRA_COEFCONFIANCE=:coeff_confiance WHERE PRA_NUM = :pra_num");
        $req->bindValue(':pra_num', $numero, PDO::PARAM_INT);
        $req->bindValue(':pra_nom', $nom, PDO::PARAM_STR);
        $req->bindValue(':pra_prenom', $prenom, PDO::PARAM_STR);
        $req->bindValue(':pra_adresse', $adresse, PDO::PARAM_STR);
        $req->bindValue(':pra_cp', $cp, PDO::PARAM_STR);
        $req->bindValue(':pra_ville', $ville, PDO::PARAM_STR);
        $req->bindValue(':coeff_notoriete', $coeffNotoriete, PDO::PARAM_STR);
        $req->bindValue(':typeCode', $typeCode, PDO::PARAM_STR);
        $req->bindValue(':coeff_confiance', $coeffConfiance, PDO::PARAM_INT);
        $req->execute();

        //Suppression des anciennes spécialités
        $req = $monPdo->prepare("DELETE FROM `posseder` WHERE `PRA_NUM` = :pra_num");
        $req->bindValue(':pra_num', $numero, PDO::PARAM_INT);
        $req->execute();

        //Ajout des nouvelles spécialités
        foreach ($specialites as $uneSpecialite) {
            $req = $monPdo->prepare("INSERT INTO posseder(PRA_NUM, SPE_CODE, POS_DIPLOME, POS_COEFPRESCRIPTION)
                VALUES (:med_num, :spe_code, :med_diplome, :coeff_prescription)");
            $req->bindValue(':med_num', $numero, PDO::PARAM_INT);
            $req->bindValue(':spe_code', $uneSpecialite, PDO::PARAM_STR);
            $req->bindValue(':med_diplome', $diplome, PDO::PARAM_STR);
            $req->bindValue(':coeff_prescription', $coeffPrescription, PDO::PARAM_STR);
            $req->execute();
        }
    } catch (PDOException $e) {
        throw $e;
    }
}

/**
 * Retourne tous les types de praticiens
 *
 * @return array|false Le résultat des types de praticiens
 */
function getTypePraticien(): array
{
    try {
        $monPdo = connexionPDO();
        $req = 'SELECT TYP_CODE,TYP_LIBELLE FROM type_praticien';
        $res = $monPdo->query($req);
        $result = $res->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    } catch (PDOException $e) {
        throw $e;
    }
}
/**
 * Fonction permettant de créer un médecin
 *
 * @param String $nom Nom du médecin
 * @param String $prenom Prenom du médecin
 * @param String $adresse Adresse du médecin
 * @param String $cp Code postal du médecin
 * @param String $ville Ville du médecin
 * @param float $coeffNotoriete Coefficien de notoriete du médecin
 * @param String $typeCode Type code du médecin
 * @param integer $coeffConfiance Coefficien de confiance du médecin
 * @param array $specialites Un tableau contenant les spécialités du médecin
 * @param String $diplome Le diplome du médecin
 * @param float $coeffPrescription Coefficien de prescription du médecin
 * @return void Envoie les informations du nouveau médecin dans la base de donnée
 */
function creerUnMedecin(
    String $nom,
    String $prenom,
    String $adresse,
    String $cp,
    String $ville,
    float $coeffNotoriete,
    String $typeCode,
    int $coeffConfiance,
    array $specialites,
    String $diplome,
    float $coeffPrescription
) {
    $monPdo = connexionPDO();
    $req = $monPdo->prepare("INSERT INTO praticien (PRA_NOM, PRA_PRENOM, PRA_ADRESSE, PRA_CP, PRA_VILLE, PRA_COEFNOTORIETE, TYP_CODE, PRA_COEFCONFIANCE)
        VALUES(:med_nom, :med_prenom, :med_adresse, :med_cp, :med_ville, :coeff_notoriete, :typeCode, :coeff_confiance)");
    $req->bindValue(':med_nom', $nom, PDO::PARAM_STR);
    $req->bindValue(':med_prenom', $prenom, PDO::PARAM_STR);
    $req->bindValue(':med_adresse', $adresse, PDO::PARAM_STR);
    $req->bindValue(':med_cp', $cp, PDO::PARAM_STR);
    $req->bindValue(':med_ville', $ville, PDO::PARAM_STR);
    $req->bindValue(':coeff_notoriete', $coeffNotoriete, PDO::PARAM_STR);
    $req->bindValue(':typeCode', $typeCode, PDO::PARAM_STR);
    $req->bindValue(':coeff_confiance', $coeffConfiance, PDO::PARAM_INT);
    $req->execute();

    $numMedecin = $monPdo->lastInsertId();

    foreach ($specialites as $uneSpecialite) {
        $req = $monPdo->prepare("INSERT INTO posseder(PRA_NUM, SPE_CODE, POS_DIPLOME, POS_COEFPRESCRIPTION)
            VALUES (:med_num, :spe_code, :med_diplome, :coeff_prescription)");
        $req->bindValue(':med_num', $numMedecin, PDO::PARAM_INT);
        $req->bindValue(':spe_code', $uneSpecialite, PDO::PARAM_STR);
        $req->bindValue(':med_diplome', $diplome, PDO::PARAM_STR);
        $req->bindValue(':coeff_prescription', $coeffPrescription, PDO::PARAM_STR);
        $req->execute();
    }
}

/**
 * Permet de mettre à jour le coefficien de confiance d'un medecin
 *
 * @param integer $num un numero identifiant un medecin
 * @param string $coefConf nouveau coefficien de confiance du médecin
 * @return void
 */
function updateCoefConfMedecin(int $num, string $coefConf)
{
    $req = connexionPDO()->prepare("UPDATE praticien SET PRA_COEFCONFIANCE=:coefConf WHERE PRA_NUM=:pra_num");
    $req->bindValue(':pra_num', $num, PDO::PARAM_INT);
    $req->bindValue(':coefConf', $coefConf, PDO::PARAM_STR);
    $req->execute();
}

/**
 * Retourne toutes les spécialités
 *
 * @return array|false Le résultat des différentes spécialités
 */
function getLesSpecialites(): array
{
    try {
        $monPdo = connexionPDO();
        $req = 'SELECT SPE_CODE,SPE_LIBELLE FROM specialite';
        $res = $monPdo->query($req);
        $result = $res->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    } catch (PDOException $e) {
        throw $e;
    }
}

/**
 * Récupère le libellé d'un type de médecin en fonction de son code type
 *
 * @param String $unCode Le type de code du médecin
 * @return String Le Libelle du type de médecin en fonction de son code passé en paramètre
 */
function getLibelleType(String $unCode)
{
    $req = connexionPDO()->prepare("SELECT `TYP_LIBELLE` FROM `type_praticien` WHERE `TYP_CODE` = :typeCode");
    $req->bindValue(':typeCode', $unCode, PDO::PARAM_STR);
    $req->execute();
    $res = $req->fetch(PDO::FETCH_ASSOC);
    return $res;
}

/**
 * Retourne toutes les spécialités d'un médecin en fonction de son ID
 *
 * @return array|false Retourne un tableau contenant les différentes spécialités d'un médecin
 */
function getLesSpecialitesFromMedecin($idMedecin): array
{
    $req = connexionPDO()->prepare('SELECT
    p.SPE_CODE,
    s.SPE_LIBELLE
FROM
    `posseder` p
INNER JOIN specialite s ON
    p.SPE_CODE = s.SPE_CODE
WHERE
    `PRA_NUM` = :med_id;');
    $req->bindValue(':med_id', $idMedecin, PDO::PARAM_INT);
    $req->execute();
    $res = $req->fetchAll(PDO::FETCH_ASSOC);

    // if (!empty($res)) {
    //     foreach ($res as $unRes) {
    //         $tab[] = $unRes['SPE_CODE'];
    //     }
    //     //On enlève la valeur NULL au tableau
    //     unset($tab[array_search('NULL', $tab)]);

    //     $resultat = null;

    //     if (!is_null($tab)) {
    //         $finalValue = '';
    //         //L'on met toutes les valeurs du tableau dans une seule chaine de caractère formaté pour MySql
    //         for ($i = 1; $i <= count($tab); $i++) {
    //             if ($i == count($tab)) { //Permet d'enlever la virgule à la dernière valeur
    //                 $finalValue = $finalValue . "'" . $tab[$i] . "'";
    //             } else {
    //                 $finalValue = $finalValue . "'" . $tab[$i] . "'" . ', ';
    //             }
    //         }
    //         $req = 'SELECT SPE_CODE, SPE_LIBELLE FROM specialite WHERE `SPE_CODE` IN (' . $finalValue . ');';
    //         $res = connexionPDO()->query($req);
    //         $resultat = $res->fetchAll(PDO::FETCH_ASSOC);
    //     }
    // } else {
    //     $req = 'SELECT SPE_CODE, SPE_LIBELLE FROM `specialite` ORDER BY `SPE_CODE` ASC LIMIT 1; ';
    //     $res = connexionPDO()->query($req);
    //     $resultat = $res->fetchAll(PDO::FETCH_ASSOC);
    // }
    //
    //return $resultat;

    return $res;
}
