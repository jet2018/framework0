<?php
namespace Jet\Framework\Models;

use Jet\Framework\Databases\BaseTable;

class Student extends BaseTable
{
    public $name;
    public $age;
    public $id;

    public  $columns = [
        'name'=>['STRING_FIELD', 'Length' => 120, 'Null'],
        'age'=>['INTEGER_FIELD', 'Length' => 12, 'Null'],
        'id'=>['PRIMARY_KEY_FIELD'],
    ];
}