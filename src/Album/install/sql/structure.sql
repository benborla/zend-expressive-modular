--
-- Table structure for table `album`
--

CREATE TABLE `album` (
  `album_id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `album_title` varchar(80) NOT NULL,
  `album_artist` varchar(45) NOT NULL,
  `album_date_added` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;