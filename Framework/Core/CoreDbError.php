<?php

namespace Jet\Framework\Core;


use Throwable;

class CoreDbError extends \Exception
{
    public function __construct(string $message = "", $code= 1000, ?Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

    public function __toString()
    {
        $error = "ERROR OCCURRED: SEE BELOW FOR DETAILS\n";

        $error.=".....................................\n";
        $error .= $this->getCode()."::".$this->getMessage()."\n";
        $error.= "......................................\n";
        $error.= $this->getTraceAsString()."\n";
        $error.= "......................................\n";
        $error.= "\n".$this->getFile();
        return $error;
    }


}
