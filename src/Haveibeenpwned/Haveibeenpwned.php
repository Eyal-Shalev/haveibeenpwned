<?php

namespace Haveibeenpwned;

use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerAwareTrait;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Exposes the http://haveibeenpwned.com API.
 *
 * @author Eyal Shalev <eyalsh@gmail.com>
 * @link http://haveibeenpwned.com
 */
class Haveibeenpwned implements ContainerAwareInterface {
  use ContainerAwareTrait;

  /**
   * Creates a new instance of the Haveibeenpwned service.
   * @param \Symfony\Component\DependencyInjection\ContainerInterface $container
   * @return static
   */
  public static function create(ContainerInterface $container) {
    $instance = new static();
    $instance->setContainer($container);
    return $instance;
  }

}