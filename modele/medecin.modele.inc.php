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
        print "Erreur !: " . $e->getMessage();
        die();
    }
}

/**
 * Fournie toutes les informations en fonction de l'ID du médecin
 *
 * @param integer $med identifiant du médecin
 * @return array|false si le médecin existe, renvoie un tableau sinon faux
 */
function getAllInformationsMedecin(int $med): mixed
{
    try {
        $monPdo = connexionPDO();
        $req = $monPdo->prepare('SELECT * FROM praticien WHERE PRA_NUM = :med');
        $req->bindValue(':med', $med, PDO::PARAM_INT);
        $req->execute();
        return $req->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }
}
/**
 * Fournie toutes les praticiens en fonction de la région du visiteur délégué
 *
 * @param string $codeRegion Le nom de la région du visiteur délégué
 * @return array|false si des médecins existent, renvoie un tableau sinon faux
 */
function getMedecinRegion(String $codeRegion): mixed
{
    try {
        $monPdo = connexionPDO();
        $req = $monPdo->prepare('SELECT `PRA_NUM`,`PRA_NOM`,`PRA_PRENOM` FROM praticien WHERE SUBSTRING(PRA_CP, 1, 2) IN ( SELECT DEP_NUM FROM departement WHERE REG_CODE = ( SELECT REG_CODE FROM region WHERE REG_NOM = :regNom )); ');
        $req->bindValue(':regNom', $codeRegion, PDO::PARAM_STR);
        $req->execute();
        $region = $req->fetchAll();
        return $region;
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }
}
/**
 * Fonction permettant de gérer les informations d'un médecin
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
 * @return void
 */
function gererUnMedecin(int $numero, String $nom, String $prenom, String $adresse, String $cp, String $ville, float $coeffNotoriete, String $typeCode, int $coeffConfiance)
{
    try {
        $monPdo = connexionPDO();
        $req = $monPdo->prepare("UPDATE `praticien` SET `PRA_NOM`=:pra_nom,`PRA_PRENOM`=:pra_prenom,`PRA_ADRESSE`=:pra_adresse,`PRA_CP`=:pra_cp,`PRA_VILLE`=:pra_ville,`PRA_COEFNOTORIETE`=:coeff_notoriete,`TYP_CODE`=:typeCode,`PRA_COEFCONFIANCE`=:coeff_confiance WHERE `PRA_NUM` = :pra_num");
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
        $region = $req->fetch();
        return $region;
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }
}
