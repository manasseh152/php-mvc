<?php

namespace Src\Libraries\Core;

use Twig\Environment;
use Src\Libraries\Core\Core;
use Src\Libraries\Core\Request;

/**
 * Base Controller class for handling common functionality for controllers
 */
class Controller
{
  /**
   * The Twig environment instance
   *
   * @var Environment
   */
  protected Environment $twig;

  /**
   * The data that will be passed to the view
   *
   * @var array
   */
  protected array $data = [];

  /**
   * The data that will be passed to javascript
   * Do not use this for sensitive data
   * 
   * @var array
   */
  protected array $jsData = [];

  public function __construct(public Request $request = new Request)
  {
  }

  /**
   * Redirect the client to a different page
   *
   * @param string $url The url to redirect to
   * @return void
   */
  public function redirect(string $url, int $wait = 0): void
  {
    header('Refresh: ' . $wait . '; URL=' . $url);
  }

  /**
   * Render a Twig template and output the result
   *
   * @param string $template The name of the Twig template to render
   * @return void
   */
  public function view(string $template): void
  {
    // get the Twig environment instance
    $this->twig = Core::getTwig();

    // add the jsData to the data array
    $this->data['jsData'] = $this->jsData;

    // render the templates
    echo $this->twig->render($template . '.twig', $this->data);
  }

  /**
   * Send a JSON response to the client
   * 
   * @param array $data The data to be sent as JSON
   * @return void
   */
  public function json(array $data): void
  {
    header('Content-Type: application/json');
    echo json_encode($data);
  }

  public function pageNotFound(): void
  {
    Core::pageNotFound();
    exit;
  }

  /**
   * Set the data that will be passed to the view
   *
   * @param array $data The data to be set
   * @return void
   */
  protected function setData(array $data): void
  {
    $this->data = $data;
  }

  /**
   * Add data to the existing data array that will be passed to the view
   *
   * @param array $data The data to be added
   * @return void
   */
  public function addData(array $data): void
  {
    $this->data = array_merge($this->data, $data);
  }

  /**
   * Get the data that will be passed to the view
   *
   * @return array The data to be passed to the view
   */
  public function getData(): array
  {
    return $this->data;
  }
}
