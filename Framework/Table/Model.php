<?php

namespace Jet\Framework\Table;

use Jet\Framework\Core\CoreDbError;
use Jet\Framework\Core\CoreTable;
use Jet\Framework\Fields\BigIntegerField;
use Jet\Framework\Fields\CharField;
use Jet\Framework\Fields\ColumnsTrait;
use Jet\Framework\Fields\DocumentField;
use Jet\Framework\Fields\FileField;
use Jet\Framework\Fields\ForeignKey;
use Jet\Framework\Fields\ImageField;
use Jet\Framework\Fields\IntegerField;
use Jet\Framework\Fields\JsonField;
use Jet\Framework\Fields\ModalTrait;
use Jet\Framework\Fields\PositiveIntegerField;
use Jet\Framework\Fields\PrimaryKeyField;
use Jet\Framework\Fields\SmallIntegerField;
use Jet\Framework\Fields\TextField;

/**
 * Blue print for a table representation that represents an
 * actual table in the database.
 *
 * @author jet2018 ezrajet9gmail.com
 *
 * @example
 * The following illustrates how to create a table in your models
 * ```php
 * class Student extends Model {
 *      // declare all the columns to be used
 *       public $name;
 *       public $class_name;
 *
 *      // must override this function to define the necessary columns
 *      // this column returns an array as follows
 *       public function meta(){
            return [
 *              'name' => $this->CharField($length=100, $unique=true),  ----> results into varchar(100) null unique
 *              'class_name' => $this->CharField($length=33, $null=false)
 *          ]
 *          }
 *      }
 * ```
 *
 */
abstract class Model extends CoreTable
{
    use ModalTrait;
    use ColumnsTrait;

    public function __construct()
    {
        parent::__construct();
        $this->init();
    }

}
