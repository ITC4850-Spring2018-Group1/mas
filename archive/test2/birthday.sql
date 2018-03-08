-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 12, 2014 at 12:57 AM
-- Server version: 5.5.24-log
-- PHP Version: 5.3.13

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";



CREATE TABLE IF NOT EXISTS `birthday` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `name` varchar(100) NOT NULL,
  `gender` varchar(100) NOT NULL,
  PRIMARY KEY (`id`));

INSERT INTO `birthday` (`id`, `name`, `gender`) VALUES
(1, 'Argie Policarpio', 'Male'),
(2, 'Febe', 'Female'),
(3, 'Amy', 'Female'),
(4, 'Carlo', 'Male'),
(5, 'Jano', 'Male'),
(6, 'Mary Jane', 'female'),
(7, 'Lea', 'Female');
