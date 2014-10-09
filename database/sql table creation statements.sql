#DATABASE CREATION FOR PHPMYADMIN

Command to create tables from PHPMYADMIN

SHOW CREATE TABLE X;

------------------------------------------
TABLE 1 - Feedback
------------------------------------------

CREATE TABLE `feedback` (
 `fid` int(11) NOT NULL AUTO_INCREMENT,
 `name` varchar(30) NOT NULL,
 `email` varchar(30) NOT NULL,
 `gc_text_entered` text NOT NULL,
 `gc_sentiment_entered` text NOT NULL,
 `gc_sentiment_correct_entered` text NOT NULL,
 `feedback_date` timestamp NOT NULL,
 PRIMARY KEY (`fid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1

------------------------------------------
TABLE 2 - Gurucat
------------------------------------------

CREATE TABLE `gurucat` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `text` varchar(140) NOT NULL,
 `result` varchar(11) NOT NULL,
 PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1

------------------------------------------
TABLE 3 - gurucat_history
------------------------------------------

CREATE TABLE `gurucat_history` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `text` varchar(140) NOT NULL,
 `result` varchar(11) NOT NULL,
 PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1

------------------------------------------
TABLE 4 - location
------------------------------------------

CREATE TABLE `location` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `location` varchar(30) NOT NULL,
 `count` int(11) NOT NULL,
 PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1

------------------------------------------
TABLE 5 - location_history
------------------------------------------

CREATE TABLE `location_history` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `location` varchar(30) NOT NULL,
 `count` int(11) NOT NULL,
 PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1

------------------------------------------
TABLE 6 - result
------------------------------------------

CREATE TABLE `result` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `sentiment` varchar(15) NOT NULL,
 `count` int(11) NOT NULL,
 PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1

------------------------------------------
TABLE 7 - result_history
------------------------------------------

CREATE TABLE `result_history` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `sentiment` varchar(15) NOT NULL,
 `count` int(11) NOT NULL,
 PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1

------------------------------------------
TABLE 8 - tweets
------------------------------------------

CREATE TABLE `tweets` (
 `Tweet_Number` int(10) NOT NULL AUTO_INCREMENT,
 `TweetID` text NOT NULL,
 `Query` text NOT NULL,
 `Input` int(11) NOT NULL,
 `Handle` text NOT NULL,
 `T_TimeStamp` varchar(30) NOT NULL,
 `T_Text` text NOT NULL,
 `T_Date` text NOT NULL,
 `T_Time` text NOT NULL,
 `Location` text NOT NULL,
 `Sentiment` text NOT NULL,
 `Score` float NOT NULL,
 PRIMARY KEY (`Tweet_Number`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1

------------------------------------------
TABLE 8 - tweets_history
------------------------------------------

CREATE TABLE `tweets_history` (
 `Tweet_Number` int(10) NOT NULL AUTO_INCREMENT,
 `TweetID` text NOT NULL,
 `Query` text NOT NULL,
 `Input` int(11) NOT NULL,
 `Handle` text NOT NULL,
 `T_TimeStamp` varchar(30) NOT NULL,
 `T_Date` text NOT NULL,
 `T_Time` text NOT NULL,
 `Location` text NOT NULL,
 `Sentiment` text NOT NULL,
 `Score` float NOT NULL,
 PRIMARY KEY (`Tweet_Number`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1

------------------------------------------

