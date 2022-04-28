<?php

namespace Jet\Framework\Fields;

class TextField extends CoreField
{

    public function __construct($length, $unique, $null, $default)
    {
        $this->setDefault($default);
        $this->setLength($length);
        $this->setUnique($unique);
        $this->setNull($null);
        $this->setCategory("string");
        $this->setType("TEXT");
    }
}
