## Introduction
This library exposes the [https://haveibeenpwned.com](haveibeenpwned) APIs.

## Features
- An intuitive client class
- APIs:
    - BreachesForAccount
    - AllBreaches
    - SingleBreach
    - AllDataClasses
- PHPUnit tests

## Dependencies
- guzzlehttp/guzzle: ^6.1

## Installation

`require eyal-shalev/pwned`

## Usage example
**The following will return all the breaches under the adobe.com domain.**

    $client = new \EyalShalev\Pwned\Client('eyal-shalev/pwned:test', 2);
    $breaches = $client->getAllBreaches('adobe.com');


