<?php

namespace Jet\Framework\Databases\Migrators;

use Jet\Framework\Databases\Fields\Field;

class CreateMigrations
{
    public function __construct($tables){
        $this->tables = $tables;
        $this->table_name = [];
    }

    public function getTableNames(){
        $this->table_names = array_keys($this->tables);
        return $this->table_names;
    }

    public function toSQL(){
        foreach ($this->getTableNames() as $table){
            $this->generateTableQuery($table, $this->tables[$table]);
        }
    }


    public function generateTableQuery($table_name, $table_body){
        $field_name = array_keys($table_body);
        $query = "";
        foreach($field_name as $field){
            $generator = new Field($name =$field, $table_body[$field]);
//            $query.= .",";
        }

        return $query;

    }

    public function __destruct()
    {
        // TODO: Implement __destruct() method.
        $this->toSQL();
    }

}