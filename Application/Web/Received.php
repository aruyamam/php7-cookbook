<?php
namespace Application\Web;

class Received extends AbstractHttp
{
   public function __construct(
      $uri = NULL,
      $method = NULL,
      array $headers = NULL,
      array $data = NULL,
      array $cookies = NULL
   )
   {
      $this->uri = $uri;
      $this->method = $method;
      $this->headers = $headers;
      $this->data = $data;
      $this->cookies = $cookies;
      $this->setTransport();
   }
}
