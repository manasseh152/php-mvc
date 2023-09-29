<?php

namespace Src\Support;

use Twig\TwigFunction;

/**
 * GlobalFunctionsTwig is a class that extends the \Twig\Extension\AbstractExtension class in order to define global functions for use in Twig templates. 
 * 
 * The GlobalFunctionsTwig class is intended to be used in conjunction with the Twig templating engine, and its purpose is to provide a way to define functions that can be called from any Twig template without having to pass them as parameters to the template rendering function. 
 *
 * @package Src\Support
 */
class GlobalFunctionsTwig extends \Twig\Extension\AbstractExtension
{
  /**
   * Returns a list of global functions to add to the existing list of global functions.
   *
   * @return TwigFunction[]
   */
  public function getFunctions(): array
  {
    return [
      new TwigFunction('vite', [$this, 'vite']),
      new TwigFunction('path', [$this, 'path']),
      new TwigFunction('hydrate', [$this, 'hydrate']),
    ];
  }

  /**
   * Returns a string with the application's base url prepended to the given path.
   * 
   * @param string $path
   * @return string
   */
  public function path(string|array $path = ""): string
  {
    if (is_string($path)) {
      $path = [$path];
    }
    return $_ENV['APP_URL'] . '/' . implode('/', $path);
  }
}
