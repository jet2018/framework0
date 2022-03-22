<?php

namespace Jet\Framework\Databases\Migrators;

class Sanctur
{
    public function __construct($tables)
    {
        $this->tables = $tables;
    }

    function getCreatedTables(){
        $sql_tables = array();
        foreach ($this->tables as $table){
            $class = 'Jet\Framework\Models\\'.$table;
            # instantiate the class
            $instance = new $class();
            # get the columns in a table
            $sql_tables[$table] = $instance->columns;
        }
        return $sql_tables;
    }

    function __destruct()
    {
        new CreateMigrations($this->getCreatedTables());
    }

}