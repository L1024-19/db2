/*
 Navicat MySQL Data Transfer

 Source Server         : localhost_3306
 Source Server Type    : MySQL
 Source Server Version : 100137
 Source Host           : localhost:3306
 Source Schema         : db2

 Target Server Type    : MySQL
 Target Server Version : 100137
 File Encoding         : 65001

 Date: 2/12/2020 22:55:30
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;


DROP TABLE IF EXISTS `enroll`;
DROP TABLE IF EXISTS `enroll2`;
DROP TABLE IF EXISTS `assign`;
DROP TABLE IF EXISTS `mentors`;
DROP TABLE IF EXISTS `mentees`;
DROP TABLE IF EXISTS `material`;
DROP TABLE IF EXISTS `meetings`;
DROP TABLE IF EXISTS `time_slot`;
DROP TABLE IF EXISTS `groups`;
DROP TABLE IF EXISTS `admins`;
DROP TABLE IF EXISTS `students`;
DROP TABLE IF EXISTS `parents`;
DROP TABLE IF EXISTS `users`;

-- ----------------------------
-- Table structure for users
-- ----------------------------

CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `phone` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for parents
-- ----------------------------

CREATE TABLE `parents` (
  `parent_id` int(11) NOT NULL,
  PRIMARY KEY (`parent_id`),
  CONSTRAINT `parent_user` FOREIGN KEY (`parent_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for students
-- ----------------------------

CREATE TABLE `students` (
  `student_id` int(11) NOT NULL,
  `grade` int(11) DEFAULT NULL,
  `parent_id` int(11) NOT NULL,
  PRIMARY KEY (`student_id`),
  KEY `student_parent` (`parent_id`),
  CONSTRAINT `student_user` FOREIGN KEY (`student_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `student_parent` FOREIGN KEY (`parent_id`) REFERENCES `parents` (`parent_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


-- ----------------------------
-- Table structure for admins
-- ----------------------------

CREATE TABLE `admins` (
  `admin_id` int(11) NOT NULL,
  PRIMARY KEY (`admin_id`),
  CONSTRAINT `admins_user` FOREIGN KEY (`admin_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


-- ----------------------------
-- Table structure for groups
-- ----------------------------

CREATE TABLE `groups` (
  `group_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` int(11) DEFAULT NULL,
  `mentor_grade_req` int(11) DEFAULT NULL,
  `mentee_grade_req` int(11) DEFAULT NULL,
  PRIMARY KEY (`group_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


-- ----------------------------
-- Table structure for time_slot
-- ----------------------------

CREATE TABLE `time_slot` (
  `time_slot_id` int(11) NOT NULL AUTO_INCREMENT,
  `day_of_the_week` varchar(255) NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  PRIMARY KEY (`time_slot_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for meetings
-- ----------------------------

CREATE TABLE `meetings` (
  `meet_id` int(11) NOT NULL AUTO_INCREMENT,
  `meet_name` varchar(255) NOT NULL,
  `date` date DEFAULT NULL,
  `time_slot_id` int(11) NOT NULL,
  `capacity` int(11) NOT NULL,
  `announcement` varchar(255) DEFAULT NULL,
  `group_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`meet_id`),
  KEY `meeting_group` (`group_id`),
  KEY `meeting_time_slot` (`time_slot_id`),
  CONSTRAINT `meeting_group` FOREIGN KEY (`group_id`) REFERENCES `groups` (`group_id`) ON DELETE CASCADE,
  CONSTRAINT `meeting_time_slot` FOREIGN KEY (`time_slot_id`) REFERENCES `time_slot` (`time_slot_id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=100 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for material
-- ----------------------------

CREATE TABLE `material` (
  `material_id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `author` varchar(255) DEFAULT NULL,
  `type` varchar(255) NOT NULL,
  `url` varchar(255) DEFAULT NULL,
  `assigned_date` date NOT NULL,
  `notes` text,
  PRIMARY KEY (`material_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for mentees
-- ----------------------------

CREATE TABLE `mentees` (
  `mentee_id` int(11) NOT NULL,
  PRIMARY KEY (`mentee_id`),
  CONSTRAINT `mentee_student` FOREIGN KEY (`mentee_id`) REFERENCES `students` (`student_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for mentors
-- ----------------------------

CREATE TABLE `mentors` (
  `mentor_id` int(11) NOT NULL,
  PRIMARY KEY (`mentor_id`),
  CONSTRAINT `mentor_student` FOREIGN KEY (`mentor_id`) REFERENCES `students` (`student_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for enroll
-- ----------------------------

CREATE TABLE `enroll` (
  `meet_id` int(11) NOT NULL,
  `mentee_id` int(11) NOT NULL,
  PRIMARY KEY (`meet_id`,`mentee_id`),
  KEY `enroll_mentee` (`mentee_id`),
  CONSTRAINT `enroll_mentee` FOREIGN KEY (`mentee_id`) REFERENCES `mentees` (`mentee_id`) ON DELETE CASCADE,
  CONSTRAINT `enroll_meetings` FOREIGN KEY (`meet_id`) REFERENCES `meetings` (`meet_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for enroll2
-- ----------------------------

CREATE TABLE `enroll2` (
  `meet_id` int(11) NOT NULL,
  `mentor_id` int(11) NOT NULL,
  PRIMARY KEY (`meet_id`,`mentor_id`),
  KEY `enroll2_mentor` (`mentor_id`),
  CONSTRAINT `enroll2_mentor` FOREIGN KEY (`mentor_id`) REFERENCES `mentors` (`mentor_id`) ON DELETE CASCADE,
  CONSTRAINT `enroll2_meetings` FOREIGN KEY (`meet_id`) REFERENCES `meetings` (`meet_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for assign
-- ----------------------------

CREATE TABLE `assign` (
  `meet_id` int(11) NOT NULL,
  `material_id` int(11) NOT NULL,
  PRIMARY KEY (`meet_id`,`material_id`),
  KEY `assign_material` (`material_id`),
  KEY `assign_meetings` (`meet_id`),
  CONSTRAINT `assign_material` FOREIGN KEY (`material_id`) REFERENCES `material` (`material_id`) ON DELETE CASCADE,
  CONSTRAINT `assign_meetings` FOREIGN KEY (`meet_id`) REFERENCES `meetings` (`meet_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

SET FOREIGN_KEY_CHECKS = 1;

INSERT INTO `users` (`id`, `email`, `password`, `name`, `phone`) VALUES
(1, 'student1', '1', 'Haya Griffiths', NULL),
(2, 'student2', '2', 'Oran Stuart', NULL),
(3, 'student3', '3', 'Charly Bean', NULL),
(4, 'student4', '4', 'Hareem Patterson', NULL),
(5, 'student5', '5', 'Sabiha Valentine', NULL),
(6, 'student6', '6', 'Jordi Begum', NULL),
(7, 'student7', '7', 'Reo Bevan', NULL),
(8, 'student8', '8', 'Kloe Wallace', NULL),
(9, 'student9', '9', 'Harrison Gardiner', NULL),
(10, 'student10', '10', 'Cameron Battle', NULL),
(11, 'student11', '11', 'Phoenix Gilmore', NULL),
(12, 'student12', '12', 'Kaylee Orozco', NULL),
(13, 'student13', '13', 'Ayse Perez', NULL),
(14, 'student14', '14', 'Abdul Barrera', NULL),
(15, 'student15', '15', 'Macauley Gill', NULL),
(16, 'student16', '16', 'Eiliyah Valentine', NULL),
(17, 'student17', '17', 'Maureen Sharples', NULL),
(18, 'student18', '18', 'Shoaib Roberson', NULL),
(19, 'student19', '19', 'Tashan Hopper', NULL),
(20, 'student20', '20', 'Talha Mcgowan', NULL),
(21, 'parent1', '1', 'Jerome Brook', NULL),
(22, 'parent2', '2', 'Maya Gray', NULL),
(23, 'parent3', '3', 'Rohan Bond', NULL),
(24, 'parent4', '4', 'Cavan Morrow', NULL),
(25, 'parent5', '5', 'Bertram Murphy', NULL),
(26, 'parent6', '6', 'Kiefer Cannon', NULL),
(27, 'parent7', '7', 'Layan Bonilla', NULL),
(28, 'parent8', '8', 'Mia Khalifa', NULL),
(29, 'parent9', '9', 'Grace Mccartney', NULL),
(30, 'parent10', '10', 'Donald Trump', NULL),
(31, 'admin1', '1', 'Frank Hull', NULL),
(32, 'admin2', '2', 'Heena Glass', NULL),
(33, 'admin3', '3', 'Sinead Kaufman', NULL),
(34, 'admin4', '4', 'Jasleen Hamer', NULL),
(35, 'admin5', '5', 'Jayce Cartwright', NULL),
(36, 'admin6', '6', 'Shona Delaney', NULL),
(37, 'admin7', '7', 'Joseph Joestar', NULL),
(38, 'admin8', '8', 'Jotaro Kujo', NULL),
(39, 'admin9', '9', 'Josuke Higashikata', NULL),
(40, 'admin10', '10', 'Aniqa Barton', NULL);

INSERT INTO `parents` (`parent_id`) VALUES
(21),
(22),
(23),
(24),
(25),
(26),
(27),
(28),
(29),
(30);

INSERT INTO `students` (`student_id`, `grade`, `parent_id`) VALUES
(1, 6, 21),
(2, 7, 22),
(3, 8, 23),
(4, 9, 24),
(5, 10, 25),
(6, 11, 26),
(7, 12, 27),
(8, 6, 28),
(9, 7, 29),
(10, 8, 30),
(11, 9, 21),
(12, 10, 22),
(13, 11, 23),
(14, 12, 24),
(15, 9, 25);

INSERT INTO `admins` (`admin_id`) VALUES
(31),
(32),
(33),
(34),
(35),
(36),
(37),
(38),
(39),
(40);

INSERT INTO `groups` (`group_id`, `name`, `description`, `mentor_grade_req`, `mentee_grade_req`) VALUES
(1, 'Group 6', 6, 9, null),
(2, 'Group 7', 7, 10, null),
(3, 'Group 8', 8, 11, null),
(4, 'Group 9', 9, 12, 6),
(5, 'Group 10', 10, null, 7),
(6, 'Group 11', 11, null, 8),
(7, 'Group 12', 12, null, 9);

INSERT INTO `time_slot` (`time_slot_id`, `day_of_the_week`, `start_time`, `end_time`) VALUES
(1, 'Monday', '12:00:00', '13:00:00'),
(2, 'Tuesday', '13:00:00', '14:00:00'),
(3, 'Wednesday', '14:00:00', '15:00:00'),
(4, 'Thursday', '15:00:00', '16:00:00'),
(5, 'Friday', '16:00:00', '17:00:00'),
(6, 'Saturday', '17:00:00', '18:00:00'),
(7, 'Sunday', '18:00:00', '19:00:00'),
(8, 'Monday', '19:00:00', '20:00:00'),
(9, 'Tuesday', '20:00:00', '21:00:00'),
(10, 'Wednesday', '21:00:00', '22:00:00');

INSERT INTO `meetings` (`meet_id`, `meet_name`, `date`, `time_slot_id`, `capacity`, `announcement`, `group_id`) VALUES
(1, 'Database I', '2019-03-27', 1, 9, 'Noobs.', 1),
(2, 'Database II', '2019-03-27', 2, 9, 'Pros.', 2),
(3, 'Assembly Language', '2019-03-27', 3, 9, 'The dow jones is falling.', 3),
(4, 'Logic Design', '2019-03-27', 4, 9, 'The snp is falling.', 4),
(5, 'Machine Learning', '2019-03-27', 5, 9, 'The hang seng index is falling.', 5),
(6, 'Graphical User Interface I', '2019-03-27', 6, 9, 'Buy huami.', 6),
(7, 'Artificial Intelligence', '2019-03-27', 7, 9, 'Huami is a growth stock.', 7),
(8, 'Computer Architecture', '2019-03-27', 8, 9, 'Long huami.', 1),
(9, 'Computing I', '2019-03-27', 9, 9, 'Huami huami.', 2),
(10, 'Calculus X', '2019-03-27', 10, 9, 'Omegalul announcement.', 3);

INSERT INTO `material` (`material_id`, `title`, `author`, `type`, `url`, `assigned_date`, `notes`) VALUES
(1, 'Betting the Sinner', 'Ninja','book', 'www.ninja.com', '2019-02-26', 'Read the thing, jesus.'),
(2, 'The Wifes Workshop', 'John Wick','book', 'www.johnwick.com', '2019-02-26', 'ISTG.'),
(3, 'Atomic Killing', 'Boch Honda','book', 'www.bochhonda.com', '2019-02-26', 'Listen to me.'),
(4, 'The Likeness of Emily', 'Toyota Camry','book', 'www.toyotacmary.com', '2019-02-26', 'No talking.'),
(5, 'Sacred Wings', 'Fake Guy','book', 'www.fakeguy.com', '2019-02-26', 'Yee Haw.'),
(6, 'The Library of London', 'Illenium','book', 'www.illenium.com', '2019-02-26', 'Party up.'),
(7, 'Free Bargains', 'TylerOne','book', 'www.tylerone.com', '2019-02-26', 'Anyone got that good stuff.'),
(8, 'Moments in Love', 'Faker','book', 'www.faker.com', '2019-02-26', 'What are notes.'),
(9, 'Dreaming Paradise', 'John Schmoop','book', 'www.johnschmoop.com', '2019-02-26', 'Google Pixel (;.'),
(10, 'The Bards Dancer', 'Fake News','book', 'www.fakenews.com', '2019-02-26', 'Hee hee.');

INSERT INTO `mentees` (`mentee_id`) VALUES
(1),
(2),
(3),
(4),
(8),
(9),
(10),
(11),
(15);

INSERT INTO `mentors` (`mentor_id`) VALUES
(4),
(5),
(6),
(7),
(11),
(12),
(13),
(14),
(15);

INSERT INTO `enroll` (`meet_id`, `mentee_id`) VALUES
(1, 1),
(2, 2),
(3, 3),
(4, 4),
(5, 8),
(6, 9),
(7, 10),
(8, 11),
(9, 15);

INSERT INTO `enroll2` (`meet_id`, `mentor_id`) VALUES
(1, 4),
(2, 5),
(3, 6),
(4, 7),
(5, 11),
(6, 12),
(7, 12),
(8, 14),
(9, 15);

INSERT INTO `assign` (`meet_id`, `material_id`) VALUES
(1, 1),
(2, 2),
(3, 3),
(4, 4),
(5, 5),
(6, 6),
(7, 7),
(8, 8),
(9, 9),
(10, 10);