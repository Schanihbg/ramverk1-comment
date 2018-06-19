<?php

if ($this->di->get("session")->has("userLoggedIn")) {
    $user = $this->di->get("userController")->getIDByUser($this->di->get("session")->get("userLoggedIn"));

    $picture = $this->di->get("gravatarController")->getGravatar($user->email, 256);
    echo '<div class="card" style="width: 256px;">';
    echo sprintf('<img src="%s" alt="Gravatar picture">', $picture);
    echo sprintf('<p class="text-center">%s</p>', $user->email);
    echo '</div>';
    echo '<br>';

    echo sprintf('Logged in as: %s <br>', $this->di->get("session")->get("userLoggedIn"));
    echo sprintf('Your ID is: %s', $user->id);

    echo '<br><br>';
    echo sprintf('<a class="btn btn-outline-primary" href="%s">Edit user</a>', $this->di->get("url")->create("user/update/".$user->id));

    if ($user->adminflag == 1) {
        echo sprintf('<a class="btn btn-outline-primary" href="%s">Admin panel</a>', $this->di->get("url")->create("user/admin/"));
    }

    echo sprintf('<a class="btn btn-outline-danger" href="%s">Logout</a>', $this->di->get("url")->create("user/logout"));
} else {
    echo sprintf('You are not logged in, click here to <a href="%s">login<a/>', $this->di->get("url")->create("user/login"));
    echo '<br>';
    echo sprintf('To create a user, click <a href="%s">here<a/>', $this->di->get("url")->create("user/create"));
}
