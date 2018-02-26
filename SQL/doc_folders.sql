CREATE TABLE `lyptonDoc`.`doc_folders` (
`fid` INT(11) NOT NULL COMMENT 'folder''s id' ,
`uid` INT(11) NOT NULL COMMENT 'user''s id' ,
`pid` INT(11) NOT NULL COMMENT 'project''s id' ,
`folderName` VARCHAR(32) NOT NULL COMMENT 'the name of the folder' )
ENGINE = InnoDB CHARACTER SET utf8 COLLATE utf8_general_ci;

ALTER TABLE `doc_folders`
  ADD PRIMARY KEY (`fid`),
  ADD KEY `uid` (`uid`);

  ALTER TABLE `doc_folders`
    MODIFY `fid` int(11) NOT NULL AUTO_INCREMENT COMMENT 'folder''s id';

ALTER TABLE `doc_folders` ADD `level` INT(2) NOT NULL COMMENT '0 一级目录 1 二级目录' AFTER `folderName`;

ALTER TABLE `doc_folders` ADD `parentFid` INT(11) NOT NULL DEFAULT '0' COMMENT '父级pid' AFTER `pid`;
ALTER TABLE `doc_folders` CHANGE `pid` `proid` INT(11) NOT NULL COMMENT 'project''s id';
ALTER TABLE `doc_folders` DROP `level`;