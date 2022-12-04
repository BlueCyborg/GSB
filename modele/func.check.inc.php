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
 * @param [type] $idMed
 * @return array message d'erreur pour l'identifiant 
 */
function checkIdMed($idMed) : array
{
    $err = array();

    if (moinsDe($idMed, 10)) {
        if (!empty($idMed1) && !getAllInformationMedicamentDepot($idMed)) {
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
 * @param [type] $date chaine de texte verifier
 * @return boolean true si la date est valide
 */
function dateValid($date): bool
{
    return preg_match('/^[0-9]{4}-[0-9]{2}-[0-9]{2}$/', $date) == 1;
}

/**
 * Permet de vérifier si c'est un nombre
 *
 * @param [type] $nombre chaine de texte verifier
 * @return boolean true si c'est un nombre
 */
function estUnNombre($nombre): bool
{
    return preg_match('/[^[0-9]]/', $nombre) == 0;
}

/**
 * Permet de vérifier la validiter d'un formulaire de rapport
 *
 * @param mixed $matricule matricule du collaborateur
 * @param mixed $rapNum un numéro du rapport
 * @param mixed $idPratiecien un identifiant de praticien
 * @param mixed $dateDeSaisie une date
 * @param mixed $bilan un texte de bilan
 * @param mixed $dateDeVisite une date
 * @param mixed $idMotif un identifiant de motif
 * @param mixed $autreMotif un text pour représenter le motif
 * @param mixed $idMed1 le premier un identifiant de médicament
 * @param mixed $idMed2 le premier deuxième identifiant de médicament
 * @return array tableau des erreur avec les champs
 */
function checkFormRapport($matricule, $rapNum, $idPraticien, $unRemplacant, $dateDeSaisie, $bilan, $dateDeVisite, $idMotif, $autreMotif, $idMed1, $idMed2) : array
{
    $msgErr = array();

    if (!estUnNombre($rapNum) || !getUnRapport($matricule, $rapNum)) {
        $msgErr[] = "Le numéro du rapport est inexistant !";
    }

    if (!empty($idPraticien) && (!estUnNombre($idPraticien) || !getAllInformationsMedecin((int) $idPraticien))) {
        $msgErr[] = "L'identifiant du praticien est inexistant !";
    }

    if (!empty($unRemplacant) && (!estUnNombre($unRemplacant) || !getAllInformationsMedecin((int) $unRemplacant))) {
        $msgErr[] = "L'identifiant du remplacent praticien est inexistant !";
    }

    if (!empty($dateDeSaisie) && !dateValid($dateDeSaisie)) {
        $msgErr[] = "Le format de la date de saisie est incorrecte !";
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

    $msgErr = array_merge($msgErr, checkIdMed($idMed1));
    $msgErr = array_merge($msgErr, checkIdMed($idMed2));

    return $msgErr;
}

/**
 * Permet de vérifier la validiter d'un formulaire de rapport lors de la saisie definitive
 *
 * @param mixed $matricule matricule du collaborateur
 * @param mixed $rapNum un numéro du rapport
 * @param mixed $idPratiecien un identifiant de praticien
 * @param mixed $dateDeSaisie une date
 * @param mixed $bilan un texte de bilan
 * @param mixed $dateDeVisite une date
 * @param mixed $idMotif un identifiant de motif
 * @param mixed $autreMotif un text pour représenter le motif
 * @param mixed $idMed1 le premier un identifiant de médicament
 * @param mixed $idMed2 le premier deuxième identifiant de médicament
 * @return array tableau des erreur avec les champs
 */
function checkFormRapportDef($idPraticien, $dateDeSaisie, $bilan, $dateDeVisite, $idMotif, $autreMotif): array
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

    if (empty($dateDeSaisie)) {
        $msgErr[] = 'Veuillez saisir la date de saisie !';
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