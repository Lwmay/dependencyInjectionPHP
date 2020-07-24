<?php


namespace lwmay\DependencyInjection\Tests\Fixtures;

/**
 * Class Database
 * @package lwmay\DependencyInjection\Tests\Fixtures
 */
class Database
{
    public function __construct(Router $router)
    {
    }
}