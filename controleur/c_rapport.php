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
					$messageBody = 'Le rapport n°'.$_REQUEST['rapNum'].' à déja été saisie de façon définitive !';
					include('vues/v_message.php');
				} else {
					showRapport($rapport, 'vues/v_formulaireRapport.php', true);
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
		if (isset($_SESSION['matricule']) 
			&& isset($_POST['rapNum'])
			&& isset($_POST['rapPraID'])
			&& isset($_POST['rapRempID'])
			&& isset($_POST['saisieDate'])
			&& isset($_POST['rapBilan'])
			&& isset($_POST['visiteDate'])
			&& isset($_POST['idMotif'])
			&& isset($_POST['motifAutre'])
			&& isset($_POST['idMed1'])
			&& isset($_POST['idMed2'])
		) {
			$colMatricule = $_SESSION['matricule'];
			$rapNum = $_POST['rapNum'];
			$rapPraID = $_POST['rapPraID'];
			$rapRempID = $_POST['rapRempID'];
			$saisieDate = $_POST['saisieDate'];
			$rapBilan = $_POST['rapBilan'];
			$visiteDate = $_POST['visiteDate'];
			$idMotif = $_POST['idMotif'];
			$motifAutre = $_POST['motifAutre'];
			$idMed1 = $_POST['idMed1'];
			$idMed2 = $_POST['idMed2'];
			$saisieDef = isset($_POST['saisieDef']);
			$lesEchantillions = isset($_POST['echs']) ? $_POST['echs'] : array();
			
			//check erreur
			$msgErrs = array_merge(
					checkFormRapport($colMatricule, $rapNum, $rapPraID, $rapRempID, $saisieDate, $rapBilan, $visiteDate, $idMotif, $motifAutre, $idMed1, $idMed2),
					checkFormRapportEchs($lesEchantillions)
				);
			if ($saisieDef) {
				$msgErrs = array_merge($msgErrs, checkFormRapportDef($rapPraID, $saisieDate, $rapBilan, $visiteDate, $idMotif, $motifAutre));
			}

			//page d'erreur
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
				if (!empty($rapRempID) && estUnNombre($rapRempID)) {
					$unRemplacant = getAllInformationsMedecin($rapRempID);
				}
				if (!empty($idMed1)) {
					$preMed = getAllInformationMedicamentDepot($idMed1);
				}
				if (!empty($idMed2)) {
					$secMed = getAllInformationMedicamentDepot($idMed2);
				}

				//pour eviter des bug sur la vue
				if (!is_array($lesEchantillions)) {
					$lesEchantillions = array();
				}

				include('vues/v_formulaireRapport.php');
			} else {//page de mise à jour
				$valid = true;
				//saisie bonne
				if (!$saisieDef) {
					$valid = updateUnRapport($colMatricule,
							$rapNum,
							ifEmptyThenNull($rapPraID),
							ifEmptyThenNull($visiteDate),
							$rapBilan,
							$motifAutre,
							ifEmptyThenNull($rapRempID),
							$idMotif,
							'C',
							ifEmptyThenNull($saisieDate),
							ifEmptyThenNull($idMed1),
							ifEmptyThenNull($idMed2)
						);
					updateLesEchantillions($colMatricule, $rapNum, $lesEchantillions);
				} else {
					$valid = updateUnRapport($colMatricule,
							$rapNum,
							ifEmptyThenNull($rapPraID),
							ifEmptyThenNull($visiteDate),
							$rapBilan,
							$motifAutre,
							ifEmptyThenNull($rapRempID),
							$idMotif,
							'V',
							ifEmptyThenNull($saisieDate),
							ifEmptyThenNull($idMed1),
							ifEmptyThenNull($idMed2)
						);
					updateLesEchantillions($colMatricule, $rapNum, $lesEchantillions);
				}

				if ($valid) {
					//valide
					$messageType = 'info';
					if ($saisieDef) {
						$messageBody = 'Enregistrement définitif du rapport N°'.$rapNum.' a bien pris en compte !';
					} else {
						$messageBody = 'La modification du rapport N°'.$rapNum.' a bien pris en compte !';
					}
				} else {
					//non valide
					$messageType = 'warning';
					$messageBody = 'La modification du rapport N°'.$rapNum.' a rencontré un problème !';
				}
				include('vues/v_message.php');

				//liste
				$rapportNonValides = getInfoRapportNonValides($_SESSION['matricule']);
				include('vues/v_formulaireReprise.php');
			}
		} else {
			$messageType = 'danger';
			$messageBody = 'Le formulaire pour saisir le rapport est mal constitué !';
			include('vues/v_message.php');

			//liste
			$rapportNonValides = getInfoRapportNonValides($_SESSION['matricule']);
			include('vues/v_formulaireReprise.php');
		}
		break;
	}

	case 'regarderRapport': {
		if (!empty($_REQUEST['rapNum']) && is_numeric($_REQUEST['rapNum'])) {
			$rapport = getUnRapport($_SESSION['matricule'], $_REQUEST['rapNum']);
			if ($rapport) {
				//rapport pas en cours d'edition
				if ($rapport['ETAT_ID'] == 'C') {
					$messageType = 'warning';
					$messageBody = 'Le rapport n°'.$_REQUEST['rapNum'].' est en cours saisie !';
					include('vues/v_message.php');
				} else {
					showRapport($rapport, 'vues/v_detailRapport.php', false);
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

	default: {
		header('location: index.php?uc=rapport&action=mesRapports');
		break;
	}
}
?>