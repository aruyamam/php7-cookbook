<?php

include (__DIR__ . DIRECTORY_SEPARATOR . 'chap_03_developing_functions_type_hints_library.php');

echo "\nsomeTypeHint()\n";
try {
   echo someTypeHint([1,2,3], new DateTime(), function () { return 'Callback Return'; });
   echo '<br>';
   echo someTypeHint('A', 'B', 'C');
}
catch (TypeError $e) {
   echo '<br>';
   echo $e->getMessage();
   echo '<br>';
   echo PHP_EOL;
}

try {
   echo '<br>';
   echo someScalarHint(TRUE, 11, 22.22, 'This is a string');
   echo '<br>';
   echo someScalarHint('A', 'B', 'C', 'D');
}
catch (TypeError $e) {
   echo '<br>';
   echo $e->getMessage();
}

try {
   echo '<br>';
   $b = someBoolHint(true);
   $i = someBoolHint(11);
   $f = someBoolHint(22.22);
   $s = someBoolHint('X');
   var_dump($b, $i, $f, $s);
   $a = someBoolHint([1,2,3]);
   echo '<br>';
   var_dump($a);
}
catch (TypeError $e) {
   echo '<br>';
   echo $e->getMessage();
}