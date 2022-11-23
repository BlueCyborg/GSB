<?php
if (!isset($_REQUEST['action']) || empty($_REQUEST['action'])) {
    $action = "formulairemedecin";
} else {
    $action = $_REQUEST['action'];
}
if ($_SESSION['habilitation'] == 2) { // Si l'utilisateur possède les droits nécécessaires
    switch ($action) {
        case 'formulairemedecin': {
                if (!isset($_REQUEST['medecin'])) {
                    $result = getMedecinRegion($_SESSION['region']);
                    include("vues/v_formulaireMedecin.php");
                }
                break;
            }
        case 'gerermedecin': {
                if (isset($_POST['formulaire_medecin'])) { //Si le délégué visiteur à changé les valeurs d'un médecin
                    echo 'test';
                } else {
                    if (isset($_REQUEST['medecin'])) {
                        $medecin = getAllInformationsMedecin($_REQUEST['medecin']);
                        include("vues/v_gererMedecin.php");
                        break;
                    }
                }
            }
    }
} else {
    header('Location: index.php?uc=accueil');
}
