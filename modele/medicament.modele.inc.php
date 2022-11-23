<?php

include_once 'bd.inc.php';

    function getAllNomMedicaments(){

        try{
            $monPdo = connexionPDO();
            $req = 'SELECT MED_DEPOTLEGAL, MED_NOMCOMMERCIAL FROM medicament ORDER BY MED_NOMCOMMERCIAL';
            $res = $monPdo->query($req);
            $result = $res->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        } 

        catch (PDOException $e){
            print "Erreur !: " . $e->getMessage();
            die();
        }

    }

    function getAllInformationMedicamentDepot($depot){

        try{
            $monPdo = connexionPDO();
            $req = connexionPDO()->prepare('SELECT m.MED_DEPOTLEGAL as \'depotlegal\', m.MED_NOMCOMMERCIAL as \'nomcom\', m.MED_COMPOSITION as \'compo\', m.MED_EFFETS as \'effet\', m.MED_CONTREINDIC as \'contreindic\', m.MED_PRIXECHANTILLON as \'prixechan\', f.FAM_LIBELLE as \'famille\' FROM medicament m INNER JOIN famille f ON f.FAM_CODE = m.FAM_CODE WHERE MED_DEPOTLEGAL = :depot');
            $req->bindValue(':depot', $depot);
            $result = $req->fetch(PDO::FETCH_ASSOC);    
            return $result;
        } 
    
        catch (PDOException $e){
            print "Erreur !: " . $e->getMessage();
            die();
        }
    }

    function getAllInformationMedicamentNom($nom){

        try{
            $req = connexionPDO()->prepare('SELECT m.MED_DEPOTLEGAL as \'depotlegal\', m.MED_NOMCOMMERCIAL as \'nomcom\', m.MED_COMPOSITION as \'compo\', m.MED_EFFETS as \'effet\', m.MED_CONTREINDIC as \'contreindic\', m.MED_PRIXECHANTILLON as \'prixechan\', f.FAM_LIBELLE as \'famille\' FROM medicament m INNER JOIN famille f ON f.FAM_CODE = m.FAM_CODE WHERE MED_NOMCOMMERCIAL = :nom');
            $req->bindValue(':nom', $nom);
            $result = $req->fetch(PDO::FETCH_ASSOC);    
            return $result;
        } 
    
        catch (PDOException $e){
            print "Erreur !: " . $e->getMessage();
            die();
        }
    }

    function getDepotMedoc($nom){

        try{
            $req = connexionPDO()->prepare('SELECT MED_DEPOTLEGAL, MED_NOMCOMMERCIAL FROM medicament WHERE MED_DEPOTLEGAL = :nom');
            $req->bindValue(':nom', $nom);
            $result = $req->fetch(PDO::FETCH_ASSOC);    
            return $result;
        } 
    
        catch (PDOException $e){
            print "Erreur !: " . $e->getMessage();
            die();
        }
    }
    
    function getNbMedicament(){

        try{
            $monPdo = connexionPDO();
            $req = 'SELECT COUNT(MED_DEPOTLEGAL) as \'nb\' FROM medicament';
            $res = $monPdo->query($req);
            $result = $res->fetch(PDO::FETCH_ASSOC);    
            return $result;
        } 
    
        catch (PDOException $e){
            print "Erreur !: " . $e->getMessage();
            die();
        }
    }

?>