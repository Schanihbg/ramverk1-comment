<?php
$this->di->get("session")->delete("userLoggedIn");
$this->di->get("response")->redirect("user");
