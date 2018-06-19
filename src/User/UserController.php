<?php

namespace Schanihbg\User;

use \Anax\Configure\ConfigureInterface;
use \Anax\Configure\ConfigureTrait;
use \Anax\DI\InjectionAwareInterface;
use \Anax\Di\InjectionAwareTrait;
use \Schanihbg\User\HTMLForm\UserLoginForm;
use \Schanihbg\User\HTMLForm\CreateUserForm;
use \Schanihbg\User\HTMLForm\UpdateUserForm;

/**
 * A controller class.
 */
class UserController implements
    ConfigureInterface,
    InjectionAwareInterface
{
    use ConfigureTrait,
        InjectionAwareTrait;



    /**
     * @var $data description
     */
    //private $data;



    /**
     * Description.
     *
     * @param datatype $variable Description
     *
     * @throws Exception
     *
     * @return void
     */
    public function getIndex()
    {
        $title      = "User profile";
        $view       = $this->di->get("view");
        $pageRender = $this->di->get("pageRender");

        $view->add("user/profile");

        $pageRender->renderPage(["title" => $title]);
    }



    /**
     * Description.
     *
     * @param datatype $variable Description
     *
     * @throws Exception
     *
     * @return void
     */
    public function getPostLogin()
    {
        $title      = "A login page";
        $view       = $this->di->get("view");
        $pageRender = $this->di->get("pageRender");
        $form       = new UserLoginForm($this->di);

        $form->check();

        $data = [
            "content" => $form->getHTML(),
        ];

        $view->add("default2/article", $data);

        $pageRender->renderPage(["title" => $title]);
    }



    /**
     * Description.
     *
     * @param datatype $variable Description
     *
     * @throws Exception
     *
     * @return void
     */
    public function getPostCreateUser()
    {
        $title      = "A create user page";
        $view       = $this->di->get("view");
        $pageRender = $this->di->get("pageRender");
        $form       = new CreateUserForm($this->di);

        $form->check();

        $data = [
            "content" => $form->getHTML(),
        ];

        $view->add("default2/article", $data);

        $pageRender->renderPage(["title" => $title]);
    }

    /**
     * Handler with form to update a user.
     *
     * @return void
     */
    public function getPostUpdateUser($id)
    {
        $title      = "Update an item";
        $view       = $this->di->get("view");
        $pageRender = $this->di->get("pageRender");
        $form       = new UpdateUserForm($this->di, $id);

        $form->check();

        $data = [
            "form" => $form->getHTML(),
            "id" => $id,
        ];

        $view->add("user/update", $data);

        $pageRender->renderPage(["title" => $title]);
    }

    /**
     * Description.
     *
     * @param datatype $variable Description
     *
     * @throws Exception
     *
     * @return void
     */
    public function loginUser($input)
    {
        $this->di->get("session")->set("userLoggedIn", $input);
    }

    /**
     * Description.
     *
     * @param datatype $variable Description
     *
     * @throws Exception
     *
     * @return void
     */
    public function logoutUser()
    {
        $title      = "Logout page";
        $view       = $this->di->get("view");
        $pageRender = $this->di->get("pageRender");

        $view->add("user/logout");

        $pageRender->renderPage(["title" => $title]);
    }

    /**
     * Description.
     *
     * @param datatype $variable Description
     *
     * @throws Exception
     *
     * @return void
     */
    public function getIDByUser($userInput)
    {
        $user = new User();
        $user->setDb($this->di->get("database"));
        $user->find("acronym", $userInput);

        return $user;
    }

    /**
     * Description.
     *
     * @param datatype $variable Description
     *
     * @throws Exception
     *
     * @return void
     */
    public function adminControl()
    {
        $title      = "Admin Control";
        $view       = $this->di->get("view");
        $pageRender = $this->di->get("pageRender");

        $sql = "SELECT * FROM `User`";

        $data = $this->di->get("database")->executeFetchAll($sql);

        $view->add("user/admin", ["content" => $data]);

        $pageRender->renderPage(["title" => $title]);
    }

    /**
     * Delete user
     *
     * @return void
     */
    public function removeUser($id)
    {
        $sql = "DELETE FROM `User` WHERE id = ?";
        $this->di->get("database")->execute($sql, [$id]);
        $this->di->get("response")->redirect($this->di->get("url")->create("user/admin"));
    }
}
