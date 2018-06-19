DROP TABLE IF EXISTS ramverk1_comment;
CREATE TABLE `ramverk1_comment` (
    `id` INTEGER PRIMARY KEY AUTO_INCREMENT NOT NULL,
    `email` varchar(45) DEFAULT NULL,
    `comment` varchar(255) DEFAULT NULL
) ENGINE INNODB CHARACTER SET utf8 COLLATE utf8_swedish_ci;
