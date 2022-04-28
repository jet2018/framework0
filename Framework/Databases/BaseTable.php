<?php

namespace Jet\Framework\Databases;

class BaseTable extends Database
{

    # column structure of the table
    public $columns;
    # the table name
    public $table_name;

    use Table;
    function setColumns($columns)
    {
        $this->columns = $columns;
        return $this;
    }

    function setTableName($table = NULL): BaseTable
    {
        $this->table_name = $table ? $table : self::class;
        return $this;
    }

    function dropTable()
    {
        $sql = "DROP TABLE IF EXISTS " . $this->table_name;
        $this->runQuery($sql);
        echo "Table " . $this->table_name . " dropped successfully";
        return $this;
    }
}