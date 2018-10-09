<?php

   require __DIR__ . '/../Application/Autoload/Loader.php';

   Application\Autoload\Loader::init(__DIR__ . '/../');

   $deep = new Application\Web\Deep();

   define('DEFAULT_URL', 'oreilly.com');
   define('DEFAULT_TAG', 'img');

   $url = strip_tags($_GET['url'] ?? DEFAULT_URL);
   $tag = strip_tags($_GET['tag'] ?? DEFAULT_TAG);

   foreach ($deep->scan($url, $tag) as $item) {
      $src = $item['attributes']['src'] ?? NULL;
      if ($src && (stripos($src, 'png') || stripos($src, 'jpg'))) {
         printf('<br><img src="%s">', $src);
      }
   }
