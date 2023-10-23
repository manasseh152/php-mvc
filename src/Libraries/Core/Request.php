<?php

namespace Src\Libraries\Core;

class Request
{
  public readonly string $method;
  public readonly string $path;
  public readonly array $body;
  public readonly array $params;

  public function __construct()
  {
    // add support for PUT and DELETE
    $this->method = $_SERVER['REQUEST_METHOD'];
    $this->path = $_SERVER['REQUEST_URI'];
    $this->body = $this->getBody();
    $this->params = $this->getParams();
  }

  private function getBody(): array
  {
    $body = [];

    if ($this->method === 'POST') {
      foreach ($_POST as $key => $value) {
        $body[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS);
      }
    }

    if ($this->method === 'PUT' || $this->method === 'DELETE') {
      parse_str(file_get_contents('php://input'), $body);
    }

    return $body;
  }

  private function getParams(): array
  {
    $params = [];

    foreach ($_GET as $key => $value) {
      $params[$key] = filter_input(INPUT_GET, $key, FILTER_SANITIZE_SPECIAL_CHARS);
    }

    return $params;
  }
}
