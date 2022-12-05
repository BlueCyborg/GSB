<?php

/**
 * Permet de crée une connexion à la base de données avec les paramètres situer dans le fichier de configuration
 *
 * @return PDO la connexion à la base de données
 */
function connexionPDO(): PDO
{
    $configFile = 'modele/config.ini';
    if (!file_exists($configFile)) {
        throw new Exception('Le fichier de configuration "config.ini" pour se connecter à la base de données est introuvable ! (Veuiliez le creer)');
    }
    $config = parse_ini_file($configFile);

    try {
        $conn = new PDO('mysql:host='.$config['db_host'].';dbname='.$config['db_name'].';port='.$config['db_port'], $config['db_login'], $config['db_pass'], array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\''));
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conn;
    } catch (PDOException $e) {
        print('Erreur de connexion PDO :');
        print($e);
        die();
    }
}

/**
 * Permet de bind une valeur qui peut être null sur une requet preparé parametré
 *
 * @param PDOStatement $req requet sur laquelle on bind la valeur
 * @param string $name nom du paramètre bind
 * @param mixed $value valeur bind (peut être null)
 * @param integer $type type de valeur si non null
 * @return void
 */
function bindValueCanBeNull(PDOStatement $req, string $name, mixed $value, int $type) {
    if (is_null($value)) {
        $req->bindValue($name, NULL, PDO::PARAM_NULL);
    } else {
        $req->bindValue($name, $value, $type);
    }
}

/**
 * Permet de renvoie la valeur null si une variable est vide ou null
 *
 * @param mixed $value la valeur testé 
 * @return mixed la valeur $value ou null si empty($value) est vrais
 */
function ifEmptyThenNull(mixed $value): mixed
{
    if (empty($value)) {
        $r = NULL;
    } else {
        $r = $value;
    }
    return $r;
}