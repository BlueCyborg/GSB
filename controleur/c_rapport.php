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
					//rapport en cours d'edition
					$lesMeds = getAllNomMedicaments();
					$lesPraticiens = getAllNomMedecins();
					$lesMotifs = getLesMotifs();
					$idMotif = $rapport['MOT_ID'];
					$unMotif = getUnMotifById($idMotif);

					//objects
					$rapPraID = $rapport['PRA_NUM'];
					if ($rapPraID != PDO::NULL_NATURAL) {
						$unPraticien = getAllInformationsMedecin($rapPraID);
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

			//check erreur
			$msgErrs = checkFormRapport($colMatricule, $rapNum, $rapPraID, $rapRempID, $saisieDate, $rapBilan, $visiteDate, $idMotif, $motifAutre, $idMed1, $idMed2);
			if ($saisieDef) {
				$msgErrs = array_merge($msgErrs, checkFormRapportDef($rapPraID, $saisieDate, $rapBilan, $visiteDate, $idMotif, $motifAutre));
			}

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

				include('vues/v_formulaireRapport.php');
			} else {
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

	default: {
		header('location: index.php?uc=rapport&action=mesRapports');
		break;
	}
}
?>