<?php

namespace Schanihbg\Comment;

use \Anax\DI\InjectionAwareInterface;
use \Anax\DI\InjectionAwareTrait;
use \Anax\Configure\ConfigureInterface;
use \Anax\Configure\ConfigureTrait;

/**
 * REM Server.
 */
class CommentModel implements ConfigureInterface, InjectionAwareInterface
{
    use ConfigureTrait;
    use InjectionAwareTrait;


    /**
     * @var array $session inject a reference to the session.
     */
    private $session;



    /**
     * @var string $key to use when storing in session.
     */
    const KEY = "comment";



    /**
     * Inject dependency to $session..
     *
     * @param array $session object representing session.
     *
     * @return self
     */
    public function injectSession($session)
    {
        $this->session = $session;
        return $this;
    }


    /**
     * View all posts
     *
     * @return void
     */
    public function viewAll()
    {
        $sql = "SELECT * FROM `ramverk1_comment`";

        return $this->di->get("database")->executeFetchAll($sql);
    }

    /**
     * Show one post
     *
     * @return void
     */
    public function showOnePost($id)
    {
        $sql = "SELECT * FROM ramverk1_comment where id = ?";

        return $this->di->get("database")->executeFetch($sql, [$id]);
    }

    /**
     * Edit post
     *
     * @return void
     */
    public function editPost($id)
    {
        $sql = "SELECT * FROM ramverk1_comment where id = ?";

        return $this->di->get("database")->executeFetch($sql, [$id]);
    }

    /**
     * Delete post
     *
     * @return void
     */
    public function removePost($id)
    {
        $sql = "DELETE FROM ramverk1_comment WHERE id = ?";
        $this->di->get("database")->execute($sql, [$id]);
        $this->di->get("response")->redirect($this->di->get("url")->create("comment"));
    }
}
