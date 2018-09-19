-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 10, 2018 at 06:13 PM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `cti`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `admin_id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(50) NOT NULL,
  `fname` varchar(50) NOT NULL,
  `mname` varchar(50) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `gender` varchar(50) NOT NULL,
  `dob` datetime NOT NULL,
  `image` blob NOT NULL,
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`admin_id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `email`, `fname`, `mname`, `lname`, `phone`, `gender`, `dob`, `image`, `created_date`) VALUES
(1, 'admin@gmail.com', 'Administrator', 'AA', 'Admin', '+254711111111', 'Male', '2018-06-14 00:00:00', 0x72616e6765332e6a7067, '2018-06-07 10:46:15');

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE IF NOT EXISTS `countries` (
  `country_code` varchar(50) NOT NULL,
  `country_name` varchar(50) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`country_code`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`country_code`, `country_name`, `created_date`) VALUES
('+248', 'Sechelles', '2018-06-06 12:15:02'),
('+250', 'Rwanda', '2018-06-04 20:10:28'),
('+251', 'Ethiopia', '2018-06-06 12:15:02'),
('+252', 'Somalia', '2018-06-06 12:15:02'),
('+253', 'Djibouti', '2018-06-06 12:15:02'),
('+254', 'Kenya', '2018-06-04 20:10:28'),
('+255', 'Tanzania', '2018-06-04 20:10:28'),
('+256', 'Uganda', '2018-06-04 20:10:28'),
('+257', 'Burundi', '2018-06-04 20:10:28'),
('+265', 'Malawi', '2018-06-06 12:15:02'),
('+291', 'Eritrea', '2018-06-06 12:15:02');

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE IF NOT EXISTS `course` (
  `course_id` int(11) NOT NULL AUTO_INCREMENT,
  `prog_id` int(11) NOT NULL,
  `course_name` varchar(50) NOT NULL,
  `course_description` text NOT NULL,
  `duration` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `time_stamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`course_id`),
  KEY `FK_course` (`prog_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`course_id`, `prog_id`, `course_name`, `course_description`, `duration`, `username`, `time_stamp`) VALUES
(1, 1, 'Java Programming', 'Java Tutorial or Core Java Tutorial or Java Programming Tutorial is a widely used robust technology. Let''s start learning of java from basic questions like what is java tutorial, core java, where it is used, what type of applications are created in java and why use java.', 5, 'admin@gmail.com', '2018-06-06 11:21:53'),
(2, 1, 'C# Programming', 'C# tutorial provides basic and advanced concepts of C#. Our C# tutorial is designed for beginners and professionals.\n\nC# is a programming language of .Net Framework.\n\nOur C# tutorial includes all topics of C# such as first example, control statements, objects and classes, inheritance, constructor, destructor, this, static, sealed, polymorphism, abstraction, abstract class, interface, namespace, encapsulation, properties, indexer, arrays, strings, regex, exception handling, multithreading, File IO, Collections etc.', 5, 'admin@gmail.com', '2018-06-06 11:21:53');

-- --------------------------------------------------------

--
-- Table structure for table `course_objectives`
--

CREATE TABLE IF NOT EXISTS `course_objectives` (
  `objective_id` int(11) NOT NULL AUTO_INCREMENT,
  `course_id` int(11) NOT NULL,
  `objective_name` varchar(255) NOT NULL,
  `key_objective` int(11) NOT NULL,
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`objective_id`),
  KEY `FK_course_objectives` (`course_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `course_objectives`
--

INSERT INTO `course_objectives` (`objective_id`, `course_id`, `objective_name`, `key_objective`, `created_date`) VALUES
(1, 2, 'Our C# tutorial includes all topics of C# such as first example, control statements, objects and classes, inheritance, constructor, destructor, this, static, sealed, polymorphism, abstraction, abstract class, interface, namespace, encapsulation, propertie', 1, '2018-06-08 16:39:05');

-- --------------------------------------------------------

--
-- Table structure for table `course_subtopic`
--

CREATE TABLE IF NOT EXISTS `course_subtopic` (
  `subtopic_id` int(11) NOT NULL AUTO_INCREMENT,
  `topic_id` int(11) NOT NULL,
  `subtopic_name` varchar(255) NOT NULL,
  `subtopic_number` int(11) NOT NULL,
  `subtopic_content` text NOT NULL,
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`subtopic_id`),
  KEY `FK_course_subtopic` (`topic_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `course_subtopic`
--

INSERT INTO `course_subtopic` (`subtopic_id`, `topic_id`, `subtopic_name`, `subtopic_number`, `subtopic_content`, `created_date`) VALUES
(1, 1, 'History of C#', 1, '<p style="color: rgb(0, 0, 0); font-family: verdana, helvetica, arial, sans-serif; font-size: 13px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: justify; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255); text-decoration-style: initial; text-decoration-color: initial;">It is based on<span>&nbsp;</span><strong>C++ and Java</strong>, but it has many additional extensions used to perform component oriented programming approach.</p><p style="color: rgb(0, 0, 0); font-family: verdana, helvetica, arial, sans-serif; font-size: 13px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: justify; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255); text-decoration-style: initial; text-decoration-color: initial;">C# has evolved much since their first release in the year<span>&nbsp;</span><strong>2002</strong>. It was introduced with<span>&nbsp;</span><strong>.NET Framework 1.0</strong><span>&nbsp;</span>and the current version of C# is 5.0.</p><p style="color: rgb(0, 0, 0); font-family: verdana, helvetica, arial, sans-serif; font-size: 13px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: justify; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255); text-decoration-style: initial; text-decoration-color: initial;">Let''s see the important features introduced in each version of C# are given below.</p>', '2018-06-08 16:42:24'),
(2, 1, 'Others', 2, '<p style="color: rgb(0, 0, 0); font-family: verdana, helvetica, arial, sans-serif; font-size: 13px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: justify; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255); text-decoration-style: initial; text-decoration-color: initial;">C# is object oriented programming language. It provides a lot of<span>&nbsp;</span><strong>features</strong><span>&nbsp;</span>that are given below.</p><ol class="points" style="color: rgb(0, 0, 0); font-family: verdana, helvetica, arial, sans-serif; font-size: 13px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: justify; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255); text-decoration-style: initial; text-decoration-color: initial;"><li style="padding: 0.2em; line-height: 23px; color: rgb(0, 0, 0); margin-top: 4px;">Simple</li><li style="padding: 0.2em; line-height: 23px; color: rgb(0, 0, 0); margin-top: 4px;">Modern programming language</li><li style="padding: 0.2em; line-height: 23px; color: rgb(0, 0, 0); margin-top: 4px;">Object oriented</li><li style="padding: 0.2em; line-height: 23px; color: rgb(0, 0, 0); margin-top: 4px;">Type safe</li><li style="padding: 0.2em; line-height: 23px; color: rgb(0, 0, 0); margin-top: 4px;">Interoperability</li><li style="padding: 0.2em; line-height: 23px; color: rgb(0, 0, 0); margin-top: 4px;">Scalable and Updateable</li><li style="padding: 0.2em; line-height: 23px; color: rgb(0, 0, 0); margin-top: 4px;">Component oriented</li><li style="padding: 0.2em; line-height: 23px; color: rgb(0, 0, 0); margin-top: 4px;">Structured programming language</li><li style="padding: 0.2em; line-height: 23px; color: rgb(0, 0, 0); margin-top: 4px;">Rich Library</li><li style="padding: 0.2em; line-height: 23px; color: rgb(0, 0, 0); margin-top: 4px;">Fast speed</li></ol>', '2018-06-08 16:42:42');

-- --------------------------------------------------------

--
-- Table structure for table `course_topic`
--

CREATE TABLE IF NOT EXISTS `course_topic` (
  `topic_id` int(11) NOT NULL AUTO_INCREMENT,
  `course_id` int(11) NOT NULL,
  `number` int(11) NOT NULL,
  `topic_name` varchar(255) NOT NULL,
  `duration` double NOT NULL,
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`topic_id`),
  KEY `FK_course_topic` (`course_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `course_topic`
--

INSERT INTO `course_topic` (`topic_id`, `course_id`, `number`, `topic_name`, `duration`, `created_date`) VALUES
(1, 2, 1, 'Introduction', 2, '2018-06-08 16:39:59'),
(2, 2, 2, 'Control Statements', 5, '2018-06-08 16:40:22'),
(3, 2, 3, 'Arrays', 3, '2018-06-08 16:40:46'),
(4, 2, 4, 'Object Class', 5, '2018-06-08 16:41:06');

-- --------------------------------------------------------

--
-- Table structure for table `files`
--

CREATE TABLE IF NOT EXISTS `files` (
  `file_id` int(11) NOT NULL AUTO_INCREMENT,
  `subtopic_id` int(11) NOT NULL,
  `file_name` blob NOT NULL,
  `file_type` int(11) NOT NULL,
  `time_stamp` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`file_id`),
  KEY `FK_files` (`subtopic_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE IF NOT EXISTS `login` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `role` int(11) NOT NULL,
  `password` varchar(80) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_login2` (`id`,`username`),
  KEY `FK_login` (`username`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`id`, `username`, `role`, `password`) VALUES
(1, 'admin@gmail.com', 1, '1234'),
(2, 'tutor@gmail.com', 2, '1234'),
(3, 'student@gmail.com', 3, '1234');

-- --------------------------------------------------------

--
-- Table structure for table `programme`
--

CREATE TABLE IF NOT EXISTS `programme` (
  `prog_id` int(11) NOT NULL AUTO_INCREMENT,
  `prog_name` varchar(50) NOT NULL,
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`prog_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `programme`
--

INSERT INTO `programme` (`prog_id`, `prog_name`, `created_date`) VALUES
(1, 'Bsc. Computer Science', '2018-05-25 17:10:01'),
(2, 'Bsc. Criminology', '2018-05-25 17:10:01'),
(4, 'Bsc. Information Technology', '2018-06-05 03:14:34');

-- --------------------------------------------------------

--
-- Table structure for table `prog_objectives`
--

CREATE TABLE IF NOT EXISTS `prog_objectives` (
  `objective_id` int(11) NOT NULL AUTO_INCREMENT,
  `prog_id` int(11) NOT NULL,
  `objective_name` varchar(255) NOT NULL,
  `key_objective` varchar(255) NOT NULL,
  PRIMARY KEY (`objective_id`),
  KEY `FK_prog_objectives` (`prog_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE IF NOT EXISTS `questions` (
  `question_id` int(11) NOT NULL AUTO_INCREMENT,
  `test_id` int(11) NOT NULL,
  `question_description` text NOT NULL,
  `question_type` int(11) NOT NULL,
  `time_stamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`question_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`question_id`, `test_id`, `question_description`, `question_type`, `time_stamp`) VALUES
(1, 8, 'What is the meaning of Control Statements?', 2, '2018-06-10 15:37:43'),
(2, 8, 'Are you a male?', 1, '2018-06-10 15:50:35'),
(3, 8, 'Is Java an IDE?', 1, '2018-06-10 15:50:52'),
(4, 8, 'Who was the founder of Control Statements in the 20th Century?', 2, '2018-06-10 15:51:22');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE IF NOT EXISTS `student` (
  `student_id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(50) NOT NULL,
  `prog_id` int(11) NOT NULL,
  `fname` varchar(50) NOT NULL,
  `mname` varchar(50) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `gender` varchar(50) NOT NULL,
  `dob` date NOT NULL,
  `country_code` varchar(50) NOT NULL,
  `image` blob NOT NULL,
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`student_id`),
  UNIQUE KEY `email` (`email`),
  KEY `FK_student` (`country_code`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`student_id`, `email`, `prog_id`, `fname`, `mname`, `lname`, `phone`, `gender`, `dob`, `country_code`, `image`, `created_date`) VALUES
(1, 'student@gmail.com', 1, 'Ken', 'W', 'Kamau', '+254711111100', 'Male', '2018-06-13', '+254', 0x342e706e67, '2018-06-07 11:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `student_tutor_unit`
--

CREATE TABLE IF NOT EXISTS `student_tutor_unit` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `student_id` int(11) NOT NULL,
  `tutor_id` int(11) NOT NULL,
  `topic_id` int(11) NOT NULL,
  `duration` int(11) NOT NULL,
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `FK_stude_lec_unit` (`student_id`),
  KEY `FK_stude_lec_unit2` (`id`,`tutor_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `test`
--

CREATE TABLE IF NOT EXISTS `test` (
  `test_id` int(11) NOT NULL AUTO_INCREMENT,
  `test_name` varchar(100) NOT NULL,
  `course_id` int(11) NOT NULL,
  `topic_id` int(11) NOT NULL,
  `test_duration` int(11) NOT NULL,
  `time_stamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`test_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `test`
--

INSERT INTO `test` (`test_id`, `test_name`, `course_id`, `topic_id`, `test_duration`, `time_stamp`) VALUES
(7, 'Test Test2', 1, 0, 23, '2018-06-10 13:12:26'),
(8, 'Test4', 0, 2, 8, '2018-06-10 13:53:27'),
(9, 'Test topic1', 0, 4, 8, '2018-06-10 13:54:06');

-- --------------------------------------------------------

--
-- Table structure for table `tutor`
--

CREATE TABLE IF NOT EXISTS `tutor` (
  `tutor_id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(50) NOT NULL,
  `prog_id` int(11) NOT NULL,
  `fname` varchar(50) NOT NULL,
  `mname` varchar(50) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `gender` varchar(50) NOT NULL,
  `dob` datetime NOT NULL,
  `country_code` varchar(50) NOT NULL,
  `image` blob NOT NULL,
  `national_id` blob NOT NULL,
  `cv` blob NOT NULL,
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`tutor_id`),
  UNIQUE KEY `email` (`email`),
  KEY `FK_tutor` (`country_code`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `tutor`
--

INSERT INTO `tutor` (`tutor_id`, `email`, `prog_id`, `fname`, `mname`, `lname`, `phone`, `gender`, `dob`, `country_code`, `image`, `national_id`, `cv`, `created_date`) VALUES
(1, 'tutor@gmail.com', 1, 'tutor', 'tut', 'tutor', '+254788888888', 'Male', '2018-06-21 00:00:00', '+254', 0x31342e706e67, '', '', '2018-06-07 13:28:39');

-- --------------------------------------------------------

--
-- Table structure for table `tutor_inquiries`
--

CREATE TABLE IF NOT EXISTS `tutor_inquiries` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sender` varchar(50) NOT NULL,
  `receiver` varchar(50) NOT NULL,
  `message` varchar(255) NOT NULL,
  `sent_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `reply` varchar(255) DEFAULT NULL,
  `reply_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `tutor_inquiries`
--

INSERT INTO `tutor_inquiries` (`id`, `sender`, `receiver`, `message`, `sent_time`, `reply`, `reply_time`) VALUES
(2, 'tutor@gmail.com', 'Admin', 'test', '2018-06-07 20:51:05', 'rrr', '2018-06-12 00:00:00'),
(3, 'tutor@gmail.com', 'Admin', 'bbbb', '2018-06-07 20:55:31', NULL, NULL),
(5, 'tutor@gmail.com', 'Admin', 'vcvcvc', '2018-06-07 21:00:34', NULL, NULL),
(6, 'tutor@gmail.com', 'Admin', 'ttttt', '2018-06-07 21:01:27', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tutor_topic`
--

CREATE TABLE IF NOT EXISTS `tutor_topic` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tutor_id` int(11) NOT NULL,
  `topic_id` int(11) NOT NULL,
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `FK_tutor_course` (`id`,`tutor_id`),
  KEY `FK_tutor_course2` (`topic_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
