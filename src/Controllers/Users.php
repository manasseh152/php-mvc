<?php

namespace Src\Controllers;

use Src\Libraries\Core\Controller;
use Src\Models\UserModel;
use Src\Entity\User;

class Users extends Controller
{
  public function index(): void
  {
    $this->setData([
      'todos' => UserModel::FindAll(),
    ]);

    $this->view('partials/user/list');
  }

  public function create(): void
  {
    $this->view('partials/user/create');
  }

  public function store(): void
  {
    $user = new User(
      id: isset($_POST['id']) ? $_POST['id'] : null,
      name: $_POST['name'],
      email: $_POST['email'],
      password: $_POST['password'],
    );

    if (!isset($user->id)) {
      $user = UserModel::Create($user);
    } else {
      $user = UserModel::Update($user);
    }

    $this->setData([
      'user' => $user,
    ]);

    $this->view('partials/user/show');
  }

  public function show(int $id): void
  {
    $user = UserModel::FindById($id);

    $this->setData([
      'user' => $user,
    ]);

    $this->view('partials/user/show');
  }

  public function edit(int $id): void
  {
    $user = UserModel::FindById($id);

    $this->setData([
      'user' => $user,
    ]);

    $this->view('partials/user/edit');
  }

  public function delete(int $id): void
  {
    $user = UserModel::Delete($id);

    $this->setData([
      'user' => $user,
    ]);

    $this->view('partials/user/delete');
  }
}
