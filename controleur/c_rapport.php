<?php

if (empty($_REQUEST['action'])) {
	$action = 'visRapports';
} else {
	$action = $_REQUEST['action'];
}

switch ($action) {
	
	case 'visRapports': {
		$rapportNonValides = getIdRapportNonValides($_SESSION['matricule']);
		include('vues/v_formulaireReprise.php');
		break;
	}

	case 'creeRapport': {
		$rapNum = newRapport($_SESSION['matricule']);
		header('location: index.php?uc=rapport&action=saisirRapport&rapNum='.$rapNum);
		break;
	}

	case 'saisirRapport': {
		if (!empty($_REQUEST['rapNum']) && is_numeric($_REQUEST['rapNum'])) {
			$rapport = getRapport($_SESSION['matricule'], $_REQUEST['rapNum']);
			if ($rapport) {
				$lesMede = getAllNomMedicaments();
				$lesPraticiens = getAllNomMedecins();
				$lesMotif = getLesMotifs();

				$rapNum = $rapport['RAP_NUM'];
				$colMatricule = $rapport['COL_MATRICULE'];
				$rapPraID = getAllInformationsMedecin($rapport['PRA_NUM']);
				$saisieDate = date('Y-m-d', strtotime($rapport['RAP_DATE_SAISIE']));
				$rapBilan = $rapport['RAP_BILAN'];
				$visiteDate = date('Y-m-d', strtotime($rapport['RAP_DATE_VISITE']));
				$unMotif = getUnMotifById($rapport['MOT_ID']);
				$motifAutre = $rapport['RAP_MOTIF_AUTRE'];
				$preMed = getAllInformationMedicamentDepot($rapport['MED_PRESENTER_1']);
				$secMed = getAllInformationMedicamentDepot($rapport['MED_PRESENTER_2']);
				include('vues/v_formulaireRapport.php');
			} else {
				$messageType = 'danger';
				$messageBody = 'Numéro de rapport introuvable pour votre matricule !';
				include('vues/v_message.php');
			}
		} else {
			$messageType = 'danger';
			$messageBody = 'Numéro de rapport invalide (le numéro de rapport doit être un nombre) !';
			include('vues/v_message.php');
		}
		break;
	}

	case 'saisitRapport': {
		var_dump($_POST);
		//include('vues/v_formulaireRapport.php');
		break;
	}

	default: {
		header('location: index.php?uc=rapport&action=visRapports');
		break;
	}
}
?>