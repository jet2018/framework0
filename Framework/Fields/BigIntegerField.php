<?php

namespace Jet\Framework\Fields;

class BigIntegerField extends CoreField
{
    public function __construct($length, $unique, $increment, $null,  $unsigned, $default)
    {
        $this->setNull($null);
        $this->setUnique($unique);
        $this->setLength($length);
        $this->setType("bigint");
        $this->setDefault($default);
        $this->setSigned($unsigned);
        $this->setAutoIncrement($increment);
        $this->setCategory("integer");
    }
}
