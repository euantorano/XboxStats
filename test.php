<?php

require 'src/Euantor/XboxStats.class.php';
$xbox = new Euantor\XboxStats;
$xbox->setGamertag('etorano');
var_dump($xbox->getStats());
