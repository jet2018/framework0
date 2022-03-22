<?php

namespace Jet\Framework\Models;

class Mark extends \Jet\Framework\Databases\BaseTable
{
    private $name;
    private $age;
    private $student;
    private $id;

    public  $columns = [
        'name'=>['STRING_FIELD', 'Length' => 120, 'Null'],
        'age'=>['INTEGER_FIELD', 'Length' => 12, 'Null'],
        'id'=>['PRIMARY_KEY_FIELD'],
        'student' => ['FOREIGNKEY', 'model'=>'Student']
    ];
}