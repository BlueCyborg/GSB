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
function getMedecinRegion(String $codeRegion): mixed
{
    try {
        $monPdo = connexionPDO();
        //Séléction du nom du département
        $req = $monPdo->prepare('SELECT REG_CODE FROM region WHERE REG_NOM = :regNom');
        $req->bindValue(':regNom', $codeRegion, PDO::PARAM_STR);
        $req->execute();
        $code = $req->fetch(PDO::FETCH_ASSOC);
        //Séléction des départements en fonction de la région
        $req = $monPdo->prepare('SELECT DEP_NUM FROM departement WHERE REG_CODE = :regCode');
        $req->bindValue(':regCode', $code['REG_CODE'], PDO::PARAM_STR);
        $req->execute();
        $region = $req->fetchAll(PDO::FETCH_ASSOC);
        //Séléction des praticiens en fonction des départements
        $req = $monPdo->prepare('SELECT * FROM praticien WHERE PRA_CP = :region');
        $req->bindValue(':region', $region, PDO::PARAM_STR);
        $req->execute();
        $region = $req->fetchAll(PDO::FETCH_ASSOC);
        return $region;
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }
}
