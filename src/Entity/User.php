<?php

namespace Src\Entity;

class User
{
  public function __construct(
    public ?int $id = null,
    public string $name,
    public string $email,
    public string $password,
    public ?string $created_at = null,
    public ?string $updated_at = null,
  ) {
  }
}
