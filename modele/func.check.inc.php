<?php

include_once 'medecin.modele.inc.php';
include_once 'medicament.modele.inc.php';
include_once 'rapport.modele.inc.php';

/**
 * Permet de verifier si une chaine de caratère fais moins ou egale à taille
 *
 * @param string $str chaine de caratère testé
 * @param integer $taille taille maximal incluse
 * @return boolean true si la chaine de caratère est égale ou fait moins que la taille
 */
function moinsDe(string $str, int $taille): bool
{
    return strlen($str) <= $taille;
}

/**
 * Permet de vérifier si un identifiant de médicament est correct
 *
 * @param array $idMed
 * @param bool $canNull si l'id peut etre non définie, par default true
 * @return array message d'erreur pour l'identifiant 
 */
function checkIdMed($idMed, bool $canNull = true): array
{
    $err = array();

    if (moinsDe($idMed, 10)) {
        if (!((empty($idMed1) && $canNull) || existMedicamentDepot($idMed))) {
            $err[] = "Identifiant de médicament n'existe pas !";
        }
    } else {
        $err[] = "Identifiant de médicament trop long ! (supérieur à 10)";
    }

    return $err;
}

/**
 * Permet de vérifier si une date est corecte
 *
 * @param array $date chaine de texte verifié
 * @return boolean true si la date est valide
 */
function dateValid($date): bool
{
    return preg_match('/^[0-9]{4}-[0-9]{2}-[0-9]{2}$/', $date) == 1;
}

/**
 * Permet de vérifier si une chaine est un nombre
 *
 * @param array $nombre chaine de texte verifié
 * @return boolean true si c'est un nombre
 */
function estUnNombre($nombre): bool
{
    return preg_match('/[^[0-9]]/', $nombre) == 0;
}

/**
 * Permet de vérifier si une chaine est un nombre positif et supérieur à 0
 *
 * @param array $nombre chaine de texte verifié
 * @return boolean true si c'est un nombre
 */
function estUnNombreSup0($nombre): bool
{
    return preg_match('/^[1-9][0-9]*$/', $nombre) == 1;
}

/**
 * Permet de vérifier la validiter d'un formulaire de rapport
 *
 * @param array $matricule matricule du collaborateur
 * @param array $rapNum un numéro du rapport
 * @param array $idPratiecien un identifiant de praticien
 * @param array $bilan un texte de bilan
 * @param array $dateDeVisite une date
 * @param array $idMotif un identifiant de motif
 * @param array $autreMotif un text pour représenter le motif
 * @param array $idMed1 le premier un identifiant de médicament
 * @param array $idMed2 le premier deuxième identifiant de médicament
 * @param array $coefConf coefficiant de conficance du medecin
 * @return array tableau des erreur avec les champs
 */
function checkFormRapport($matricule, $rapNum, $idPraticien, $unRemplacant, $bilan, $dateDeVisite, $idMotif, $autreMotif, $idMed1, $idMed2, $coefConf): array
{
    $msgErr = array();

    if (!estUnNombre($rapNum) || !getUnRapport($matricule, $rapNum)) {
        $msgErr[] = "Le numéro du rapport est inexistant !";
    }

    if (!empty($idPraticien) && (!estUnNombre($idPraticien) || !existMedecin((int) $idPraticien))) {
        $msgErr[] = "L'identifiant du praticien est inexistant !";
    }

    if (!empty($unRemplacant) && (!estUnNombre($unRemplacant) || !existMedecin((int) $unRemplacant))) {
        $msgErr[] = "L'identifiant du remplacent praticien est inexistant !";
    }

    if (!empty($dateDeVisite) && !dateValid($dateDeVisite)) {
        $msgErr[] = "Le format de la date de visite est incorrecte !";
    }

    if (!moinsDe($idMotif, 3) || !getUnMotifById($idMotif)) {
        $msgErr[] = "Le motif type ne corespond à aucun motif type enregistré !";
    }

    if (!moinsDe($bilan, 255)) {
        $msgErr[] = "Le bilan est trop grand ! (superieur à 255)";
    }

    if (!moinsDe($autreMotif, 255)) {
        $msgErr[] = "Le motif autre est trop grand ! (superieur à 255)";
    }

    if (preg_match('/^[0-9]{1,3}$|^[0-9]{1,3}\.[0-9]{0,2}$/', $coefConf) != 1) {
        $msgErr[] = "Le format du coefficien de confiance n'est pas respecté ! (nombre entre 999.99 et 0)";
    }

    $msgErr = array_merge($msgErr, checkIdMed($idMed1));
    $msgErr = array_merge($msgErr, checkIdMed($idMed2));

    return $msgErr;
}

/**
 * Permet de vérifier la validiter d'un formulaire de rapport lors de la saisie definitive
 *
 * @param array $matricule matricule du collaborateur
 * @param array $rapNum un numéro du rapport
 * @param array $idPratiecien un identifiant de praticien
 * @param array $bilan un texte de bilan
 * @param array $dateDeVisite une date
 * @param array $idMotif un identifiant de motif
 * @param array $autreMotif un text pour représenter le motif
 * @param array $idMed1 le premier un identifiant de médicament
 * @param array $idMed2 le premier deuxième identifiant de médicament
 * @return array tableau des erreur avec les champs
 */
function checkFormRapportDef($idPraticien, $bilan, $dateDeVisite, $idMotif, $autreMotif): array
{
    $msgErr = array();

    if (empty($idMotif)) {
        $msgErr[] = 'Veuillez saisir le motif !';
    }

    if ($idMotif === 'OTH' && empty($autreMotif)) {
        $msgErr[] = 'Veuillez saisir le motif autre !';
    }

    if (empty($idPraticien)) {
        $msgErr[] = 'Veuillez saisir le praticien !';
    }

    if (empty($dateDeVisite)) {
        $msgErr[] = 'Veuillez saisir la date de visite !';
    }

    if (empty($bilan)) {
        $msgErr[] = 'Veuillez saisir le bilan !';
    }

    /*
    if (empty(niveau confiance)) {

    }
    */

    return $msgErr;
}

/**
 * Permet de vérifier la validiter d'un ensemble de formulaire d'echantillions
 *
 * @param array $lesEchantillions tableau des échantillions du rapport
 * @return array tableau des erreur avec les champs
 */
function checkFormRapportEchs(array $lesEchantillions): array
{
    $msgErr = array();

    if (is_array($lesEchantillions)) {
        $meds = array();
        foreach ($lesEchantillions as $ech) { //pour chaque les echantillions
            if (is_array($ech)) {
                $med = $ech['med'];

                //test echantillion
                array_merge($msgErr, checkIdMed($med, false));
                if (!estUnNombreSup0($ech['qte'])) {
                    $msgErr[] = 'La quantité d\'un echantillion doit être supérieur ou égale à 1 !';
                }

                //test doublon medicament
                if (in_array($med, $meds)) {
                    $msgErr[] = 'Vous devez reunir en une seul ligne les échantillions du même médicament ! (' . $med . ')';
                } else {
                    $meds[] = $med;
                }
            } else {
                $msgErr[] = 'Chaque échantilion dois être sous forme de tableau !';
            }
        }
    } else {
        $msgErr[] = 'Les échantillions doivent être sous forme de tableau !';
    }

    return $msgErr;
}

/**
 * Permet de tester si des paramètres de fourchette de date sont valides
 *
 * @param array $startDate une date
 * @param array $endDate une date
 * @return array tableau de message d'erreur pour les champs
 */
function checkFourchetteDate($startDate, $endDate)
{
    $msgErr = array();

    if (!empty($startDate) == empty($endDate)) {
        $msgErr[] = "Pour définir un interval, vous devez saisir la date de debut et de fin pour définir cet interval !";
    }

    if (!empty($startDate) && !dateValid($startDate)) {
        $msgErr[] = "Le format de la date de depart est incorrecte !";
    }

    if (!empty($endDate) && !dateValid($endDate)) {
        $msgErr[] = "Le format de la date de fin est incorrecte !";
    }

    return $msgErr;
}

/**
 * Permet de tester si les paramètres du formulaire de recherche de ses rapport
 *
 * @param array $startDate une date
 * @param array $endDate une date
 * @param array $idPraticien un identifiant de praticien
 * @return array tableau de message d'erreur pour les champs
 */
function checkFormulaireRechercheMesRapport($startDate, $endDate, $idPraticien): array
{
    $msgErr = checkFourchetteDate($startDate, $endDate);

    if (!empty($idPraticien) && (!estUnNombre($idPraticien) || !existMedecin((int) $idPraticien))) {
        $msgErr[] = "L'identifiant du praticien est inexistant !";
    }

    return $msgErr;
}

/**
 * Permet de tester si les paramètres du formulaire de recherche de l'historique des rapport de region
 *
 * @param array $startDate une date
 * @param array $endDate une date
 * @param array $colMat matricule d'un collaborateur
 * @param array $degMat matricule du délegué du collaborateur
 * @return array tableau de message d'erreur pour les champs
 */
function checkFormulaireRechercheHistoryRapportRegion($startDate, $endDate, $colMat, $degMat): array
{
    $msgErr = checkFourchetteDate($startDate, $endDate);

    if (!empty($colMat) && !memeRegion($colMat, $degMat)) {
        $msgErr[] = "Le matricule du visteur ne fait pas partie de votre region !";
    }

    return $msgErr;
}

/**
 * Fonction qui permet de vérifier si une spécialitée est unique
 * @param array $tableau Les spécialités que l'utilisateur aura choisi
 * @return String Retourne un String si toutes les spécialités sont différentes
 */
function checkUniciteSpecialite(array $tableau): array
{
    $msgErr[] = "";
    $check = null;
    $length = count($tableau);
    for ($i = 1; $i <= $length; $i++) {
        $check = $tableau[$i];
        $count = 0;
        foreach ($tableau as $uneSpecialite) {
            if ($check == $uneSpecialite) {
                $count++;
            }
            if ($count == 2) { // Si la valeur comparée existe deux fois
                $msgErr[] = "Veuillez choisir une spécialitée différente à chaque fois !";
                $i = $length; // Sortie de boucle
            }
        }
    }
    return $msgErr;
}
