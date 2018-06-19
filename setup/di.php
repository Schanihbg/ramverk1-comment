<?php
/**
 * Configuration file for DI container.
 */
return [

    // Services to add to the container.
    "services" => [
        "comment" => [
            "shared" => true,
            "callback" => function () {
                $comment = new \Schanihbg\Comment\CommentModel();
                $comment->injectSession($this->get("session"));
                $comment->setDI($this);
                return $comment;
            }
        ],
        "commentController" => [
            "shared" => false,
            "callback" => function () {
                $commentController = new \Schanihbg\Comment\CommentController();
                $commentController->setDI($this);
                return $commentController;
            }
        ],
        "gravatar" => [
            "shared" => true,
            "callback" => function () {
                $gravatar = new \Schanihbg\Gravatar\GravatarModel();
                return $gravatar;
            }
        ],
        "gravatarController" => [
            "shared" => false,
            "callback" => function () {
                $gravatarController = new \Schanihbg\Gravatar\GravatarController();
                $gravatarController->setDI($this);
                return $gravatarController;
            }
        ],
        "database" => [
            "shared" => true,
            "callback" => function () {
                $database = new \Anax\Database\DatabaseQueryBuilder();
                $database->configure("database.php");
                $database->connect();
                return $database;
            }
        ],
        "userController" => [
            "shared" => true,
            "callback" => function () {
                $obj = new \Schanihbg\User\UserController();
                $obj->setDI($this);
                return $obj;
            }
        ],
    ],
];
