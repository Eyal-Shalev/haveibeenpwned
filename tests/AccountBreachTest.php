<?php
/**
 * @file
 * Contains \Pwned\AccountBreachTests
 */

namespace EyalShalev\Pwned;


class AccountBreachTest extends BreachTestBase
{
    protected function getBreaches()
    {
        return $this->client->getAccountBreaches('foo@bar.com');
    }
}
