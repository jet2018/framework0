<?php

namespace Jet\Framework\Fields;

class ForeignKey extends CoreField
{
    public function __construct($model, $on_delete, $on_update, $null)
    {
        $this->setIsFk(true);
        $this->setType('bigint');
        $this->setCategory('integer');
        $this->setModelReferenced($model);
        $this->setOnDelete($on_delete);
        $this->setOnUpdate($on_update);
        $this->setNull($null);
    }

}
