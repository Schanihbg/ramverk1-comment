<?php
echo '<div class="card" style="width: 256px;">';
$picture = $this->di->get("gravatarController")->getGravatar($content->email, 256);
echo sprintf('<img src="%s" alt="Gravatar picture">', $picture);
echo sprintf('<p class="text-center">%s</p>', $content->email);
echo '</div>';
echo '<br>';

echo $this->di->get("textfilter")->markdown(htmlspecialchars($content->comment, ENT_QUOTES));

if ($this->di->get("session")->has("userLoggedIn")) {
    $user = $this->di->get("userController")->getIDByUser($this->di->get("session")->get("userLoggedIn"));

    echo sprintf('<a class="btn btn-outline-primary" href="%s">Go back</a>', $this->di->get("url")->create("comment"));

    if ($user->email == $content->email || $user->adminflag == 1) {
        echo sprintf('<a class="btn btn-outline-primary" href="%s">Edit</a>', $this->di->get("url")->create("comment/edit/".$content->id));
        echo sprintf('<a class="btn btn-outline-danger" href="%s">Delete</a>', $this->di->get("url")->create("comment/delete/".$content->id));
    }
}
