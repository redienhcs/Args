<?php

namespace Redienhcs\Args\Classes;

use Redienhcs\Args\Interfaces\ArgumentMarshaler;

class MixedArgumentMashaler implements ArgumentMarshaler {
    public $value;
    
    public function setValue( $currentArgument) {
        $this->value = $currentArgument;
    }

    public function getValue( ) {
        return $this->value;
    }
}