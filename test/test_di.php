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
                $database->configure(__DIR__."/test_database.php");
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
