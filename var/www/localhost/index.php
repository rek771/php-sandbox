<?php
phpinfo();

$a = 5;
$b = [$a, 2];
$b[] = &$a;
xdebug_debug_zval('a');
xdebug_debug_zval('b');
