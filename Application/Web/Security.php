<?php
namespace Application\Web;

/**
 * Defines a filtering/validating mechanism
 */
class Security {

   public $filter;
   public $validate;

   public function __construct() {
      $this->filter = [
         'striptags' => function ($a) { return strip_tags($a); },
         'digits' => function ($a) { return preg_replace('/[^0-9]/', '', $a); },
         'alpha' => function ($a) { return preg_replace('/[^A-Z]/i', '', $a); }
      ];
      $this->validate = [
         'alnum' => function ($a) { return ctype_alnum; },
         'digits' => function ($a) { return ctype_digit; },
         'alpha' => function ($a) { return ctype_alpha; },
      ];
   }

   public function __call($method, $params) {
      preg_match('/^(filter|validate)(.*?)$/i', $method, $matches);
      \print_r($matches);
      $prefix = $matches[1] ?? '';
      $function = strtolower($matches[2] ?? '');
      if ($prefix && $function) {
         return $this->$prefix[$function]($params[0]);
      }
      return $value;
   }
}