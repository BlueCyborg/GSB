<?php
if (!isset($_REQUEST['action']) || empty($_REQUEST['action'])) {
    $action = "formulairemedecin";
} else {
    $action = $_REQUEST['action'];
}
echo 'SESSION';
var_dump($_SESSION);
switch ($action) {
    case 'formulairemedecin': {
            if (!isset($_REQUEST['medecin'])) {
                $result = getMedecinRegion($_SESSION['region']);
                include("vues/v_formulaireMedecin.php");
            }
            break;
        }
    case 'gerermedecin': {
            var_dump($_POST);
            break;
        }

    default: {
            header('Location: index.php?uc=medecin&action=formulairemedecin');
            break;
        }
}
