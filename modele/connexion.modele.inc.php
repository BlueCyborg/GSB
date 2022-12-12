<?php

include_once 'bd.inc.php';

/**
 * Permet de récupéré les information d'un collaborateur en fonction de son matricule
 *
 * @param $matricule matricule d'un colborateur
 * @return array|false tabelau associatif contenant les informations ou false si matricule pas trouvé
 */
function getAllInformationCompte($matricule): mixed
{

    try {
        $monPdo = connexionPDO();
        $req = $monPdo->prepare('SELECT c.`COL_MATRICULE` as `matricule`,c.`COL_NOM` as `nom`,`COL_PRENOM` as `prenom`,c.`COL_ADRESSE` as `adresse`,c.`COL_CP` as `cp`,c.`COL_VILLE` as `ville`, concat(DAY(COL_DATEEMBAUCHE),\'/\',MONTH(`COL_DATEEMBAUCHE`),\'/\',YEAR(`COL_DATEEMBAUCHE`)) as `date_embauche`, h.HAB_LIB as `habilitation` ,s.SEC_LIBELLE as `secteur`, r.REG_NOM as `region` FROM collaborateur c LEFT JOIN secteur s ON s.`SEC_CODE`=c.`SEC_CODE` LEFT JOIN habilitation h ON h.HAB_ID=c.HAB_ID LEFT JOIN region r ON r.REG_CODE=c.REG_CODE WHERE c.COL_MATRICULE = :matricule');
        $req->bindValue(':matricule', $matricule, PDO::PARAM_STR);
        $req->execute();
        $res = $req->fetch();
        return $res;
    } catch (PDOException $e) {
        throw $e;
    }
}

/**
 * Permet d'effectuer l'authentification d'un utilisateur
 *
 * @param string $username nom de l'utilisateur
 * @param string $pass mot de passe de l'utilisateur
 * @return array|false tableau associtif avec les informations du collacorateur (matricule, habilitation, log_id), ou false si mauvaise identification
 */
function checkConnexion(string $username, string $pass): mixed
{

    try {
        $monPdo = connexionPDO();
        $req = $monPdo->prepare('SELECT l.LOG_ID as \'id_log\', l.COL_MATRICULE as \'matricule\', c.HAB_ID as \'habilitation\' FROM login l INNER JOIN collaborateur c ON l.COL_MATRICULE = c.COL_MATRICULE WHERE l.LOG_LOGIN = :identifiant AND l.LOG_MOTDEPASSE = :password');
        $req->bindValue(':identifiant', $username, PDO::PARAM_STR);
        $req->bindValue(':password', hash('sha512', $pass), PDO::PARAM_STR);
        $req->execute();
        $res = $req->fetch();
        return $res;
    } catch (PDOException $e) {
        throw $e;
    }
}

/**
 * Permet de savoir si un matricule existe dans la table login
 *
 * @param string $matricule un matricule
 * @return bool true si la tabel contient le matricule
 */
function checkMatriculeInscription(string $matricule): bool
{

    try {
        $getInfo = connexionPDO();
        $req = $getInfo->prepare('select `COL_MATRICULE` as \'matricule\' from login where `COL_MATRICULE`=:matricule');
        $req->bindValue(':matricule', $matricule, PDO::PARAM_STR);
        $req->execute();
        $res = $req->fetch();
        return $res;
    } catch (PDOException $e) {
        throw $e;
    }
}

/**
 * Permet de savoir si un matricule existe dans la table collaborateur
 *
 * @param string $matricule un matricule
 * @return bool true si la tabel contient le matricule
 */
function checkMatricule($matricule): bool
{

    try {
        $monPdo = connexionPDO();
        $req = $monPdo->prepare('select `COL_MATRICULE` as \'matricule\' from collaborateur where `COL_MATRICULE`=:matricule');
        $req->bindValue(':matricule', $matricule, PDO::PARAM_STR);
        $req->execute();
        $res = $req->fetch();
        return $res;
    } catch (PDOException $e) {
        throw $e;
    }
}

/**
 * Permet de savoir si un login existe
 *
 * @param string $username login de l'utilisateur
 * @return bool true si le login existe déja
 */
function checkUserInscription(string $username): bool
{

    try {
        $getInfo = connexionPDO();
        $req = $getInfo->prepare('SELECT `LOG_LOGIN` from login where `LOG_LOGIN`=:username');
        $req->bindValue(':username', $username, PDO::PARAM_STR);
        $req->execute();
        $res = $req->fetch();
        return $res;
    } catch (PDOException $e) {
        throw $e;
    }
}

/**
 * Permet de récupéré la liste des matricule des collabotrateurs
 *
 * @return array tableau de tableau associtif contenue les matricule ou false
 */
function getAllMatriculeCollaborateur(): mixed
{

    try {

        $monPdo = connexionPDO();
        $req = 'SELECT COL_MATRICULE FROM collaborateur ORDER BY COL_MATRICULE';
        $res = $monPdo->query($req);
        $result = $res->fetchAll();

        return $result;
    } catch (PDOException $e) {
        throw $e;
    }
}

/**
 * Permet de connaitre le nombre de collaborateur
 *
 * @return mixed le nombre de collaborateur
 */
function getCountMatricule(): mixed
{

    try {

        $monPdo = connexionPDO();
        $req = 'SELECT COUNT(COL_MATRICULE) as \'nb\' FROM collaborateur';
        $res = $monPdo->query($req);
        $result = $res->fetch();

        return $result;
    } catch (PDOException $e) {
        throw $e;
    }
}