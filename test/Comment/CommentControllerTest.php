<?php
namespace Schanihbg\Comment;

use PHPUnit\Framework\TestCase;

class CommentControllerTest extends TestCase
{
    public function testCanBeUsedAsString(): void
    {
        $this->assertEquals(
            'user@example.com', Email::fromString('user@example.com')
        );
    }
}
