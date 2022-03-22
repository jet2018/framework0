<?php

namespace Jet\Framework\Databases;
use PDO;

class CreateDB
{

    /**
     * @var mixed
     */
    private $config;


    public function __construct($database = NULL){
        $this->config  = $GLOBALS['DATABASES']['default'];
        $this->database = $database ? $database : $this->config['database'];
    }

    public function checkDBS()
    {
        try {
            $dsn = new PDO($this->config['engine'] . ":host=" . $this->config['server'] . ";port=" .$this->config['port'], $this->config['user'], $this->config['password'], $this->config['options']);
            $dsn->exec('CREATE DATABASE IF NOT EXISTS '.$this->database);
           echo PHP_EOL;
            echo "DATABASE ".$this->database." created successfully";
            echo PHP_EOL;
        } catch (\PDOException $e){
            echo $e;
        }
    }

    public function __destruct()
    {
        $this->checkDBS();
    }


}