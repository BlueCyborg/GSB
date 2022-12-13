<?php

if (empty($_REQUEST['action'])) {
	$action = 'mesRapports';
} else {
	$action = $_REQUEST['action'];
}

switch ($action) {
	
	case 'newRapportRegion': {
		if ($_SESSION['habilitation'] >= 2) {
			//recherche
			$rapports = getNewRapportRegions($_SESSION['matricule']);
			$nbRapports = count($rapports);
	
			//affichage des resulats
			if ($nbRapports <= 0) {
				$messageType = 'secondary';
				$messageBody = 'Il y a aucun nouveau rapport de visite ! ';
				include('vues/v_message.php');
			} else {
				$actionCheck= 'consulterRapport';
				$titrePage = 'Nouveaux rapports de visite de la région';
				$descPage = ($nbRapports == 1) ? 'Un seul nouveau rapport de visite !' : 'Liste des ' . $nbRapports . ' nouveaux rapports de visites !';
				$showCol = true;
				include('vues/v_listeRapports.php');
			}
		} else {
			include("vues/v_accesInterdit.php");
		}
		break;
	}

	case 'historyRapportRegion': {
		if ($_SESSION['habilitation'] >= 2) {
			//j'ai choissie la method=get pour le formulaire car cela permet de faire "précédante page" sans erreur 
			//et parsceque aucune information sensible n'est presente dans l'url
			$startDate = isset($_GET['startDate']) ? $_GET['startDate'] : '';
			$endDate = isset($_GET['endDate']) ? $_GET['endDate'] : '';
			$colMat = isset($_GET['colMat']) ? $_GET['colMat'] : null;

			//validation du fomulaire
			$msgErrs = checkFormulaireRechercheHistoryRapportRegion($startDate, $endDate, $colMat, $_SESSION['matricule']);
			$error = count($msgErrs) >= 1;
			$rapports = array();

			if ($error) {
				showErrors($msgErrs);
			} else {
				//recherche
				$rapports = [];//getSesRapports($_SESSION['matricule'], $startDate, $endDate, $praID);
			}

			//parametre pour la vue
			$nbRapports = count($rapports);
			$lesVisiteurs = getNomCollaborateursMemeRegion($_SESSION['matricule']);

			if (!empty($colMat)) {
				$unVisiteur = getNomCollaborateur($colMat);
			}

			//affichage du formulaire
			include('vues/v_formulaireHisRapport.php');

			//affichage des resulats
			if ($nbRapports <= 0) {
				$messageType = 'secondary';
				$messageBody = 'Aucun rapport de visite a été trouvé pour ces critères de recherche !';
				include('vues/v_message.php');
			} else {
				$actionCheck= 'regarderRapport';
				$titrePage = '';
				$descPage = ($nbRapports == 1) ? 'Un seul rapport de visite trouvé !' : 'Liste des ' . $nbRapports . ' rapports de visites trouvés !';
				$showCol = true;
				include('vues/v_listeRapports.php');
			}
		} else {
			include("vues/v_accesInterdit.php");
		}
		break;
	}

	case 'consulterRapport': {
		if ($_SESSION['habilitation'] >= 2) {
			if (!empty($_REQUEST['rapNum']) && !empty($_REQUEST['colMat']) && is_numeric($_REQUEST['rapNum'])) {
				$rapport = getUnRapport($_REQUEST['colMat'], $_REQUEST['rapNum']);
				if ($rapport) {
					//rapport non valider
					if ($rapport['ETAT_ID'] == 'C') {
						$messageType = 'warning';
						$messageBody = 'Le rapport n°'.$_REQUEST['rapNum'].' n\'est pas validé !';
						include('vues/v_message.php');
					} else {
						if ($rapport['ETAT_ID'] == 'V') {//mise ajour vers consulter
							updateUnRapportEtat($_REQUEST['colMat'], $_REQUEST['rapNum'], 'D');
						}
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
		} else {
			include("vues/v_accesInterdit.php");
		}
		break;
	}

	case 'mesRapports': {
		//test formulaire
		//j'ai choissie la method=get pour le formulaire car cela permet de faire "précédante page" sans erreur 
		//et parsceque aucune information sensible n'est presente dans l'url
		$startDate = isset($_GET['startDate']) ? $_GET['startDate'] : '';
		$endDate = isset($_GET['endDate']) ? $_GET['endDate'] : '';
		$praID = isset($_GET['praID']) ? $_GET['praID'] : null;

		//validation du fomulaire
		$msgErrs = checkFormulaireRechercheMesRapport($startDate, $endDate, $praID);
		$error = count($msgErrs) >= 1;
		$rapports = array();

		if ($error) {
			showErrors($msgErrs);
		} else {
			//recherche
			$rapports = getSesRapports($_SESSION['matricule'], $startDate, $endDate, $praID);
		}

		//parametre pour la vue
		$nbRapports = count($rapports);
		$lesPraticiens = getAllNomMedecins();

		if (!empty($praID) && estUnNombre($praID)) {
			$unPraticien = getAllInformationsMedecin($praID);
		}

		//affichage du formulaire
		include('vues/v_formulaireMesRapport.php');

		//affichage des resulats
		if ($nbRapports <= 0) {
			$messageType = 'secondary';
			$messageBody = 'Aucun rapport de visite a été trouvé pour ces critères de recherche !';
			include('vues/v_message.php');
		} else {
			$actionCheck= 'regarderRapport';
			$titrePage = '';
            $descPage = ($nbRapports == 1) ? 'Un seul rapport de visite trouvé !' : 'Liste des ' . $nbRapports . ' rapports de visites trouvés !';
			$showCol = false;
			include('vues/v_listeRapports.php');
		}
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
			&& isset($_POST['coefConf'])
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
			$coefConf = $_POST['coefConf'];
			$rapRempID = $_POST['rapRempID'];
			$saisieDate = $_POST['saisieDate'];//juste pour ne pas faire de n,ouvelle apelle a bd
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
					checkFormRapport($colMatricule, $rapNum, $rapPraID, $rapRempID, $rapBilan, $visiteDate, $idMotif, $motifAutre, $idMed1, $idMed2, $coefConf),
					checkFormRapportEchs($lesEchantillions)
				);
			if ($saisieDef) {
				$msgErrs = array_merge($msgErrs, checkFormRapportDef($rapPraID, $rapBilan, $visiteDate, $idMotif, $motifAutre));
			}

			//information sur le praticien
			if (!empty($rapPraID) && estUnNombre($rapPraID)) {
				$unPraticien = getAllInformationsMedecin($rapPraID);
			}

			//page d'erreur
			if (count($msgErrs) >= 1) {
				//erreur
				showErrors($msgErrs);

				//rapport en cours d'edition
				$lesMeds = getAllNomMedicaments();
				$lesPraticiens = getAllNomMedecins();
				$lesMotifs = getLesMotifs();
				$unMotif = getUnMotifById($idMotif);

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

				//mise a jour coef confiancie du medecin
				if (!empty($unPraticien)) {
					updateCoefConfMedecin($rapPraID, $coefConf);
					$messageType = 'success';
					$messageBody = 'Le coefficien de confiance du medecin "'.$unPraticien['PRA_NOM'].' '.$unPraticien['PRA_PRENOM'].'" à bien été redefinie à '.$coefConf.' !';
					include('vues/v_message.php');
				}

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