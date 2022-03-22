<?php

namespace Jet\Framework\Databases\Fields;

class Field
{
    public $DATATYPES = [
//        strings
        "STRING_FIELD" => "VARCHAR",
        "BIG_STRING_FIELD" => "TEXT",
        "CHOICE_FIELD" => "ENUM",

//        numbers
        "INTEGER_FIELD" => "INT",
        "POSITIVE_INTEGER_FIELD" => "INT UNSIGNED", # 0 - 4294967295
        "SMALL_INTEGER_FIELD" => "SMALLINT",
        "POSITIVE_SMALL_INTEGER_FIELD" => "SMALLINT UNSIGNED", # 0 - 65535
        "POSITIVE_AUTO_INCREMENT_FIELD" => "BIGINT UNSIGNED AUTO_INCREMENT",
        "BIG_INTEGER_FIELD" => "BIGINT",
        "POSITIVE_BIG_INTEGER_FIELD" => "BIGINT UNSIGNED", # 0-18446744073709551615
        "FLOAT_FIELD" => "FLOAT",

//        special fields
        "PRIMARY_KEY_FIELD" => "BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY NOT NULL",

//        dates
        "DATE_FIELD" => "DATE",
        "DATE_TIME_FIELD" => "DATETIME",
        "TIMESTAMP_AUTO_NOW_FIELD"=>"TIMESTAMP DEFAULT CURRENT_TIMESTAMP",
        "TIMESTAMP_AUTO_ADD_FIELD"=>"TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP",

        "FOREIGNKEY" => "INT"
    ];

    public function __construct($name, $field){
        $this->field = $field;
        $this->name = $name;
    }

    function populateType(){
        return $this->DATATYPES[$this->field[0]];
    }

    function check_length(){
        if($this->field[0] == "STRING_FIELD" && !array_key_exists('Length', $this->field)){
            $this->field['Length'] = 250;
        }

        return $this->field['Length'] ?  $this->field['Length'] : NULL;
    }

    function check_uniqueness(){
        if(array_key_exists("Unique", $this->field)){
            return " UNIQUE ";
        }
    }

    function check_null(){
        if(array_key_exists("Null", $this->field)){
            return " NULL ";
        }
    }

    function check_notnull(){
        if(array_key_exists("NotNull", $this->field)){
            return " NOT NULL ";
        }
    }

//    function create_fk(){
//        return $this->name ." ".$this->populateType();
//    }

    function check_fk(){
        if($this->populateType() == "FOREIGNKEY"){
            # check where it links to
            if(!array_key_exists('model', $this->field)){
                $e =  new Exception("Foreign Key fields must specify the model they refer to. ".$this->table." defines a fk at ".$this.field. " but does not define the model.");
                echo  $e->getMessage();
                return;
            }else{
                if (!array_key_exists("on_delete", $this->field)){
                    $ON_DELETE = "CASCADE";
                }
                else{
                    $ON_DELETE = $this->field['on_delete'];
                }

                if (!array_key_exists("on_update", $this->field)){
                    $ON_UPDATE = "CASCADE";
                }
                else{
                    $ON_UPDATE = $this->field['on_update'];
                }


                return " FOREIGN KEY(".$this->name.") REFERENCES ".$this->field['model']."(id) ON UPDATE ".$ON_UPDATE." ON DELETE ". $ON_DELETE;

            }
        }


    }

    function generate_sql(){
        $sql = $this->name. " ".$this->populateType();
        if($this->check_length()){
            $sql.="(".$this->check_length().") ";
        }
        if ($this->check_uniqueness()){
            $sql.= $this->check_uniqueness();
        }
        $sql.= $this->check_notnull();
        $sql.= $this->check_null().",";
        $sql.= $this->check_fk();

        return $sql;
    }

    public function __destruct()
    {
        echo $this->generate_sql();
    }

}