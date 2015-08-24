-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: 2015-08-24 17:46:35
-- 服务器版本： 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `stu_info_man`
--
CREATE DATABASE IF NOT EXISTS `stu_info_man` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE `stu_info_man`;

-- --------------------------------------------------------

--
-- 表的结构 `courses`
--

DROP TABLE IF EXISTS `courses`;
CREATE TABLE IF NOT EXISTS `courses` (
`id` int(11) unsigned NOT NULL,
  `course_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `course_type` int(11) NOT NULL COMMENT '课程类型',
  `user_id` int(11) NOT NULL,
  `score_type` tinyint(4) NOT NULL COMMENT '成绩类型'
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- 表的结构 `course_plans`
--

DROP TABLE IF EXISTS `course_plans`;
CREATE TABLE IF NOT EXISTS `course_plans` (
`id` int(11) unsigned NOT NULL,
  `course_type` int(11) NOT NULL,
  `course_id` int(11) unsigned DEFAULT '0' COMMENT '课程代号',
  `score_type` int(11) NOT NULL DEFAULT '1',
  `user_id` int(11) NOT NULL,
  `semester_id` int(11) NOT NULL,
  `department_id` int(11) NOT NULL,
  `elective_number` int(11) DEFAULT '1',
  `implement` tinyint(4) NOT NULL DEFAULT '0' COMMENT '是否部署，0，未部署，1:已经部署但未有成绩记录，2：已部署且有成绩记录',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `note` text COLLATE utf8_unicode_ci
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 触发器 `course_plans`
--
DROP TRIGGER IF EXISTS `delete`;
DELIMITER //
CREATE TRIGGER `delete` AFTER DELETE ON `course_plans`
 FOR EACH ROW if old.score_type=1 then
delete from scores where scores.course_plan_id =old.id;
else
delete from electives where electives.course_plan_id =old.id;
end if
//
DELIMITER ;
DROP TRIGGER IF EXISTS `loguserchanged`;
DELIMITER //
CREATE TRIGGER `loguserchanged` BEFORE UPDATE ON `course_plans`
 FOR EACH ROW if new.user_id!=old.user_id then
set new.note=concat(old.note,NOW(),'+',old.user_id,'&');
end if
//
DELIMITER ;

-- --------------------------------------------------------

--
-- 表的结构 `departments`
--

DROP TABLE IF EXISTS `departments`;
CREATE TABLE IF NOT EXISTS `departments` (
`id` int(10) unsigned NOT NULL,
  `dept_number` varchar(10) NOT NULL COMMENT '班级代号',
  `dept_name` char(20) NOT NULL,
  `year_in` year(4) DEFAULT NULL,
  `year_graduate` year(4) DEFAULT NULL,
  `parent_id` int(10) unsigned DEFAULT NULL,
  `lft` int(11) NOT NULL DEFAULT '0',
  `rght` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=102 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `electives`
--

DROP TABLE IF EXISTS `electives`;
CREATE TABLE IF NOT EXISTS `electives` (
`id` int(11) NOT NULL,
  `dept_number` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `stu_number` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `course_id` int(11) NOT NULL,
  `course_type` int(11) NOT NULL,
  `course_plan_id` int(11) NOT NULL,
  `lesson_number` tinyint(4) DEFAULT NULL,
  `result` varchar(4) COLLATE utf8_unicode_ci NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4636 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- 表的结构 `scores`
--

DROP TABLE IF EXISTS `scores`;
CREATE TABLE IF NOT EXISTS `scores` (
`id` int(10) unsigned NOT NULL,
  `course_plan_id` int(10) unsigned NOT NULL COMMENT '课程代号',
  `dept_number` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `stu_number` varchar(10) COLLATE utf8_unicode_ci NOT NULL COMMENT '学号',
  `regular` smallint(6) NOT NULL COMMENT '平时成绩',
  `midterm` smallint(6) NOT NULL COMMENT '期中成绩',
  `final` smallint(6) NOT NULL COMMENT '期末成绩',
  `total` smallint(6) NOT NULL COMMENT '总评成绩',
  `tn1` varchar(20) COLLATE utf8_unicode_ci NOT NULL COMMENT '考试1名称',
  `s1` smallint(11) NOT NULL COMMENT '考试1成绩',
  `tn2` varchar(20) COLLATE utf8_unicode_ci NOT NULL COMMENT '考试2名称',
  `s2` smallint(11) NOT NULL COMMENT '考试2成绩'
) ENGINE=InnoDB AUTO_INCREMENT=5160 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 触发器 `scores`
--
DROP TRIGGER IF EXISTS `caculatetotal`;
DELIMITER //
CREATE TRIGGER `caculatetotal` BEFORE UPDATE ON `scores`
 FOR EACH ROW set new.total=new.regular*0.2+new.midterm*0.3+new.final*0.5
//
DELIMITER ;

-- --------------------------------------------------------

--
-- 表的结构 `semesters`
--

DROP TABLE IF EXISTS `semesters`;
CREATE TABLE IF NOT EXISTS `semesters` (
`id` int(10) unsigned NOT NULL,
  `year` year(4) NOT NULL COMMENT '开始年份',
  `sem_name` varchar(40) COLLATE utf8_unicode_ci NOT NULL COMMENT '名称',
  `created` datetime NOT NULL COMMENT '创建时间',
  `modified` datetime NOT NULL COMMENT '修改时间',
  `sem_number` tinyint(4) NOT NULL COMMENT '学期序号',
  `current` tinyint(1) NOT NULL DEFAULT '0' COMMENT '当前'
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- 表的结构 `students`
--

DROP TABLE IF EXISTS `students`;
CREATE TABLE IF NOT EXISTS `students` (
`id` int(11) NOT NULL,
  `stu_number` varchar(12) COLLATE utf8_unicode_ci NOT NULL COMMENT '学号',
  `dept_number` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `stu_name` varchar(40) COLLATE utf8_unicode_ci NOT NULL COMMENT '姓名',
  `id_card_number` varchar(20) COLLATE utf8_unicode_ci NOT NULL COMMENT '证件号码',
  `dob` date NOT NULL COMMENT '出生日期',
  `nationality` varchar(20) COLLATE utf8_unicode_ci NOT NULL COMMENT '民族',
  `native_place` varchar(100) COLLATE utf8_unicode_ci NOT NULL COMMENT '籍贯',
  `gender` int(11) NOT NULL,
  `address` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `parent_phone1` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `parent_phone2` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `password` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `note` text COLLATE utf8_unicode_ci NOT NULL,
  `logdept` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=517 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='学生表';

--
-- 触发器 `students`
--
DROP TRIGGER IF EXISTS `logstuchange`;
DELIMITER //
CREATE TRIGGER `logstuchange` BEFORE UPDATE ON `students`
 FOR EACH ROW if new.stu_number!=old.stu_number then
set new.note=concat(old.note,old.stu_number,'&');
elseif new.dept_number!=old.dept_number then
set new.logdept=concat(old.logdept,old.dept_number,'&');
end if
//
DELIMITER ;

-- --------------------------------------------------------

--
-- 表的结构 `teaching_tasks`
--

DROP TABLE IF EXISTS `teaching_tasks`;
CREATE TABLE IF NOT EXISTS `teaching_tasks` (
`id` int(10) unsigned NOT NULL,
  `department_id` int(10) unsigned NOT NULL,
  `course_plan_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `note` text COLLATE utf8_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 触发器 `teaching_tasks`
--
DROP TRIGGER IF EXISTS `loguserchange`;
DELIMITER //
CREATE TRIGGER `loguserchange` BEFORE UPDATE ON `teaching_tasks`
 FOR EACH ROW if new.user_id!=old.user_id then
set new.note=concat(old.note,NOW(),'+',old.user_id,'&');
end if
//
DELIMITER ;

-- --------------------------------------------------------

--
-- 表的结构 `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
`id` int(11) unsigned NOT NULL,
  `username` varchar(20) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `fullname` varchar(100) NOT NULL,
  `gender` char(1) NOT NULL,
  `group_id` int(11) NOT NULL,
  `main_subject` int(11) NOT NULL DEFAULT '0' COMMENT '主要学科',
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `dob` date DEFAULT NULL COMMENT '出生日期'
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `course_plans`
--
ALTER TABLE `course_plans`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `dept_name` (`dept_name`);

--
-- Indexes for table `electives`
--
ALTER TABLE `electives`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `scores`
--
ALTER TABLE `scores`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `semesters`
--
ALTER TABLE `semesters`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `teaching_tasks`
--
ALTER TABLE `teaching_tasks`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `course_plans`
--
ALTER TABLE `course_plans`
MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=102;
--
-- AUTO_INCREMENT for table `electives`
--
ALTER TABLE `electives`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4636;
--
-- AUTO_INCREMENT for table `scores`
--
ALTER TABLE `scores`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5160;
--
-- AUTO_INCREMENT for table `semesters`
--
ALTER TABLE `semesters`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=517;
--
-- AUTO_INCREMENT for table `teaching_tasks`
--
ALTER TABLE `teaching_tasks`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=30;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
