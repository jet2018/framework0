<?php

namespace Jet\Framework\Fields;

use Jet\Framework\Core\CoreDbError;

trait ModalTrait
{
    // generating table sql
    /**
     * @throws CoreDbError
     */

    private $hasPk = false;
    private $table_name="";
    public $id;

    /**
     * @return bool
     */
    public function getHasPk(): bool
    {
        return $this->hasPk;
    }

    /**
     * @param bool $hasPk
     */
    public function setHasPk(bool $hasPk): bool
    {
        return $this->hasPk = $hasPk;
    }

    public function column_names(): array
    {
        return array_keys($this->getColumns());
    }


    /**
     * @return array $columns
     */
    abstract function meta();


    public function setTableName(string $table_name)
    {
        $this->table_name = $table_name ? $table_name : get_called_class();
    }

    public function getTableName()
    {
        return $this->table_name ? $this->table_name : get_called_class();
    }


    public function init()
    {
        // sets up columns smoothly to be accessed from the table itself
        $columns = [];
        foreach ($this->meta() as $item=>$value){
            $columns[$item] = $value->fieldStub();
        }
        $this->setColumns($columns);
    }

}
