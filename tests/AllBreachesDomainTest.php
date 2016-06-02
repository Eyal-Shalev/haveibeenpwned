<?php
/**
 * @file
 * Contains \Pwned\AccountBreachTests
 */

namespace EyalShalev\Pwned;


class AllBreachesDomainTest extends BreachTestBase
{
    protected function getBreaches()
    {
        return $this->client->getAllBreaches('adobe.com');
    }
}
