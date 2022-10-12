<?php

session_start();

function connexionPDO()
{
    require('modele/config.inc.php');

    try {
        $conn = new PDO("mysql:host=$configBdIp;port=3307;dbname=$configBdName", $configBdLogin, $configBdMdp, array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\''));
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conn;
    } catch (PDOException $e) {
        print("Erreur de connexion PDO :");
        print($e);
        die();
    }
}
