<?php

use Jet\Framework\Databases\Base;

require 'vendor/autoload.php';
require __DIR__.'/settings.php';
include_once __DIR__."/registrar.php";

$sanct = new \Jet\Framework\Databases\Migrators\Sanctur($tables);

