<?php
define('TARGET_DIR', __DIR__ . '/uploads');

require __DIR__ . '/../Application/Autoload/Loader.php';

Application\Autoload\Loader::init(__DIR__ . '/..');

use Application\MiddleWare\ { Constants, UploadedFile };

try {
   $message = '';
   $uploadedFiles = array();

   if (isset($_FILES)) {
      foreach ($_FILES as $key => $info) {
         var_dump($key);
         if ($info['tmp_name']) {
            $uploadedFiles[$key] = new UploadedFile($key, $info, TRUE);
            $uploadedFiles[$key]->moveTo(TARGET_DIR);
         }
      }
   }
}
catch (Throwable $e) {
   $message = $e->getMessage();
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta http-equiv="X-UA-Compatible" content="ie=edge">
   <title>PHP 7 Cookbook</title>
</head>
<body>
   <div class="container">
      <h1>Search</h1>
      <form name="search" method="post" enctype="<?= Constants::CONTENT_TYPE_MULTI_FORM ?>">
         <table class="display">
            <tr>
               <th>Upload 1</th>
               <td><input type="file" name="upload_1"></td>
            </tr>
            <tr>
               <th>Upload 2</th>
               <td><input type="file" name="upload_2"></td>
            </tr>
            <tr>
               <th>Upload 3</th>
               <td><input type="file" name="upload_3"></td>
            </tr>
            <tr>
               <th>&nbsp;</th>
               <td><input type="submit"></td>
            </tr>
         </table>
      </form>
      <?= ($message) ? '<h1>' . $message . '</h1>' : ''; ?>

      <?php if ($uploadedFiles) : ?>

      <table>
         <tr>
            <th>Filename</th>
            <th>Size</th>
            <th>Moved Filename</th>
            <th>Text</th>
         </tr>
         <?php foreach ($uploadedFiles as $obj) : ?>

            <?php if ($obj->getMovedName()) : ?>

            <tr>
               <td><?= htmlspecialchars($obj->getClientFilename()) ?></td>
               <td><?= $obj->getSize() ?></td>
               <td><?= $obj->getMovedName() ?></td>
               <td><?= $obj->getStream()->getContents() ?></td>
            </tr>

            <?php endif; ?>

         <?php endforeach; ?>

      </table>

      <?php endif; ?>
      <?php phpinfo(INFO_VARIABLES); ?>
   </div>
</body>
</html>
