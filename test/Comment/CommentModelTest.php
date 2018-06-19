<?php
namespace Schanihbg\Comment;

use PHPUnit\Framework\TestCase;

class CommentModelTest extends TestCase
{

    protected static $di;

    public function setUp()
    {
        self::$di  = new \Anax\DI\DIFactoryConfig(__DIR__."/../test_di.php");
    }

    public function testEmailAttributeExists(): void
    {
        $this->assertObjectHasAttribute(
            "email",
            self::$di->get("comment")->showOnePost(1)
        );
    }

    public function testViewAll(): void
    {
        $this->assertCount(
            3, //Check if there is 3 comments.
            self::$di->get("comment")->viewAll()
        );
    }
}
