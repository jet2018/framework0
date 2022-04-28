<?php

namespace Jet\Framework\Core;
use PDO;

abstract class CoreTable extends Connection
{
    private $columns = [];
    private $travel_to = [];
    private $return_to = "";
    private $reference_tables = [];
    private $completed_tables = [];
    /**
     * Returns the column with the column name as the key, with value of
     * another column which shows the column type, category, etc
     * @var array
     */
    private $described_columns = [];

    /**
     * @return array
     */
    public function getReferencetables(): array
    {
        return $this->reference_tables;
    }

    /**
     * @param array $columns
     */
    public function setColumns($columns)
    {
        $this->columns = $columns;
    }

    /**
     * @return array
     */
    public function getColumns(): array
    {
        return $this->columns;
    }

    /**
     * @param string fk
     */
    public function setReferencetables($table)
    {
        $this->reference_tables[] = $table;
    }

    /**
     * @param string $completed_tables
     */
    public function setCompletedTables(string $completed_tables): void
    {
        $this->completed_tables[] = $completed_tables;
    }

    /**
     * @return array
     */
    public function getCompletedTables(): array
    {
        return $this->completed_tables;
    }

    /**
     * @return array
     */
    public function getTravelTo(): array
    {
        return $this->travel_to;
    }

    /**
     * @param string $table
     */
    public function setTravelTo($table)
    {
        $this->travel_to[] = $table;
    }

    /**
     * @return string
     */
    public function getReturnTo()
    {
        return $this->return_to;
    }

    /**
     * @param string $return_to
     */
    public function setReturnTo(array $return_to)
    {
        // each table will always be tasked by one table at a time.
        $this->return_to = $return_to;
    }

    /**
     * @return string
     */
    abstract function getTableName();


    /**
     * @param string $table_name
     */
    abstract function setTableName(string $table_name);


    /**
     * algorithm for taking care of fks.
     *
     * check if table has fks(tables this table is associated to).
     * check if those tables were already created.
     * pop the tables that were completed and add them to completed
     * otherwise create them
     * add them to completed
     * remove them from travel_to
     * if travel_to tables are empty,
     * check if there is return_to, which implies the tables was referred to by another,
     * return to the the referred to table
     * continue until return_to = [], travel_to = [] and reference tables =[]
     * @todo pending logic
     */
    public function HarmonizeRelations(){
        // stopped here
        if (is_array($this->reference_tables)){
            for ($i =0, $i <= count($this->reference_tables) -1; $i++;){
                $table = array_pop($this->reference_tables);
                if ($table){
                    $tb = new $table."()"; // generate the class
                    $tb->setReturnTo($this->getTableName());
                    $tb->build();
                    $this->setCompletedTables($table);
                }

            }
        }
    }

    /**
     * Checks if a table has relations
     * Helper for building relations first
     * @return bool
     */
    public function check_keys(): bool
    {
       return $this->reference_tables !== [];
    }

    /**
     * @todo Makes sure it works
     * @author jet2018
     * Finally the actual building of this table
     * @return void
     */
    public function build()
    {
        if ($this->check_keys()){
            $this->HarmonizeRelations();
        }
    }

    /**
     * @return array
     */
    public function getDescribedColumns(): array
    {
        return $this->described_columns;
    }

    /**
     * @param array $described_columns
     */
    public function setDescribedColumns(array $described_columns): void
    {
        $this->described_columns = $described_columns;
    }


}
