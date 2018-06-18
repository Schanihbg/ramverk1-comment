<?php

namespace Schanihbg\Comment;

use \Anax\DI\InjectionAwareInterface;
use \Anax\DI\InjectionAwareTrait;

/**
 * A controller for the REM Server.
 *
 * @SuppressWarnings(PHPMD.ExitExpression)
 */
class CommentController implements InjectionAwareInterface
{
    use InjectionAwareTrait;


    /**
     * View all posts
     *
     * @return void
     */
    public function viewAll()
    {
        $data = $this->di->get("comment")->viewAll();

        $this->di->get("view")->add("comment/main", ["content" => $data]);
        $this->di->get("pageRender")->renderPage(["title" => "All comments"]);
    }

    /**
     * New post
     *
     * @return void
     */
    public function newPost()
    {
        $this->di->get("view")->add("comment/new_comment");
        $this->di->get("pageRender")->renderPage(["title" => "New comment"]);
    }

    /**
     * New post page
     *
     * @return void
     */
    public function newPostAction()
    {
        $this->di->get("view")->add("comment/new_comment_action");
        $this->di->get("pageRender")->renderPage(["title" => "New comment action"]);
    }

    /**
     * Show one post
     *
     * @return void
     */
    public function showOnePost($id)
    {
        $data = $this->di->get("comment")->showOnePost($id);

        $this->di->get("view")->add("comment/post", ["content" => $data]);
        $this->di->get("pageRender")->renderPage(["title" => "Post id ".$id]);
    }

    /**
     * Edit post
     *
     * @return void
     */
    public function editPost($id)
    {
        $data = $this->di->get("comment")->editPost($id);

        $this->di->get("view")->add("comment/update_comment", ["content" => $data]);
        $this->di->get("pageRender")->renderPage(["title" => "Update comment"]);
    }

    /**
     * Edit post action
     *
     * @return void
     */
    public function editPostAction()
    {
        $this->di->get("view")->add("comment/update_comment_action");
        $this->di->get("pageRender")->renderPage(["title" => "Update comment action"]);
    }

    /**
     * Remove post
     *
     * @return void
     */
    public function removePost($id)
    {
        $this->di->get("comment")->removePost($id);
    }
}
