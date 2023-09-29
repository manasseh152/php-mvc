<?php

namespace Src\Models;

use Src\Libraries\Core\Database;
use Src\Entity\User;

class UserModel
{
  public static function FindAll(): array
  {
    $db = Database::getInstance()->db;

    $stmt = $db->prepare('SELECT * FROM users');
    $stmt->execute();

    return $stmt->fetchAll();
  }

  public static function FindById(int $id): object | bool
  {
    $db = Database::getInstance()->db;

    $stmt = $db->prepare('SELECT * FROM users WHERE id = :id');
    $stmt->execute(['id' => $id]);

    return $stmt->fetch();
  }

  public static function FindByEmail(string $email): object | bool
  {
    $db = Database::getInstance()->db;

    $stmt = $db->prepare('SELECT * FROM users WHERE email = :email');
    $stmt->execute(['email' => $email]);

    return $stmt->fetch();
  }

  public static function Create(User $user): bool
  {
    $db = Database::getInstance()->db;

    $stmt = $db->prepare('INSERT INTO users (name, email, password) VALUES (:name, :email, :password)');

    return $stmt->execute([
      'name' => $user->name,
      'email' => $user->email,
      'password' => $user->password,
    ]);
  }

  public static function Update(User $user): bool
  {
    $db = Database::getInstance()->db;

    $stmt = $db->prepare('UPDATE users SET name = :name, email = :email, password = :password WHERE id = :id');
    return $stmt->execute([
      'id' => $user->id,
      'name' => $user->name,
      'email' => $user->email,
      'password' => $user->password,
    ]);
  }

  public static function Delete(int $id): bool
  {
    $db = Database::getInstance()->db;

    $stmt = $db->prepare('DELETE FROM users WHERE id = :id');
    return $stmt->execute(['id' => $id]);
  }
}
