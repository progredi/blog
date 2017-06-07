-- phpMyAdmin SQL Dump
-- version 4.0.10.18
-- https://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Generation Time: May 24, 2017 at 11:40 AM
-- Server version: 10.0.30-MariaDB-cll-lve
-- PHP Version: 5.6.30

-- --------------------------------------------------------

--
-- Data for table `app_preferences`
--

INSERT INTO `app_preferences` (`key`, `value`, `title`, `description`, `input_type`, `editable`, `placeholder`, `position`, `enabled`, `created`, `modified`) VALUES
('Blog.title', 'Blog Title', NULL, NULL, 'text', 1, NULL, 1, 1, NOW(), NOW()),
('Blog.subtitle', 'Blog subtitle', NULL, NULL, 'text', 1, NULL, 2, 1, NOW(), NOW()),
('Blog.pagination', '10', NULL, NULL, 'text', 1, NULL, 3, 1, NOW(), NOW());
