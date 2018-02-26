
CREATE TABLE IF NOT EXISTS `doc_pages` (
  `pid` int(11) NOT NULL COMMENT 'page''s id',
  `uid` int(11) NOT NULL COMMENT 'page''s host''s uid',
  `content` text NOT NULL,
  `createTime` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `doc_pages`
--
ALTER TABLE `doc_pages`
  ADD PRIMARY KEY (`pid`),
  ADD KEY `uid` (`uid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `doc_pages`
--
ALTER TABLE `doc_pages`
  MODIFY `pid` int(11) NOT NULL AUTO_INCREMENT COMMENT 'page''s id';


ALTER TABLE `doc_pages` ADD `htmlContent` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL AFTER `content`;

ALTER TABLE `doc_pages` ADD `title` VARCHAR(64) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL AFTER `uid`;

ALTER TABLE `doc_pages` ADD `fidMain` INT(11) NOT NULL COMMENT 'the first directory' AFTER `uid`;
ALTER TABLE `doc_pages` ADD `fidSub` INT(11) NOT NULL COMMENT 'sub directory id' AFTER `fidMain`;



ALTER TABLE `doc_pages` CHANGE `pid` `paid` INT(11) NOT NULL AUTO_INCREMENT COMMENT 'page''s id';
ALTER TABLE `doc_pages` ADD `proid` INT(11) NOT NULL COMMENT 'project id' AFTER `uid`;


ALTER TABLE `doc_pages` DROP `fidMain`;
ALTER TABLE `doc_pages` DROP `fidSub`;

ALTER TABLE `doc_pages` ADD `parentFid` INT NOT NULL AFTER `proid`;




