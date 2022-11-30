<?php

if (empty($_REQUEST['action'])) {
	$action = 'mesRapports';
} else {
	$action = $_REQUEST['action'];
}

switch ($action) {
	
	case 'rapportRegion': {
		if ($_SESSION['habilitation'] >= 2) {



		} else {
			include("vues/v_accesInterdit.php");
		}
		break;
	}

	case 'mesRapports': {
		$rapportNonValides = getInfoRapportNonValides($_SESSION['matricule']);
		include('vues/v_formulaireReprise.php');
		break;
	}

	case 'redigerRapport': {
		$rapportNonValides = getInfoRapportNonValides($_SESSION['matricule']);
		if (count($rapportNonValides) <= 0) {
			header('location: index.php?uc=rapport&action=creeRapport');
		} else {
			include('vues/v_formulaireReprise.php');
		}
		break;
	}

	case 'creeRapport': {
		$rapNum = newRapport($_SESSION['matricule']);
		header('location: index.php?uc=rapport&action=saisirRapport&rapNum='.$rapNum);
		break;
	}

	case 'saisirRapport': {
		if (!empty($_REQUEST['rapNum']) && is_numeric($_REQUEST['rapNum'])) {
			$rapport = getUnRapport($_SESSION['matricule'], $_REQUEST['rapNum']);
			if ($rapport) {
				//rapport pas en cours d'edition
				if ($rapport['ETAT_ID'] != 'C') {
					$messageType = 'warning';
					$messageBody = 'Le rapport n°'.htmlspecialchars($_REQUEST['rapNum']).' à déja été saisie de façon définitive !';
					include('vues/v_message.php');
				} else {
					//rapport en cours d'edition
					$lesMeds = getAllNomMedicaments();
					$lesPraticiens = getAllNomMedecins();
					$lesMotifs = getLesMotifs();

					$rapPraID = $rapport['PRA_NUM'];
					if ($rapPraID != PDO::NULL_NATURAL) {
						$unPraticien = getAllInformationsMedecin($rapPraID);
					}
					$idMotif = $rapport['MOT_ID'];
					if ($idMotif != PDO::NULL_NATURAL) {
						$unMotif = getUnMotifById($idMotif);
					}
					$idMed1 = $rapport['MED_PRESENTER_1'];
					if ($idMed1 != PDO::NULL_NATURAL) {
						$preMed = getAllInformationMedicamentDepot($idMed1);
					}
					$idMed2 = $rapport['MED_PRESENTER_2'];
					if ($idMed2 != PDO::NULL_NATURAL) {
						$secMed = getAllInformationMedicamentDepot($idMed2);
					}

					$rapNum = $rapport['RAP_NUM'];
					$colMatricule = $rapport['COL_MATRICULE'];
					$saisieDate = date('Y-m-d', strtotime($rapport['RAP_DATE_SAISIE']));
					$rapBilan = $rapport['RAP_BILAN'];
					$visiteDate = date('Y-m-d', strtotime($rapport['RAP_DATE_VISITE']));
					$motifAutre = $rapport['RAP_MOTIF_AUTRE'];
					include('vues/v_formulaireRapport.php');
				}
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
		$colMatricule = $_SESSION['matricule'];
		$rapNum = $_POST['rapNum'];
		$rapPraID = $_POST['rapPraID'];
		$saisieDate = $_POST['saisieDate'];
		$rapBilan = $_POST['rapBilan'];
		$visiteDate = $_POST['visiteDate'];
		$idMotif = $_POST['idMotif'];
		$motifAutre = $_POST['motifAutre'];
		$idMed1 = $_POST['idMed1'];
		$idMed2 = $_POST['idMed2'];
		$saisieDef = isset($_POST['saisieDef']);

		//check erreur
		$msgErrs = checkFormRapport($colMatricule, $rapNum, $rapPraID, $saisieDate, $rapBilan, $visiteDate, $idMotif, $motifAutre, $idMed1, $idMed2);

		if (count($msgErrs) >= 1) {
			//erreur
			$messageType = 'danger';
			foreach ($msgErrs as $msg) {
				$messageBody = $msg;
				include('vues/v_message.php');
			}

			//rapport en cours d'edition
			$lesMeds = getAllNomMedicaments();
			$lesPraticiens = getAllNomMedecins();
			$lesMotifs = getLesMotifs();
			$unMotif = getUnMotifById($idMotif);

			if (!empty($rapPraID) && estUnNombre($rapPraID)) {
				$unPraticien = getAllInformationsMedecin($rapPraID);
			}
			if (!empty($idMed1)) {
				$preMed = getAllInformationMedicamentDepot($idMed1);
			}
			if (!empty($idMed2)) {
				$secMed = getAllInformationMedicamentDepot($idMed2);
			}

			include('vues/v_formulaireRapport.php');
		} else {
			//saisie bonne
			//saisieDef ? 'V' : 'C'


			//valide
			$messageType = 'info';
			$messageBody = 'Modification du rapport N°'.htmlspecialchars($rapNum).' bien pris en compte !';
			include('vues/v_message.php');
			
			$rapportNonValides = getInfoRapportNonValides($_SESSION['matricule']);
			include('vues/v_formulaireReprise.php');
		}
		break;
	}

	default: {
		header('location: index.php?uc=rapport&action=mesRapports');
		break;
	}
}
?>