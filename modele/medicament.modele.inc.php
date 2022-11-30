<?php

include_once 'bd.inc.php';

/**
 * Retourne la référence et le nom de tous les médicaments de la table medicament
 *
 * @return array|false Retourne un tableau contenenant tous les médicaments de la table ou false si rien n'est retourné
 */
function getAllNomMedicaments(): mixed
{
    try {
        $monPdo = connexionPDO();
        $req = 'SELECT MED_DEPOTLEGAL, MED_NOMCOMMERCIAL FROM medicament ORDER BY MED_NOMCOMMERCIAL';
        $res = $monPdo->query($req);
        $result = $res->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }
}
/**
 * Retourne toutes les informations concernant un médicament ainsi que son libellé de famille grâce à son dépôt légal
 *
 * @param String $depot Le nom de la référence du médicament
 * @return array|false Retourne un tableau contenenant toutes les informations concernant le médicament ou false si il ne retourne rien
 */
function getAllInformationMedicamentDepot($depot): mixed
{
    try {
        $req = connexionPDO()->prepare('SELECT m.MED_DEPOTLEGAL, m.MED_NOMCOMMERCIAL, m.MED_COMPOSITION, m.MED_EFFETS, m.MED_CONTREINDIC, m.MED_PRIXECHANTILLON, f.FAM_LIBELLE FROM medicament m INNER JOIN famille f ON f.FAM_CODE = m.FAM_CODE WHERE MED_DEPOTLEGAL = :depot');
        $req->bindValue(':depot', $depot);
        $req->execute();
        $result = $req->fetch(PDO::FETCH_ASSOC);
        return $result;
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }
}
/**
 * Retourne toutes les informations concernant un médicament ainsi que son libellé de famille en fonction de son nom
 *
 * @param String $depot Le nom de la référence du médicament
 * @return array|false Retourne un tableau contenenant toutes les informations concernant le médicament ou false sinon
 */
function getAllInformationMedicamentNom($nom): mixed
{
    try {
        $req = connexionPDO()->prepare('SELECT m.MED_DEPOTLEGAL, m.MED_NOMCOMMERCIAL, m.MED_COMPOSITION, m.MED_EFFETS, m.MED_CONTREINDIC, m.MED_PRIXECHANTILLON, f.FAM_LIBELLE FROM medicament m INNER JOIN famille f ON f.FAM_CODE = m.FAM_CODE WHERE MED_NOMCOMMERCIAL = :nom');
        $req->bindValue(':nom', $nom);
        $req->execute();
        $result = $req->fetch(PDO::FETCH_ASSOC);
        return $result;
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }
}
/**
 * Retourne le nom et le depot légal de tous les médicaments contenant le dépot légal passé en paramètre
 *
 * @param String $depot Le dépôt légal du médicament
 * @return array|false Un tableau contenant toutes les médicaments
 */
function getDepotMedoc($depot): mixed
{
    try {
        $req = connexionPDO()->prepare('SELECT MED_DEPOTLEGAL, MED_NOMCOMMERCIAL FROM medicament WHERE MED_DEPOTLEGAL = :depot');
        $req->bindValue(':depot', $depot);
        $req->execute();
        $result = $req->fetch(PDO::FETCH_ASSOC);
        return $result;
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }
}
/**
 * Retourne le nombre de médicaments
 *
 * @return integer Le nombre de médicaments dans la table medicament
 */
function getNbMedicament(): int
{
    try {
        $monPdo = connexionPDO();
        $req = 'SELECT COUNT(MED_DEPOTLEGAL) FROM medicament';
        $res = $monPdo->query($req);
        $result = $res->fetch(PDO::FETCH_ASSOC);
        return $result;
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }
}
