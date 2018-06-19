<?php

$unAuthText = "You are not authorized to do this.";
$unAuth = sprintf('<p>%s</p><a class="btn btn-outline-primary" href="%s">Go back</a>', $unAuthText, $this->di->get("url")->create("user"));

if ($this->di->get("session")->has("userLoggedIn")) {
    $user = $this->di->get("userController")->getIDByUser($this->di->get("session")->get("userLoggedIn"));

    if ($user->adminflag == 1) {
        echo '<h2>Add user</h2>';
        echo sprintf('<p><a href="%s">Create user</a></p>', $this->di->get("url")->create("user/create"));

        echo '<h1>Manage users</h1>';
        echo '<table class="table">';
            echo '<tr>';
                echo '<th>Id</th>';
                echo '<th>Acronym</th>';
                echo '<th>Email</th>';
                echo '<th>Manage</<th>';
            echo '</tr>';
        foreach ($content as $item) {
            echo '<tr>';
                echo '<td>';
                    echo sprintf('<a href="%s">%s</a>', $this->di->get("url")->create("user/update/{$item->id}"), $item->id);
                echo '</td>';
                echo sprintf('<td>%s</td>', $item->acronym);
                echo sprintf('<td>%s</td>', $item->email);
                echo sprintf('<td><a class="btn btn-outline-danger" href="%s">Delete</a></td>', $this->di->get("url")->create("user/delete/".$item->id));
            echo '</tr>';
        }
        echo '</table>';

        echo sprintf('<a class="btn btn-outline-primary" href="%s">Go back</a>', $this->di->get("url")->create("user"));
    } else {
        echo $unAuth;
    }
} else {
    echo $unAuth;
}
