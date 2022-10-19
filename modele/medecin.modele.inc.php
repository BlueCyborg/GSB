<?php

include_once 'bd.inc.php';

/**
 * Renvoie les numéros, noms et prénoms de tous les médecin
 *
 * @return array un tableau de tableau avec les informations
 */
function getAllNomMedecin(): array
{

    try {
        $monPdo = connexionPDO();
        $req = 'SELECT PRA_NUM, PRA_NOM, PRA_PRENOM FROM praticien ORDER BY PRA_NOM';
        $res = $monPdo->query($req);
        $result = $res->fetchAll();
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
