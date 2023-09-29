<?php

namespace Src\Controllers;

use Src\Libraries\Core\Controller;
use Src\Models\UserModel;

class Homepages extends Controller
{
  public function index(): void
  {
    $this->setData([
      'title' => 'Landing Page',
      'todos' => [],
    ]);

    $this->view('pages/homepages/index');
  }
}
