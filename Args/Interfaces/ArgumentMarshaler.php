<?php

namespace Redienhcs\Args\Interfaces;
interface ArgumentMarshaler {
    public function setValue( string $currentArgument) ;
    public function getValue( ) ;
}