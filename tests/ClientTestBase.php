<?php
/**
 * @file
 * Contains \EyalShalev\Pwned\ClientTestBase
 */

namespace EyalShalev\Pwned;


class ClientTestBase extends \PHPUnit_Framework_TestCase
{

    /**
     * @var \EyalShalev\Pwned\Client
     */
    protected $client;

    /**
     * @inheritdoc
     */
    protected function setUp()
    {
        $this->client = new Client('eyal-shalev/pwned:test', 2);
    }
}
