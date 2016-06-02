<?php
/**
 * @file
 * Contains \Pwned\Tests\Api
 */

namespace EyalShalev\Pwned;

abstract class BreachTestBase extends ClientTestBase
{

    protected $requiredBreachItemKeys = [];

    public function testBreaches()
    {
        $breaches = $this->getBreaches();

        $this->assertInternalType('array', $breaches);

        $this->assertNotEmpty(
          $breaches
        );

        return $breaches;
    }

    /**
     * The breaches array that is being tested.
     *
     * @return array
     */
    abstract protected function getBreaches();

    /**
     * @depends testBreaches
     * @param array $breaches
     * @return array
     */
    public function testBreachItem(array $breaches)
    {

        $breach = current($breaches);

        $this->assertInternalType('array', $breach);

        $this->assertNotEmpty($breach);

        foreach ($this->requiredBreachItemKeys as $key => $type) {
            $this->assertArrayHasKey($key, $breach);
            $this->assertInternalType($type, $breach[$key]);
        }

        return $breach;
    }

    /**
     * @depends testBreachItem
     * @param array $breach
     * @return array
     */
    public function testBreachItemKeys(array $breach)
    {

        foreach ($this->requiredBreachItemKeys as $key => $type) {
            $this->assertArrayHasKey($key, $breach);
        }

        return $breach;
    }

    /**
     * @depends testBreachItemKeys
     * @param array $breach
     * @return array
     */
    public function testBreachItemKeyTypes(array $breach)
    {

        foreach ($this->requiredBreachItemKeys as $key => $type) {
            $this->assertInternalType($type, $breach[$key]);
        }

        return $breach;
    }

    /**
     * @inheritdoc
     */
    protected function setUp()
    {
        parent::setUp();
        $this->requiredBreachItemKeys = [
          'Name' => 'string',
          'Title' => 'string',
          'Domain' => 'string',
          'BreachDate' => 'string', // ISO 8601 (day precision)
          'AddedDate' => 'string', // ISO 8601 (minute precision)
          'PwnCount' => 'int',
          'Description' => 'string',
          'DataClasses' => 'array',
          'IsSensitive' => 'bool',
          'IsRetired' => 'bool',
        ];
    }
}
