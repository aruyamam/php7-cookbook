<?php

function someName($parameter) {
   $result = 'INIT';
   $result .= ' and also ' . $parameter;
   return $result;
}

function someOtherName($requiredParam, $optionalParam = NULL) {
   $result = 0;
   $result += $requiredParam;
   $result += $optionalParam ?? 0;
   return $result;
}

function someInfinite(...$params) {
   return var_export($params, TRUE);
}

function someDirScan($dir) {
   static $list = array();
   $scan = glob($dir . DIRECTORY_SEPARATOR . '*');
   foreach($scan as $item) {
      if (is_dir($item)) {
         $list[] = $item;
         someDirScan($item);
      }
      else {
         $list[] = $item;
      }
   }
   return $list;
}