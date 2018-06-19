<?php
namespace Schanihbg\Gravatar;

use PHPUnit\Framework\TestCase;

class GravatarModelTest extends TestCase
{

    protected static $di;

    public function setUp()
    {
        self::$di  = new \Anax\DI\DIFactoryConfig(__DIR__."/../test_di.php");
    }

    public function testEmailAttributeExists(): void
    {
        $this->assertEquals(
            '<img src="https://www.gravatar.com/avatar/b642b4217b34b1e8d3bd915fc65c4452?s=256&d=mm&r=g" alt="Gravatar" />',
            self::$di->get("gravatarController")->getGravatar("test@test.com", 256, "mm", "g", true, ["alt" => "Gravatar"])
        );
    }
}
