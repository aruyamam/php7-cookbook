<?php

define('DB_CONFIG_FILE', '/../config/db.config.php');
include __DIR__ . '/../Application/Database/Connection.php';

use Application\Database\Connection;
$conn = new Connection(include __DIR__ . DB_CONFIG_FILE);

function findCustomerById($id, Connection $conn) {
   $stmt = $conn->pdo->query(
      'SELECT * FROM customer WHERE id = ' . (int) $id
   );
   $results = $stmt->fetch(PDO::FETCH_ASSOC);
   return $results;
}

// pick ID at random
$id = rand(1, 79);
$result = findCustomerById($id, $conn);
?>
<!DOCTYPE html>
<html lang="ja">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta http-equiv="X-UA-Compatible" content="ie=edge">
   <title>PHP 7 Cookbook</title>
   <style>
      .container {
         width: 800px;
         float: left;
      }
      .row {
         width: 800px;
         float: left;
      }
      .left {
         width: 300px;
         font-weight: bold;
         float: left;
      }
      .right {
         width: 500px;
         float: left;
      }
      h1 {
         background-color: #ffff6f;
      }
      table {
         width: 800px;
         float: left;
      }
      th {
         background-color: #84bcf2;
         border: thin solid black;
      }
      td {
         background-color: #fdfd9f;
         border: thin solid black;
      }
   </style>
   <link rel="stylesheet" href="//cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
   <script src="https://code.jquery.com/jquery-3.3.1.min.js"  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
   <script src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
   <script>
      $(document).ready(function () {
         $('#customerTable').DataTable({
            'ajax': '06_chap_05_jquery_datatables_php_lookups_ajax.php?id=<?= $id ?>'
         });
      });
   </script>
</head>
<body>
   <div class="container">
      <h1><?= $result['name'] ?></h1>
      <div class="row">
         <div class="left">Balance</div>
         <div class="right">
            <?= $result['balance'] ?>
         </div>
      </div>
      <div class="row">
         <div class="left">Email</div>
         <div class="right">
            <?= $result['email'] ?>
         </div>
      </div>
      <div class="row">
         <div class="left">Status</div>
         <div class="right">
            <?= $result['status'] ?>
         </div>
      </div>
      <div class="row">
         <div class="left">Level</div>
         <div class="right">
            <?= $result['level'] ?>
         </div>
      </div>

      <table id="customerTable" class="display">
         <thead>
            <tr>
               <tr>
                  <th>Transaction</th>
                  <th>Date</th>
                  <th>Qty</th>
                  <th>Price</th>
                  <th>Product</th>
               </tr>
            </tr>
         </thead>
      </table>
   </div>
</body>
</html>
