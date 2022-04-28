<?php

use Jet\Framework\Table\Model;
use JetBrains\PhpStorm\ArrayShape;

require 'vendor/autoload.php';

// DATABASE CONFIGURATIONS
const  DATABASE = [
    'username' => 'root',
    'database' => 'jet',
    'password' => 'peacebewithyouall2020',
    'server' => 'localhost',
    'driver' => 'mysql',
    'port' => '3306',
    'options' => []
];

$GLOBALS['DATABASE'] = DATABASE;


//$q = new \Jet\Framework\Core\Query("Create table students", $config);
//$q->add("(id int not null auto_increment unique, first_name varchar(13),  last_name varchar(12))");
//print_r($q->build_table('students'));
//print_r($config);
//$attempt = $db->build_table('students', "create table student(id int primary key auto_increment not null, name varchar(100) )");
//print_r($attempt->errorInfo());
//$query = new \Jet\Framework\Core\Query();
//$query->setQuery("DESCRIBE");
//$query->add("students");
//$new = $query->execute();
//print_r($new);
//$table = new \Jet\Framework\Core\CoreTable();

class Student extends Model
{
    public $first_name;
    public $last_name;
    public $email;

     public function meta(): array
        {
             return [
                "first_name" => $this->CharField($length = 10,  $default="Hello world"),
                "last_name" => $this->CharField($length = 100),
                 "age" => $this->IntegerField($length=9, $increment = true),
            ];
        }

}

// left with actual table creation =, others completed.
$tb = new Student();
print_r($tb->getTableName());
print_r($tb->getColumns());
print_r($tb->column_names());



