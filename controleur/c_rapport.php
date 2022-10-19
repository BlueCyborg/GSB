<?php
require_once 'modele/rapport.modele.inc.php';

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

	case 'saisir': {
		
		include('vues/v_formulaireRapport.php');
		break;
	}

	case 'saisit': {
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