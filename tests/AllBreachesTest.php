<?php
/**
 * @file
 * Contains \Pwned\AccountBreachTests
 */

namespace EyalShalev\Pwned;


class AllBreachesTest extends BreachTestBase
{
    protected function getBreaches()
    {
        return $this->client->getAllBreaches();
    }
}
