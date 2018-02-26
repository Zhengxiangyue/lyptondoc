CREATE TABLE `lyptonDoc`.`doc_projects`
( `pid` INT(11) NOT NULL COMMENT 'project''s id' ,
`uid` INT(11) NOT NULL COMMENT 'user''s id' ,
`projectName` VARCHAR(32) NOT NULL COMMENT 'project''s name' ,
`privacy` INT(2) NOT NULL COMMENT 'the privacy of the project' )
ENGINE = InnoDB CHARACTER SET utf8 COLLATE utf8_general_ci;

ALTER TABLE `lyptonDoc`.`doc_projects` ADD PRIMARY KEY (`pid`);

ALTER TABLE `doc_projects` CHANGE `pid` `pid` INT(11) NOT NULL AUTO_INCREMENT COMMENT 'project''s id';
ALTER TABLE `doc_projects` CHANGE `pid` `proid` INT(11) NOT NULL AUTO_INCREMENT COMMENT 'project''s id';
