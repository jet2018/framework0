<?php

namespace Jet\Framework\Databases;

use PDOException;

trait Table
{
    function get($key, $value){
        try {
            $sql = "SELECT * FROM `$this->table_name` WHERE $key = ? LIMIT 1";
            $query = $this->connection->prepare($sql);
            $query->execute([$value]);
            echo $query;
        } catch (PDOException $e){
            echo $e->getMessage().PHP_EOL;
        }
    }

    public function getPk(){
        return $this->id;
    }

}