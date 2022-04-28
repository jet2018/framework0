<?php

namespace Jet\Framework\Fields;

class IntegerField extends CoreField
{
    public $length = 11;
    public $unique, $increment, $signed = false;
    public $default = null;
    public $null = true;
    public function __construct($length, $unique, $null, $increment, $default, $signed)
    {
        $this->setNull($null);
        $this->setUnique($unique);
        $this->setLength($length);
        $this->setType("int");
        $this->setAutoIncrement($increment);
        $this->setDefault($default);
        $this->setSigned($signed);
        $this->setCategory("integer");
    }
}
