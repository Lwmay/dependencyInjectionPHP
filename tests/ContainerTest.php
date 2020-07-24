<?php


namespace lwmay\DependencyInjection\Tests;

use lwmay\DependencyInjection\Container;
use lwmay\DependencyInjection\Tests\Fixtures\Database;
use PHPUnit\Framework\TestCase;

/**
 * Class ContainerTest
 * @package lwmay\DependencyInjection\Tests
 */
class ContainerTest extends TestCase
{
    public function test()
    {
        $container = new Container();

        $database1 = $container->get(Database::class);
        $database2 = $container->get(Database::class);
        $this->assertInstanceOf(Database::class, $database1);
        $this->assertInstanceOf(Database::class, $database2);
        $this->assertEquals(spl_object_id($database1), spl_object_id($database2));
    }


}