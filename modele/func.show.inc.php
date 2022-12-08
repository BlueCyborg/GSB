<?php

/**
 * Permet d'initialiser les variable neccesaire a l'affichage d'un rapport de visite et de charger la vue en rapport
 *
 * @param array $rapport un rapport de visite
 * @param string $path chemin de la vue a charger pour2 afficher le rapport
 * @param bool $loadList si on doit charger les listes de medecins, motifs et medicaments
 * @return void
 */
function showRapport(array $rapport, string $path, bool $loadList): void
{
    //rapport en cours d'edition
    if ($loadList) {
        $lesMeds = getAllNomMedicaments();
        $lesPraticiens = getAllNomMedecins();
        $lesMotifs = getLesMotifs();
    }
    $idMotif = $rapport['MOT_ID'];
    $unMotif = getUnMotifById($idMotif);
    $lesEchantillions = getLesEchantillions($rapport['COL_MATRICULE'], $rapport['RAP_NUM']);

    //objects
    $rapPraID = $rapport['PRA_NUM'];
    if ($rapPraID != PDO::NULL_NATURAL) {
        $unPraticien = getAllInformationsMedecin($rapPraID);
        $coefConf = $unPraticien['PRA_COEFCONFIANCE'];
    }
    $rapRempID = $rapport['REMP_NUM'];
    if ($rapRempID != PDO::NULL_NATURAL) {
        $unRemplacant = getAllInformationsMedecin($rapRempID);
    }
    $idMed1 = $rapport['MED_PRESENTER_1'];
    if ($idMed1 != PDO::NULL_NATURAL) {
        $preMed = getAllInformationMedicamentDepot($idMed1);
    }
    $idMed2 = $rapport['MED_PRESENTER_2'];
    if ($idMed2 != PDO::NULL_NATURAL) {
        $secMed = getAllInformationMedicamentDepot($idMed2);
    }

    //dates
    $saisieDate = $rapport['RAP_DATE_SAISIE'];
    if ($saisieDate != PDO::NULL_NATURAL) {
        $saisieDate = date('Y-m-d', strtotime($saisieDate));
    } else {
        $saisieDate = '';
    }

    $visiteDate = $rapport['RAP_DATE_VISITE'];
    if ($visiteDate != PDO::NULL_NATURAL) {
        $visiteDate = date('Y-m-d', strtotime($visiteDate));
    } else {
        $visiteDate = '';
    }

    //normal
    $rapNum = $rapport['RAP_NUM'];
    $colMatricule = $rapport['COL_MATRICULE'];
    $rapBilan = $rapport['RAP_BILAN'];
    $motifAutre = $rapport['RAP_MOTIF_AUTRE'];
    include($path);
}

/**
 * Permet d'affciher la liste des erreurs
 *
 * @param array $msgErrs un tabelau contenenant les messages d'erreurs
 * @return void
 */
function showErrors(array $msgErrs) {
    $messageType = 'danger';
	foreach ($msgErrs as $msg) {//pour chaque message
		$messageBody = $msg;
		include('vues/v_message.php');
	}
}