<?php
// embeds code to perform a secondary lookup into database query results

define('DB_CONFIG_FILE', '/../config/db.config.php');
include __DIR__ . '/../Application/Database/Connection.php';

use Application\Database\Connection;
$conn = new Connection(include __DIR__ . DB_CONFIG_FILE);

function findCustomerById($id, Connection $conn) {
   $stmt = $conn->pdo->query(
      'SELECT * FROM customer WHERE id = ' . (int) $id
   );
   $results = $stmt->fetch(PDO::FETCH_ASSOC);
   if ($results) {
      $results['purchases'] =
         // define secondary lookup
         function ($id, $conn) {
            $sql = 'SELECT * FROM purchases AS u '
               . 'JOIN products AS r '
               . 'ON u.product_id = r.id '
               . 'WHERE u.customer_id = :id '
               . 'ORDER BY u.date';
            $stmt = $conn->pdo->prepare($sql);
            $stmt->execute(['id' => $id]);
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
               yield $row;
            }
         };
   }
   return $results;
}

$result = findCustomerById(rand(1, 79), $conn);
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
</head>
<body>
   <div class="cotainer">
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

      <table>
         <tr>
            <th>Transaction</th>
            <th>Date</th>
            <th>Qty</th>
            <th>Price</th>
            <th>Product</th>
         </tr>
         <?php foreach ($result['purchases']($result['id'], $conn) as $purchase) : ?>
            <tr>
               <td><?= $purchase['transaction'] ?></td>
               <td><?= $purchase['date'] ?></td>
               <td><?= $purchase['quantity'] ?></td>
               <td><?= $purchase['sale_price'] ?></td>
               <td><?= $purchase['title'] ?></td>
            </tr>
         <?php endforeach; ?>
      </table>
   </div>
</body>
</html>