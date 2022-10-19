<?php

include_once 'bd.inc.php';

function getAllNomPraticiens()
{

    try {
        $monPdo = connexionPDO();
        $req = 'SELECT PRA_NUM, PRA_NOM, PRA_PRENOM FROM praticien ORDER BY PRA_NOM';
        $res = $monPdo->query($req);
        $result = $res->fetchAll();
        return $result;
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }
}

function getAllInformationsPraticien(int $prat)
{

    try {
        $monPdo = connexionPDO();
        $req = $monPdo->prepare('SELECT * FROM praticien WHERE PRA_NUM = :prat');
        $req->bindValue(':prat', $prat, PDO::PARAM_INT);
        $req->execute();
        return $req->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }
}

function getNbPraticiens()
{

    try {
        $monPdo = connexionPDO();
        $req = 'SELECT COUNT(PRA_NUM) as \'nb\' FROM praticien';
        $res = $monPdo->query($req);
        $result = $res->fetch();
        return $result;
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }
}
