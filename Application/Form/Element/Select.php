<?php
namespace Application\Form\Element;

use Application\Form\Generic;

class Select extends Generic {

   const DEFAULT_OPTION_KEY = 0;
   const DEFUALT_OPTION_VALUE = 'Choose';

   protected $options;
   protected $selectedKey = DEFAULT_OPTION_KEY;

   public function setOptions(array $options, $selectedKey = self::DEFAULT_OPTION_KEY) {
      $this->options = $options;
      $this->selectedKey = $selectedKey;
      if (isset($this->attributes['multiple'])) {
         $this->name .= '[]';
      }
   }

   public function getInputOnly() {
      $output = $this->getSelect();
      $output .= $this->getOptions();
      $output .= '</' . $this->getType() . '>';
      return $output;
   }

   protected function getSelect() {
      $this->pattern = '<select name="%s" %s> ' . PHP_EOL;
      return sprintf($this->pattern, $this->name, $this->getAttribs());
   }

   protected function getOptions() {
      $output = '';
      foreach ($this->options as $key => $value) {
         if (is_array($this->selectedKey)) {
            $selected = (in_array($key, $this->selectedKey)) ? ' selected' : '';
         }
         else {
            $selected = ($key == $this->selectedKey) ? ' selected' : '';
         }
         $output .= '<option value="' . $key . '"' . $selected . '>' . $value . '</option>' . PHP_EOL;
      }
      return $output;
   }
}