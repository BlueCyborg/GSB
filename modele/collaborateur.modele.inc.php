<?php

include_once 'bd.inc.php';

/**
 * Permet de récupéré les information d'un collaborateur en fonction de son matricule
 *
 * @param $matricule matricule d'un colborateur
 * @return array|false tabelau associatif contenant les informations ou false si matricule pas trouvé
 */
function getAllInformationCompte($matricule): array
{
    $monPdo = connexionPDO();
    $req = $monPdo->prepare('SELECT c.`COL_MATRICULE` as `matricule`,c.`COL_NOM` as `nom`,`COL_PRENOM` as `prenom`,c.`COL_ADRESSE` as `adresse`,c.`COL_CP` as `cp`,c.`COL_VILLE` as `ville`, concat(DAY(COL_DATEEMBAUCHE),\'/\',MONTH(`COL_DATEEMBAUCHE`),\'/\',YEAR(`COL_DATEEMBAUCHE`)) as `date_embauche`, h.HAB_LIB as `habilitation` ,s.SEC_LIBELLE as `secteur`, r.REG_NOM as `region` FROM collaborateur c LEFT JOIN secteur s ON s.`SEC_CODE`=c.`SEC_CODE` LEFT JOIN habilitation h ON h.HAB_ID=c.HAB_ID LEFT JOIN region r ON r.REG_CODE=c.REG_CODE WHERE c.COL_MATRICULE = :matricule');
    $req->bindValue(':matricule', $matricule, PDO::PARAM_STR);
    $req->execute();
    $res = $req->fetch(PDO::FETCH_BOTH);
    return $res;
}

/**
 * Permet de récupéré le nom, le prenom et le matricule d'un collaborateur en fonction de son matricule
 *
 * @param $matricule matricule d'un colborateur
 * @return array|false tabelau associatif contenant les informations ou false si matricule pas trouvé
 */
function getNomCollaborateur($matricule): array
{
    $req = connexionPDO()->prepare('
        SELECT 
            COL_MATRICULE,
            COL_NOM,
            COL_PRENOM
        FROM
            collaborateur
        WHERE 
            COL_MATRICULE=:matricule
    ;');
    $req->bindValue(':matricule', $matricule, PDO::PARAM_STR);
    $req->execute();
    return $req->fetch(PDO::FETCH_ASSOC);
}

/**
 * Permet d'effectuer l'authentification d'un utilisateur
 *
 * @param string $username nom de l'utilisateur
 * @param string $pass mot de passe de l'utilisateur
 * @return array|false tableau associtif avec les informations du collacorateur (matricule, habilitation, log_id), ou false si mauvaise identification
 */
function checkConnexion(string $username, string $pass)
{
    $monPdo = connexionPDO();
    $req = $monPdo->prepare('SELECT l.LOG_ID as \'id_log\', l.COL_MATRICULE as \'matricule\', c.HAB_ID as \'habilitation\' FROM login l INNER JOIN collaborateur c ON l.COL_MATRICULE = c.COL_MATRICULE WHERE l.LOG_LOGIN = :identifiant AND l.LOG_MOTDEPASSE = :password');
    $req->bindValue(':identifiant', $username, PDO::PARAM_STR);
    $req->bindValue(':password', hash('sha512', $pass), PDO::PARAM_STR);
    $req->execute();
    $res = $req->fetch(PDO::FETCH_ASSOC);
    return $res;
}

/**
 * Permet de savoir si un matricule existe dans la table login
 *
 * @param string $matricule un matricule
 * @return bool true si la tabel contient le matricule
 */
function checkMatriculeInscription(string $matricule): bool
{
    $getInfo = connexionPDO();
    $req = $getInfo->prepare('select `COL_MATRICULE` as \'matricule\' from login where `COL_MATRICULE`=:matricule');
    $req->bindValue(':matricule', $matricule, PDO::PARAM_STR);
    $req->execute();
    $res = $req->fetch(PDO::FETCH_ASSOC);
    return $res;
}

/**
 * Permet de savoir si un matricule existe dans la table collaborateur
 *
 * @param string $matricule un matricule
 * @return bool true si la tabel contient le matricule
 */
function checkMatricule($matricule): bool
{
    $monPdo = connexionPDO();
    $req = $monPdo->prepare('select `COL_MATRICULE` as \'matricule\' from collaborateur where `COL_MATRICULE`=:matricule');
    $req->bindValue(':matricule', $matricule, PDO::PARAM_STR);
    $req->execute();
    $res = $req->fetch(PDO::FETCH_ASSOC);
    return $res;
}

/**
 * Permet de savoir si un login existe
 *
 * @param string $username login de l'utilisateur
 * @return bool true si le login existe déja
 */
function checkUserInscription(string $username): bool
{
    $req = connexionPDO()->prepare('SELECT `LOG_LOGIN` from login where `LOG_LOGIN`=:username');
    $req->bindValue(':username', $username, PDO::PARAM_STR);
    $req->execute();
    return $req->fetch(PDO::FETCH_ASSOC);
}

/**
 * Permet de récupéré la liste des matricule des collabotrateurs
 *
 * @return array tableau de tableau associtif contenue les matricule ou false
 */
function getAllMatriculeCollaborateur(): array
{
    $monPdo = connexionPDO();
    $req = 'SELECT COL_MATRICULE FROM collaborateur ORDER BY COL_MATRICULE';
    $res = $monPdo->query($req);
    $result = $res->fetchAll(PDO::FETCH_ASSOC);

    return $result;
}

/**
 * Permet de connaitre le nombre de collaborateur
 *
 * @return array le nombre de collaborateur
 */
function getCountMatricule(): array
{
    $monPdo = connexionPDO();
    $req = 'SELECT COUNT(COL_MATRICULE) as \'nb\' FROM collaborateur';
    $res = $monPdo->query($req);
    $result = $res->fetch(PDO::FETCH_ASSOC);

    return $result;
}

/**
 * Permet de savoir si deux collaborateur son de la meme region
 *
 * @param string $colMat un matricule de collaborateur
 * @param string $degMat un matricule de collaborateur
 * @return bool true si les deux collaborateur existe et si ils sont de la même region, sinon false
 */
function memeRegion(string $colMat, string $degMat): bool
{
    $req = connexionPDO()->prepare('
        SELECT
            cd.REG_CODE
        FROM
            collaborateur cd
        INNER JOIN
            collaborateur c
            ON
            c.REG_CODE=cd.REG_CODE
        WHERE
            c.COL_MATRICULE=:colMat
            AND
            cd.COL_MATRICULE=:degMat
    ;');

    $req->bindValue(':colMat', $colMat, PDO::PARAM_STR);
    $req->bindValue(':degMat', $degMat, PDO::PARAM_STR);
    $req->execute();
    return boolval($req->fetch(PDO::FETCH_ASSOC));
}

/**
 * Permet d'avoir la liste des nom des collaborateurs de la meme region que le collaborateur du matricule donné
 *
 * @param string $degMat un matricule d'un collaborateur
 * @return array|false tableau de tabelau associf ayant les informaions (nom, prenom, matricule), sinon false si erreur
 */
function getNomCollaborateursMemeRegion(string $degMat): array
{
    $req = connexionPDO()->prepare('
        SELECT
            c.COL_MATRICULE,
            c.COL_NOM,
            c.COL_PRENOM
        FROM
            collaborateur c
        INNER JOIN
            collaborateur cd
            ON
            cd.REG_CODE=c.REG_CODE
        WHERE
            cd.COL_MATRICULE=:degMat
    ;');

    $req->bindValue(':degMat', $degMat, PDO::PARAM_STR);
    $req->execute();

    return $req->fetchAll(PDO::FETCH_ASSOC);
}

