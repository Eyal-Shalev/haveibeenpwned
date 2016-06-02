<?php

namespace EyalShalev\Pwned;

use GuzzleHttp\Client as HttpClient;
use Psr\Http\Message\ResponseInterface;

/**
 * Exposes the http://haveibeenpwned.com API.
 *
 * @author Eyal Shalev <eyalsh@gmail.com>
 * @link http://haveibeenpwned.com
 */
class Client
{

    const BASE_URI = 'https://haveibeenpwned.com/api/';
    const DEFAULT_USER_AGENT = 'eyal-shalev/pwned';
    const DEFAULT_API_VERSION = 2;

    protected static $dataClasses;

    /**
     * @var \GuzzleHttp\Client
     */
    protected $client;

    /**
     * @var string
     */
    protected $userAgent;

    /**
     * @var int
     */
    protected $apiVersion;

    /**
     * Client constructor.
     *
     * @param string $user_agent
     *   The user agent to use when identifying with haveibeenpwned.com
     * @param int $api_version
     *   The api version to use.
     */
    public function __construct($user_agent, $api_version)
    {
        $this->userAgent = $user_agent;
        $this->apiVersion = $api_version;
        $this->client = new HttpClient($this->defaultHttpClientOptions());
    }

    /**
     * The default options to pass to the http client when initiated.
     *
     * @return array
     */
    protected function defaultHttpClientOptions()
    {
        return [
          'base_uri' => static::BASE_URI,
          'headers' => [
            'api-version' => $this->apiVersion,
            'User-Agent' => $this->userAgent,
          ],
        ];
    }

    /**
     * Returns all the breaches for a specific account.
     *
     * @param string $account_name
     *   The account name can be used to filter the results to a specific account.
     * @param string $domain
     *   The domain name can be used to filter the results to a specific domain.
     * @param bool $truncate
     *   When true only the names of the breaches are returned.
     * @return array
     *
     * @see https://haveibeenpwned.com/API#BreachesForAccount
     */
    public function getAccountBreaches(
      $account_name,
      $domain = null,
      $truncate = false
    ) {
        $options = [];
        if ($truncate) {
            $options['truncateResponse'] = 'true';
        }
        if (is_string($domain)) {
            $options['domain'] = $domain;
        }

        $target_items = ['breachedaccount', $account_name];

        return $this->decodeResponse(
          $this->getResponse($target_items, $options)
        );
    }

    /**
     * Decodes a response object to a php array.
     *
     * @param \Psr\Http\Message\ResponseInterface $response
     * @return array
     * @throws \HttpResponseException
     */
    protected function decodeResponse(ResponseInterface $response)
    {
        switch ($response->getStatusCode()) {
            case 200:
                return \json_decode($response->getBody(), true);
            case 400:
                throw new \HttpResponseException(
                  'Bad request — the account does not comply with an acceptable format.'
                );
            case 403:
                throw new \HttpResponseException(
                  'Forbidden — no user agent has been specified in the request.'
                );
            case 404:
                throw new \HttpResponseException(
                  'Not found — the account could not be found and has therefore not been pwned.'
                );
            default:
                return [];
        }
    }

    /**
     * Makes a get request with the http_client.
     * @param string[] $target_items
     *   These items are combined with a '\' character to create a valid http request.
     * @param array $options
     *   The array options to add to the request.
     * @return \Psr\Http\Message\ResponseInterface
     * @throws \HttpResponseException
     */
    protected function getResponse(array $target_items, array $options = [])
    {
        if (empty($target_items)) {
            throw new \BadMethodCallException(
              'The targets_items array cannot be empty.'
            );
        }

        return $this->client->get(implode('/', $target_items), $options);
    }

    /**
     * Returns all the breaches in the haveibeenpwned database.
     *
     * @param string $domain
     *   The domain name can be used to filter the results to a specific domain.
     * @return array
     *
     * @see https://haveibeenpwned.com/API#AllBreaches
     */
    public function getAllBreaches($domain = null)
    {
        $options = [];
        if (is_string($domain)) {
            $options['domain'] = $domain;
        }

        return $this->decodeResponse(
          $this->getResponse(['breaches'], $options)
        );
    }

    /**
     * All the information regarding a single breached site.
     *
     * @param string $site_name
     *   The name of the breached site as it appears in the haveibeenpwned database.
     * @return array
     *
     * @see https://haveibeenpwned.com/API#SingleBreach
     */
    public function getBreach($site_name)
    {
        return $this->decodeResponse(
          $this->getResponse(['breach', $site_name])
        );
    }

    /**
     * A "data class" is an attribute of a record compromised in a breach.
     * breaches expose previously unseen classes of data.
     *
     * @return string[]
     * @throws \HttpResponseException
     *
     * @see https://haveibeenpwned.com/API#AllDataClasses
     */
    public function getDataClasses()
    {
        if (empty(static::$dataClasses)) {
            static::$dataClasses = $this->decodeResponse(
              $this->getResponse(['dataclasses'])
            );
        }

        return static::$dataClasses;
    }

}