CREATE TABLE `lyptonDoc`.`doc_users` (
`uid` INT(11) NOT NULL AUTO_INCREMENT COMMENT 'user id' ,
`mobile` VARCHAR(15) NOT NULL COMMENT 'user''s mobile and login name' ,
`userName` VARCHAR(32) NOT NULL COMMENT 'user''s nickname' ,
`password` VARCHAR(256) NOT NULL COMMENT 'user''s password encrypted' ,
`regTime` VARCHAR(32) NOT NULL COMMENT 'user''s register time, Y-m-d H:i:s' ,
PRIMARY KEY (`uid`)
) ENGINE = InnoDB CHARACTER SET utf8 COLLATE utf8_general_ci;

ALTER TABLE `doc_users` CHANGE `mobile` `email` VARCHAR(32) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT 'user''s email and login name';
ALTER TABLE `doc_users` ADD `salt` VARCHAR(6) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL AFTER `password`;