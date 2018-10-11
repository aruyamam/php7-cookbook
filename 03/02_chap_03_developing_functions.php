<?php

include (__DIR__ . DIRECTORY_SEPARATOR . 'chap_03_developing_functions_library.php');

echo someName('TEST');
echo '<br>';
echo someOtherName(1);
echo '<br>';
echo someOtherName(1, 1);
echo '<br>';
echo someInfinite(22.22, 'A', ['a' => 1, 'b' => 2]);
echo '<br>';
foreach (someDirScan(__DIR__ . DIRECTORY_SEPARATOR . '..') as $item) {
   echo $item . PHP_EOL;
}
