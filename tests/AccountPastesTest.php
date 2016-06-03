<?php
/**
 * @file
 * Contains \EyalShalev\Pwned\DataClassesTest
 */

namespace EyalShalev\Pwned;


class AccountPastesTest extends ClientTestBase
{

    protected $requiredPasteKeys;

    public function testAccountPastes()
    {
        $pastes = $this->client->getAccountPastes('foo@bar.com');

        $this->assertInternalType('array', $pastes);

        $this->assertNotEmpty($pastes);

        return $pastes;
    }

    /**
     * @depends testBreaches
     * @param array
     * @return array
     */
    public function testAccountPaste($pastes)
    {
        $paste = current($pastes);

        $this->assertInternalType('array', $paste);

        $this->assertNotEmpty($pastes);

        return $paste;
    }

    /**
     * @depends testBreaches
     * @param array
     * @return array
     */
    public function testAccountPasteKeys($paste)
    {
        foreach ($this->requiredPasteKeys as $key => $type) {
            $this->assertArrayHasKey($key, $paste);
        }

        return $paste;
    }

    /**
     * @depends testBreaches
     * @param array
     * @return array
     */
    public function testAccountPasteKeyTypes($paste)
    {
        foreach ($this->requiredPasteKeys as $key => $type) {
            $this->assertInternalType($type, $key);
        }

        return $paste;
    }


    /**
     * @inheritdoc
     */
    protected function setUp()
    {
        parent::setUp();
        $this->requiredPasteKeys = [
          'Source' => 'string',
          'Id' => 'string',
          'Title' => 'string',
          'Date' => 'string', // Date
          'EmailCount' => 'int',
        ];
    }
}
