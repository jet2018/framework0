<?php

namespace Jet\Framework\Fields;

class PositiveIntegerField extends CoreField
{
    public function __construct($length, $unique, $null, $default, $increment)
    {
        $this->setNull($null);
        $this->setUnique($unique);
        $this->setLength($length);
        $this->setType("int");
        $this->setSigned(true);
        $this->setAutoIncrement($increment);
        $this->setDefault($default);
        $this->setCategory("integer");
    }

}
