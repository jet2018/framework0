<?php

namespace Jet\Framework\Fields;

class JsonField extends CoreField
{
    public function __construct($null)
    {
        $this->setNull($null);
        $this->setCategory("string");
        $this->setType("JSON");
    }
}
