<?php
/**
 * Configuration file for routes.
 */
return [
    // Load these routefiles in order specified and optionally mount them
    // onto a base route.
    "routeFiles" => [
        [
            // Comment
            "mount" => "comment",
            "file" => __DIR__ . "/route/comment.php",
        ],
        [
            // Add routes from userController and mount on user/
            "mount" => "user",
            "file" => __DIR__ . "/route/userController.php",
        ],
    ],

];
