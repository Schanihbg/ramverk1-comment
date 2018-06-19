<?php
/**
 * Configuration file for DI container.
 */
return [

    // Services to add to the container.
    "services" => [
        "request" => [
            "shared" => true,
            "callback" => function () {
                $request = new \Anax\Request\Request();
                $request->init();
                return $request;
            }
        ],
        "response" => [
            "shared" => true,
            "callback" => function () {
                $obj = new \Anax\Response\ResponseUtility();
                $obj->setDI($this);
                return $obj;
            }
        ],
        "url" => [
            "shared" => true,
            "callback" => function () {
                $url = new \Anax\Url\Url();
                $request = $this->get("request");
                $url->setSiteUrl($request->getSiteUrl());
                $url->setBaseUrl($request->getBaseUrl());
                $url->setStaticSiteUrl($request->getSiteUrl());
                $url->setStaticBaseUrl($request->getBaseUrl());
                $url->setScriptName($request->getScriptName());
                $url->configure("url.php");
                $url->setDefaultsFromConfiguration();
                return $url;
            }
        ],
        "router" => [
            "shared" => true,
            "callback" => function () {
                $router = new \Anax\Route\Router();
                $router->setDI($this);
                $router->configure("route2.php");
                return $router;
            }
        ],
        "view" => [
            "shared" => true,
            "callback" => function () {
                $view = new \Anax\View\ViewCollection();
                $view->setDI($this);
                $view->configure("view.php");
                return $view;
            }
        ],
        "viewRenderFile" => [
            "shared" => true,
            "callback" => function () {
                $viewRender = new \Anax\View\ViewRenderFile2();
                $viewRender->setDI($this);
                return $viewRender;
            }
        ],
        "session" => [
            "shared" => true,
            "active" => true,
            "callback" => function () {
                $session = new \Anax\Session\SessionConfigurable();
                $session->start();
                return $session;
            }
        ],
        "textfilter" => [
            "shared" => true,
            "callback" => "\Anax\TextFilter\TextFilter",
        ],
        "pageRender" => [
            "shared" => true,
            "callback" => function () {
                $obj = new \Anax\Page\PageRender();
                $obj->setDI($this);
                return $obj;
            }
        ],
        "errorController" => [
            "shared" => true,
            "callback" => function () {
                $obj = new \Anax\Page\ErrorController();
                $obj->setDI($this);
                return $obj;
            }
        ],
        "debugController" => [
            "shared" => true,
            "callback" => function () {
                $obj = new \Anax\Page\DebugController();
                $obj->setDI($this);
                return $obj;
            }
        ],
        "flatFileContentController" => [
            "shared" => true,
            "callback" => function () {
                $obj = new \Anax\Page\FlatFileContentController();
                $obj->setDI($this);
                return $obj;
            }
        ],
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
                $database->configure([
                        "dsn"             => "sqlite::memory:",
                        "username"        => null,
                        "password"        => null,
                        "driver_options"  => null,
                        "fetch_mode"      => \PDO::FETCH_OBJ,
                        "table_prefix"    => null,
                        "session_key"     => "Anax\Database",

                        // True to be very verbose during development
                        "verbose"         => null,

                        // True to be verbose on connection failed
                        "debug_connect"   => true,
                    ]);
                $database->connect();

                $sql = 'CREATE TABLE `ramverk1_comment` (
                            `id` INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
                            `email` varchar(45) DEFAULT NULL,
                            `comment` varchar(255) DEFAULT NULL
                        )';
                $database->execute($sql);

                $sql = 'INSERT INTO `ramverk1_comment` (`id`, `email`, `comment`) VALUES
                        (NULL, "test@test.com", "Hello World"),
                        (NULL, "test@test.com", "Test2"),
                        (NULL, "test5@test.com", "Comment1")';

                $database->execute($sql);
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
