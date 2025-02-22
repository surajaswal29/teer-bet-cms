-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
-- Host: 127.0.0.1
-- Generation Time: Feb 20, 2025 at 02:04 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

-- Create Database
CREATE DATABASE IF NOT EXISTS `shillong_teer_db`;
USE `shillong_teer_db`;

-- Table structure for table `admin`
CREATE TABLE `admin` (
  `id` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `username` VARCHAR(255) NOT NULL UNIQUE,
  `password` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Table structure for table `common_number`
CREATE TABLE `common_number` (
  `id` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `direct` SMALLINT(5) UNSIGNED NOT NULL,  
  `house` SMALLINT(5) UNSIGNED NOT NULL,  
  `ending` SMALLINT(5) UNSIGNED NOT NULL,
  `time_period` ENUM('morning', 'day', 'night') NOT NULL DEFAULT 'day',  
  `date` DATE NOT NULL DEFAULT CURRENT_DATE,

  PRIMARY KEY (`id`),
  INDEX (`date`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


-- Table structure for table `dream_number`
CREATE TABLE `dream_number` (
  `id` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `dream` VARCHAR(255) NOT NULL,
  `numbers` VARCHAR(255) NOT NULL,
  `house` SMALLINT(5) UNSIGNED NOT NULL,
  `ending` SMALLINT(5) UNSIGNED NOT NULL,
  `time_period` ENUM('morning', 'day', 'night') NOT NULL DEFAULT 'day',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Table structure for table `prev_result`
CREATE TABLE `prev_result` (  
  `id` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `date` DATE NOT NULL,
  `first_round` SMALLINT(5) UNSIGNED NOT NULL,  -- First Round
  `second_round` SMALLINT(5) UNSIGNED NOT NULL, -- Second Round
  `third_round` SMALLINT(5) UNSIGNED DEFAULT NULL, -- Third Round
  `fourth_round` SMALLINT(5) UNSIGNED DEFAULT NULL, -- Fourth Round
  `city` VARCHAR(255) NOT NULL DEFAULT 'Shillong', -- Default city
  `time_period` ENUM('morning', 'day', 'night') NOT NULL DEFAULT 'day',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


-- Table structure for table `result_update`
CREATE TABLE `result_update` (
  `id` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `first_time` TIME NOT NULL,  
  `first_number` SMALLINT(5) UNSIGNED NOT NULL,  
  `second_time` TIME NOT NULL,  
  `second_number` SMALLINT(5) UNSIGNED NOT NULL,  
  `third_time` TIME DEFAULT NULL,  
  `third_number` SMALLINT(5) UNSIGNED DEFAULT NULL,  
  `fourth_time` TIME DEFAULT NULL,  
  `fourth_number` SMALLINT(5) UNSIGNED DEFAULT NULL,  
  `time_period` ENUM('morning', 'day', 'night') NOT NULL DEFAULT 'day',  
  `date` DATE NOT NULL DEFAULT CURRENT_DATE,
  PRIMARY KEY (`id`),
  INDEX (`date`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Table structure for table `seo`
CREATE TABLE `seo` (
  `id` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` VARCHAR(255) NOT NULL,
  `description` TEXT NOT NULL,
  `keyword` VARCHAR(255) NOT NULL,
  `time_period` ENUM('morning', 'day', 'night') NOT NULL DEFAULT 'day',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

COMMIT;
