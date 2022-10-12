<?php

include_once 'bd.inc.php';

    function getAllNomPraticiens(){

        try{
            $monPdo = connexionPDO();
            $req = 'SELECT PRA_NUM, PRA_NOM, PRA_PRENOM FROM praticien ORDER BY PRA_NOM';
            $res = $monPdo->query($req);
            $result = $res->fetchAll();
            return $result;
        } 

        catch (PDOException $e){
            print "Erreur !: " . $e->getMessage();
            die();
        }

    }

    function getAllInformationPraticiens(){

        try{
            $monPdo = connexionPDO();
            $req = 'SELECT * FROM praticien';
            $res = $monPdo->query($req);
            $result = $res->fetch();    
            return $result;
        } 
    
        catch (PDOException $e){
            print "Erreur !: " . $e->getMessage();
            die();
        }
    }
    
    function getNbPraticiens(){

        try{
            $monPdo = connexionPDO();
            $req = 'SELECT COUNT(PRA_NUM) as \'nb\' FROM praticien';
            $res = $monPdo->query($req);
            $result = $res->fetch();    
            return $result;
        } 
    
        catch (PDOException $e){
            print "Erreur !: " . $e->getMessage();
            die();
        }
    }

?>