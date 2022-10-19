<?php
if (!isset($_REQUEST['action']) || empty($_REQUEST['action'])) {
    $action = "formulairemedecin";
} else {
    $action = $_REQUEST['action'];
}
switch ($action) {

    case 'formulairemedecin': {
            if (isset($_REQUEST['medecin'])) {
                $med = $_REQUEST['medecin'];
                $carac = getAllInformationsMedecin($med);
                if ($carac) {
                    include("vues/v_formulaireMedecin.php");
                }
            } else {
                $_SESSION['erreur'] = true;
                header("Location: index.php?uc=medecin&action=formulairemedecin");
            }
            break;
        }

    default: {
            header('Location: index.php?uc=medecin&action=formulairemedecin');
            break;
        }
}
