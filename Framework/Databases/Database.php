<?php

namespace Jet\Framework\Databases;


class Database extends Base
{
    public function __construct($database = NULL)
    {
        parent::__construct($database);
        $this->connection = $this->createConnection();
    }

    function createTable($table, $sql){
        echo $table;
        echo $sql;
        $this->connection->exec($sql);
        echo $table." created successfully";
    }


    function runQuery($statement){
        $this->connection->exec($statement);
    }

}