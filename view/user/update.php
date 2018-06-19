<?php

namespace Anax\View;

/**
 * View to create a new book.
 */
// Show all incoming variables/functions
//var_dump(get_defined_functions());
//echo showEnvironment(get_defined_vars());

// Gather incoming variables and use default values if not set
$item = isset($item) ? $item : null;

// Create urls for navigation
$urlToView = url("user");



?><h1>Update user</h1>

<?php
$user = $this->di->get("userController")->getIDByUser($this->di->get("session")->get("userLoggedIn"));

if ($user->id == $id || $user->adminflag == 1) {
    echo $form;
} else {
    echo sprintf('<p>%s</p>', "You are not authorized to do this.");
}

?>

<p>
    <a class="btn btn-outline-primary" href="<?= $urlToView ?>">Go back</a>
</p>
