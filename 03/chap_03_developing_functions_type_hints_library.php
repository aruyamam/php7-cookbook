<?php
declare(strict_types=1);

// PHP 5 and 7 type hints
function someTypeHint(Array $a, DateTime $t, Callable $c) {
   $message = '';
   $message .= 'Array Count: ' . count($a) . PHP_EOL;
   $message .= 'Date: ' . $t->format('Y-m-d') . PHP_EOL;
   $message .= 'Callable Return: ' . $c() . PHP_EOL;
   return $message;
}

// scalar type hints (only in PHP 7)
function someScalarHint(bool $b, int $i, float $f, string $s) {
   return sprintf(
      "\n%20s : %5s\n%20s : %5d\n%20s "
      . ": %5.2f\n%20s : %20s\n\n",
      'Boolean', ($b ? 'TRUE' : 'FALSE'),
      'Integer', $i,
      'Float', $f,
      'String', $s
   );
}

// bloolean type hint
function someBoolHint(bool $b) {
   return $b;
}