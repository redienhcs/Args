<?php
require_once('vendor/autoload.php');

use Redienhcs\Args\Classes\Args;


$objArgs = new Args( 'h,css', $argv);

echo 'Conteudo dentro do argument marshaler h: '. $objArgs->getArgument( 'h').PHP_EOL;
echo 'Conteudo dentro do argument marshaler css: '. $objArgs->getArgument( 'css').PHP_EOL;