<?php

namespace Haveibeenpwned;

use GuzzleHttp\Client as HttpClient;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Exposes the http://haveibeenpwned.com API.
 *
 * @author Eyal Shalev <eyalsh@gmail.com>
 * @link http://haveibeenpwned.com
 */
class Client {

  const BASE_URI = 'https://haveibeenpwned.com/api/';
  const DEFAULT_USER_AGENT = 'eyal-shalev/haveibeenpwned';

  /**
   * @var \GuzzleHttp\Client
   */
  protected $client;

  /**
   * @var int
   */
  protected $apiVersion = 2;

  /**
   * Client constructor.
   * @param string $user_agent
   */
  public function __construct($user_agent) {
    $this->client = new HttpClient([
      'base_uri' => static::BASE_URI,
      'api-version' => $this->apiVersion,
      'User-Agent' => $user_agent
    ]);
  }

  /**
   * Returns all the breaches for a specific account.
   * @param string $account_name
   *   The name of the account.
   * @param bool $truncate
   *   When true only the names of the breaches are returned.
   * @return array
   * @see https://haveibeenpwned.com/API#BreachesForAccount
   */
  public function getAccountBreaches($account_name, $domain = NULL, $truncate = FALSE) {
    $options = [
      'truncateResponse' => $truncate ? 'true' : 'false'
    ];
    if (is_string($domain)) {
      $options['domain'] = $domain;
    }
    $response = $this->client->post("breachedaccount/{$account_name}", $options);
    return \json_decode($response->getBody(), TRUE);
  }

  /**
   * Creates a new instance of the Haveibeenpwned service.
   * @param \Symfony\Component\DependencyInjection\ContainerInterface $container
   * @return static
   */
  public static function create(ContainerInterface $container) {
    $user_agent = self::DEFAULT_USER_AGENT;
    if ($container->hasParameter('hibp.user_agent')) {
      $user_agent = $container->getParameter('hibp.user_agent');
    }
    return new static($user_agent);
  }

}