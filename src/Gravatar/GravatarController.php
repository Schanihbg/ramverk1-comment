<?php

namespace Schanihbg\Gravatar;

use \Anax\DI\InjectionAwareInterface;
use \Anax\DI\InjectionAwareTrait;

/**
 * A controller for the Gravatar.
 *
 * @SuppressWarnings(PHPMD.ExitExpression)
 */
class GravatarController implements InjectionAwareInterface
{
    use InjectionAwareTrait;

    /**
     * Remove post
     *
     * @return void
     */
    public function getGravatar($email, $size = 80, $dImageset = 'mm', $rating = 'g', $img = false, $atts = array())
    {
        return $this->di->get("gravatar")->getGravatar($email, $size, $dImageset, $rating, $img, $atts);
    }
}
