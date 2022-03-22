<?php

namespace Jet\Framework\Databases;

use PDO;
use PDOException;

class Base
{

    /**
     * @var mixed
     */
    private $config;
    /**
     * @var mixed
     */
    private $database;

    public function __construct($database=NULL){
        $this->config  = $GLOBALS['DATABASES']['default'];
        $this->database = $database ? $database : $this->config['database'];
    }

    public function createConnection(){
        try {
            # create a connection
            $dsn = $this->config['engine'].':host='.$this->config['server'].';dbname='.$this->config['database'].';port='.$this->config['port'].";charset=UTF8";
            # so far for mysql
            $driver_options = array(
                PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'",
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            );

            $options = array_merge($this->config['options'], $driver_options);
            $conn = new PDO($dsn, $this->config['user'], $this->config['password'], $options);
            $conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
            echo $this->config['database'] ? "Connected to ". $this->config['database']. " database \n" : "Database not set up yet \n";
            return $conn;
        } catch (\PDOException $e){
            echo $e->getPrevious().PHP_EOL;
            return $e;
        }
    }
}