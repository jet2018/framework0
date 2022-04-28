<?php

namespace Jet\Framework\Fields;

use Jet\Framework\Core\CoreDbError;

/**
 * @example
 * first_name varchar(20) unique not null
 *
 * @required
 * $type, $length, $unique, $null, $field_name
 */
class CharField extends CoreField
{

    public function __construct($length=256, $unique = false, $null = false, $default=null)
    {
        $this->setNull($null);
        $this->setUnique($unique);
        $this->setLength($length);
        $this->setDefault($default);
        $this->setType("VARCHAR");
        $this->setCategory("string");
    }
}
