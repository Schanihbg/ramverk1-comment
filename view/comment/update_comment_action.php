<?php
    $sql = "UPDATE ramverk1_comment SET comment = ? WHERE id = ?";

    $this->di->get("database")->execute($sql, [$_POST["comment_area"], $_POST["id"]]);
    $this->di->get("response")->redirect($this->di->get("url")->create("comment"));
