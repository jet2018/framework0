<?php

namespace Jet\Framework\Query;

use PDO;
use PDOStatement;

trait QueryBuilder
{


    public function builder($params = [])
    {
        $this->connection->beginTransaction();

        $q = $this->connection->connection()->prepare($this->query);
        foreach ($params as $param) {
            $q->bindParam($param);
        }
        $q->execute();
        return $q;
    }


    public function execute($args = [])
    {
        $this->connection->connection()->beginTransaction();
        try {
            $query = $this->connection->connection()->query($this->query);
            $result = $query->fetchAll();
            if ($this->connection->connection()->inTransaction()) {
                $this->connection->connection()->rollBack();
            }
            return $result;

        } catch (\PDOException $e) {
            if ($this->connection->connection()->inTransaction()) {
                $this->connection->connection()->rollBack();
            }
            return $e;
        }
    }


    public function build_table($table_name)
    {
        try {
            $q = $this->connection->connection()->prepare("DESCRIBE $table_name");
            print("Table already exists");
            return $q->execute();
        } catch (\Exception $e) {
            /**
             * Table does not exist, create it
             */
            return $this->execute($this->query);
        }
    }

    public function boundQuery($sql, $params)
    {

        // $params should be of the format associative array
        $stmt = $this->connection->connection()->prepare($sql);
        $result = $stmt->execute($params);
        return $result;
    }

    public function QueryAndReturnObj($table_name, $sql, $params)
    {
        $this->connection->beginTransaction();
        // perform insert
        $result = $this->boundQuery($sql, $params);
        // get the inserted object
        $id = $this->connection->connection()->lastInsertId();
        //return the object inserted
        $as_pdo= $this->boundQuery("SELECT * FROM $table_name", ['id' => $id] );
        $this->connection->commit();
        $table = new $table_name;
        return $as_pdo->fetchObject($table_name, $table_name->column_names);
    }

    /**
     * Perform an sql query to the database without params
     * @example "SELECT * FROM POSTS LIMIT 1"
     * @param $sql
     * @return false|PDOStatement
     */
    public function unboundQuery($sql)
    {
        return $this->connection->connection()->query($sql);
    }

    // this part below not implemented yet


    public function loadToClassObj()
    {
        return $this;
    }

    public function get()
    {
        return $this;
    }

    public function filter()
    {
        return $this;
    }

    public function all()
    {
        return $this;
    }

    public function paginate()
    {
        return $this;
    }

    public function delete()
    {
        return $this;
    }

    public function deleteAll()
    {
        return $this;
    }

    public function save()
    {
        return $this;
    }

    public function get_or_create()
    {
        return $this;
    }

    public function update()
    {
        return $this;
    }


}
