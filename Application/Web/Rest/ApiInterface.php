<?php
namespace Application\Web\Rest;

use Application\Web\ { Request, Response };

/**
 * Rest API Interface
 */
interface ApiInterface
{
   public function get(Request $request, Response $response);
   public function put(Request $request, Response $response);
   public function post(Request $request, Response $response);
   public function delete(Request $request, Response $response);
   public function authenticate(Request $request);
}