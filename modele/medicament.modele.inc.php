<?php

include_once 'bd.inc.php';

/**
 * Retourne la référence et le nom de tous les médicaments de la table medicament
 *
 * @return array|false Retourne un tableau contenenant tous les médicaments de la table ou false si rien n'est retourné
 */
function getAllNomMedicaments(): array|false
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
function getAllInformationMedicamentDepot($depot): array|bool
{
    try {
        $req = connexionPDO()->prepare('SELECT m.MED_DEPOTLEGAL AS \'depotlegal\', m.MED_NOMCOMMERCIAL AS \'nomcom\', m.MED_COMPOSITION AS \'compo\', m.MED_EFFETS AS \'effet\', m.MED_CONTREINDIC AS \'contreindic\', m.MED_PRIXECHANTILLON AS \'prixechan\', f.FAM_LIBELLE AS \'famille\' FROM medicament m INNER JOIN famille f ON f.FAM_CODE = m.FAM_CODE WHERE MED_DEPOTLEGAL = :depot');
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
function getAllInformationMedicamentNom($nom): array|false
{
    try {
        $req = connexionPDO()->prepare('SELECT m.MED_DEPOTLEGAL as \'depotlegal\', m.MED_NOMCOMMERCIAL as \'nomcom\', m.MED_COMPOSITION as \'compo\', m.MED_EFFETS as \'effet\', m.MED_CONTREINDIC as \'contreindic\', m.MED_PRIXECHANTILLON as \'prixechan\', f.FAM_LIBELLE as \'famille\' FROM medicament m INNER JOIN famille f ON f.FAM_CODE = m.FAM_CODE WHERE MED_NOMCOMMERCIAL = :nom');
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
function getDepotMedoc($depot): array|false
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
        $req = 'SELECT COUNT(MED_DEPOTLEGAL) as \'nb\' FROM medicament';
        $res = $monPdo->query($req);
        $result = $res->fetch(PDO::FETCH_ASSOC);
        return $result;
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }
}
