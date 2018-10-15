<?php

require __DIR__ . '/../Application/Autoload/Loader.php';

Application\Autoload\Loader::init(__DIR__ . '/..');

use Application\Form\Generic;
use Application\Form\Element\Radio;

$wrappers = [
   Generic::INPUT => ['type' => 'td', 'class' => 'content'],
   Generic::LABEL => ['type' => 'th', 'class' => 'label'],
   Generic::ERRORS => ['type' => 'td', 'class' => 'error']
];

$statusList = [
   'U' => 'Unconnfirmed',
   'P' => 'Pending',
   'T' => 'Temporary Approval',
   'A' => 'Approval' 
];

// define elements
$status = new Radio(
   'status',
   Generic::TYPE_RADIO,
   'Status',
   $wrappers,
   ['id' => 'status']
);

// get status from $_GET if any
$checked = $_GET['status'] ?? 'U';

// set options
$status->setOptions($statusList, $checked, '<br>', TRUE);

// submit button
$submit = new Generic(
   'submit',
   Generic::TYPE_SUBMIT,
   'Process',
   $wrappers,
   [
      'id' => 'submit',
      'title' => 'Click to process',
      'value' => 'Click Here'
   ]
);
?>

<!DOCTYPE html>
<html lang="ja">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta http-equiv="X-UA-Compatible" content="ie=edge">
   <title>PHP 7 Cookbook</title>
   <link rel="stylesheet" href="style.css">
</head>
<body>
   <div class="container">
      <h1>Status</h1>
      <form name="status" method="get">
         <table id="status" class="display" cellspacing="0" width="100%">
            <tr><?= $status->render(); ?></tr>
            <tr><?= $submit->render(); ?></tr>
            <tr>
               <td colspan=2>
                  <br>
                  <pre><?php var_dump($_GET); ?></pre>
               </td>
            </tr>
         </table>
      </form>
   </div>
</body>
</html>