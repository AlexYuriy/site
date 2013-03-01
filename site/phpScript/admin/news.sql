-- phpMyAdmin SQL Dump
-- version 2.6.0-alpha2
-- http://www.phpmyadmin.net
-- 
-- Хост: localhost
-- Время создания: Апр 21 2005 г., 11:54
-- Версия сервера: 4.1.9
-- Версия PHP: 5.0.4
-- 
-- БД : `news`
-- 

-- --------------------------------------------------------

-- 
-- Структура таблицы `dnp_long_news`
-- 

CREATE TABLE `dnp_long_news` (
  `idnum` int(11) NOT NULL auto_increment,
  `time` varchar(5) default NULL,
  `datum` date default NULL,
  `x_datum` int(32) default NULL,
  `title` text,
  `content` text,
  `visible` char(3) default 'on',
  `ip` text,
  `actuals` int(32) default NULL,
  `act_status` varchar(5) default NULL,
  `brouser` text,
  PRIMARY KEY  (`idnum`)
) ENGINE=MyISAM AUTO_INCREMENT=53 ;

-- 
-- Дамп данных таблицы `dnp_long_news`
-- 

INSERT INTO `dnp_long_news` VALUES (52, '18:59', '2005-04-15', 1113523200, 'SKRIPT', 'Novosti s kalendarem', 'on', '192.168.5.51::', 1115078400, 'on', 'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1; igorv)');

-- --------------------------------------------------------

-- 
-- Структура таблицы `users`
-- 

CREATE TABLE `users` (
  `users_id` int(11) NOT NULL auto_increment,
  `login` varchar(16) default NULL,
  `pass` varchar(33) default NULL,
  `name_user` varchar(24) default NULL,
  `status_us` char(1) default NULL,
  `email_us` varchar(24) default NULL,
  `phone_user` varchar(24) default NULL,
  `icq_user` varchar(24) default NULL,
  `date_us` date default '0000-00-00',
  UNIQUE KEY `users_id` (`users_id`)
) ENGINE=MyISAM AUTO_INCREMENT=26 ;

-- 
-- Дамп данных таблицы `users`
-- 

INSERT INTO `users` VALUES (1, 'user', 'ee11cbb19052e40b07aac0ca060c23ee', 'User', '1', '', '', '', '0000-00-00');
