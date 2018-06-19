<?php
    $user = $this->di->get("userController")->getIDByUser($this->di->get("session")->get("userLoggedIn"));

    $sql = "INSERT INTO ramverk1_comment (email, comment) VALUES (?, ?)";

    $this->di->get("database")->execute($sql, [$user->email, $_POST["comment_area"]]);

    $this->di->get("response")->redirect($this->di->get("url")->create("comment"));
