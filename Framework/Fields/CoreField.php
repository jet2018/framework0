<?php

namespace Jet\Framework\Fields;

use Jet\Framework\Core\CoreDbError;

/**
 * @example
 *Final result of the table should be
 *class Student extends Model{
 *      public $columns = [
 *          'first_name' => $this->CharField($unique = true, $null=false, $length = 200) //--> varchar(200) unique not null
 *          'salary' => $this->BigIntegerField($unique=true, $null=false)
 *      ]
 * }
 */
class CoreField
{
    private $type ="";
    private $category = "";
    private $length = null;
    private $field = "";
    private $is_null = false;
    private $is_unique = false;
    private $is_pk = false;
    private $auto_increment = false;
    private $default = null;
    private $signed = false;

    //about creating fks
    private $is_fk = false;
    private $model_referenced = null;
    private $column_referenced = 'id';
    private $on_delete = null;
    private $on_update = null;

    public function getType()
    {
        return $this->type;
    }
    public function setType($type)
    {
        $this->type = $type;
    }

    public function getCategory()
    {
        return $this->category;
    }
    public function setCategory($category)
    {
        $this->category = $category;
    }


    public function setLength($length=0)
    {
        $this->length = $length;
    }

    public function getLength()
    {
        return $this->length;
    }

    public function setNull($null)
    {
        $this->is_null = $null;
    }

    public function getNull()
    {
        return $this->is_null;
    }

    public function setUnique($unique)
    {
        $this->is_unique = $unique;
    }

    public function getUnique()
    {
        return $this->is_unique;
    }

    public function setPk($pk)
    {
        $this->is_pk = $pk;
    }

    public function getPk()
    {
        return $this->is_pk;
    }

    /**
     * @param $auto_increment
     */
    public function setAutoIncrement($auto_increment): void
    {
        $this->auto_increment = $auto_increment;
    }

    /**
     * @return bool
     */
    public function getAutoIncrement(): bool
    {
        return $this->auto_increment;
    }

    /**
     * @return bool
     */
    public function isIsFk(): bool
    {
        return $this->is_fk;
    }

    /**
     * @param bool $is_fk
     */
    public function setIsFk($is_fk): void
    {
        $this->is_fk = $is_fk;
    }

    /**
     * @return null
     */
    public function getModelReferenced()
    {
        return $this->model_referenced;
    }

    /**
     * @param null $model_refrenced
     */
    public function setModelReferenced($model_referenced): void
    {
        $this->model_referenced = $model_referenced;
    }

    /**
     * @return null
     */
    public function getColumnReferenced()
    {
        return $this->column_referenced;
    }

    /**
     * @param null $column_referenced
     */
    public function setColumnReferenced($column_referenced): void
    {
        $this->column_referenced = $column_referenced;
    }

    /**
     * @return null
     */
    public function getOnDelete()
    {
        return $this->on_delete;
    }

    /**
     * @param null $on_delete
     */
    public function setOnDelete($on_delete): void
    {
        $this->on_delete = $on_delete;
    }

    /**
     * @return null
     */
    public function getOnUpdate()
    {
        return $this->on_update;
    }

    /**
     * @param null $on_update
     */
    public function setOnUpdate($on_update): void
    {
        $this->on_update = $on_update;
    }

    /**
     * @throws CoreDbError
     */
    public function fieldStub()
    {
        $field = $this->getType();

        // set the field length
        if ($this->getLength()){
            $field .= "(".$this->getLength().")";
        }

        // set auto increment
        if ($this->getPk()){
            $field .= " PRIMARY KEY ";
        }


        //set uniqueness
        if ($this->getUnique()){
            $field .= " UNIQUE ";
        }

        // set auto increment
        if ($this->getAutoIncrement()){
            $field .= " AUTO INCREMENT ";
        }

        // set auto increment
        if ($this->getDefault()){
            $field .= " DEFAULT ".$this->getDefault();
        }

        //set null
        if ($this->getNull()){
            $field .= " NULL ";
        }else{
            $field .= " NOT NULL ";
        }

        if ($this->isSigned()){
            if ($this->category !== 'integer'){
                throw new CoreDbError("Field cannot be declared unsigned as it is not an integer family");
                return;
            }
            else{
                // field allows only positives, great for positive fields family
                $field.= " unsigned";
            }
        }

        return $this->field = $field;

    }


    /**
     * @return null
     */
    public function getDefault()
    {
        return $this->default;
    }

    /**
     * @param null $default
     */
    public function setDefault($default): void
    {
        $this->default = $default;
    }


    /**
     * Helps to add custom parts of the table body
     * May become handy to define primary keys, foreign keys.
     *
     * @param $body
     * @return void
     *
     */
    public function addStub($body)
    {
        $field = $this->fieldStub();
        $field.= ", ".$body;
        $this->field = $field;
    }

//
//    /**
//     * @return mixed
//     * Get the submitted field body, check for certain fields
//     */
//    public function init()
//    {
//        return $this->fieldStub();
//    }
    /**
     * @return bool
     */
    public function isSigned(): bool
    {
        return $this->signed;
    }

    /**
     * @param bool $signed
     */
    public function setSigned(bool $signed): void
    {
        $this->signed = $signed;
    }


}

//result
//create table course
//(
//    id        int auto_increment,
//    name      varchar(10) null,
//    course_id int         null,
//    constraint course_pk
//        primary key (id),
//    constraint course_students_id_fk
//        foreign key (course_id) references students (id)
//);
//
//create unique index course_id_uindex
//    on course (id);


//create table table_name
//(
//    id   int auto_increment
//        primary key,
//    name varchar(20) default 'jet' null,
//    constraint table_name_id_uindex
//        unique (id)
//);


