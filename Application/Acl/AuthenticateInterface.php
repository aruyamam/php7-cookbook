<?php
namespace Application\Acl;

use Psr\Http\Message\ { RequestInterface, ResponseInterface };

interface AuthenticateInterface
{
   /**
    * @param RequestInterface $request
    * @return ResponseInterface $response
    */
   public function login(RequestInterface $request) : ResponseInterface;
}
