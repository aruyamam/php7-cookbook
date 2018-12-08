<?php
namespace Application\Acl;

use PDO;
use Application\Database\Connection;
use Psr\Http\Message\ { RequestInterface, ResponseInterface };
use Application\Middleware\ {Response, TextStream};

class DbTable implements AuthenticateInterface
{
   const ERROR_AUTH = 'ERROR: authentication error';
   protected $conn;
   protected $table;

   public function __construct(Connection $conn, $tableName)
   {
      $this->conn = $conn;
      $this->table = $tableName;
   }

   public function login(RequestInterface $request) : ResponseInterface
   {
      $code = 401;
      $info = FALSE;
      $body = new TextStream(self::ERROR_AUTH);
      $params = json_decode($request->getBody()->getContents());
      $response = new Response();
      $username = $params->username ?? FALSE;

      if ($username) {
         $sql = 'SELECT * FROM ' . $this->table . ' WHERE email = ?';
         $stmt = $this->conn->pdo->prepare($sql);
         $stmt->execute([$usernmae]);
         $row = $stmt->fetch(PDO::FETCH_ASSOC);

         if ($row) {
            if (password_verify($params->password, $row['password'])) {
               unset($row['password']);
               $body = new TextStream(json_encode($row));
               $response->withBody($body);
               $code = 202;
               $info = $row;
            }
         }
      }

      return $response->withBody($body)->withStatus($code);
   }
}