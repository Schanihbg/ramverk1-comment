<?php
foreach ($content as $key => $value) {
    echo sprintf('<a href="%s%s">Post by %s with id %s</a> <br>', $this->di->get("url")->create("comment/post\\"), $value->id, $value->email, $value->id);
}
echo "<br>";
echo sprintf('<a href="%s">Write a new comment</a>', $this->di->get("url")->create("comment/new"));
