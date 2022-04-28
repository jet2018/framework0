<?php

namespace Jet\Framework\Fields;

class SmallIntegerField extends CoreField
{
    public function __construct($length, $unique, $increment, $null, $unsigned, $default)
    {
        $this->setNull($null);
        $this->setUnique($unique);
        $this->setLength($length);
        $this->setType("smallint");
        $this->setSigned($unsigned);
        $this->setDefault($default);
        $this->setAutoIncrement($increment);
        $this->setCategory("integer");
    }

}
