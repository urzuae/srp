<?php
set_error_handler(create_function('$a, $b, $c, $d', 'throw new ErrorException($b, 0, $a, $c, $d);'), E_ALL & ~E_NOTICE);
chdir('..');
include_once 'bootstrap.php';
