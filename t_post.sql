-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- ホスト: localhost
-- 生成日時: 2021 年 5 月 30 日 12:15
-- サーバのバージョン： 10.4.17-MariaDB
-- PHP のバージョン: 8.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- データベース: `ph22`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `t_post`
--

CREATE TABLE `t_post` (
  `id` int(11) NOT NULL COMMENT 'ID',
  `name` varchar(30) NOT NULL COMMENT 'ニックネーム',
  `msg` text NOT NULL COMMENT '投稿メッセージ',
  `category` varchar(2) NOT NULL COMMENT '投稿ジャンル',
  `reply_id` int(11) NOT NULL COMMENT '返信先ID',
  `del_flg` int(11) NOT NULL COMMENT '削除フラグ',
  `post_date` datetime NOT NULL COMMENT '投稿日時'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='投稿用テーブル';

--
-- テーブルのデータのダンプ `t_post`
--

INSERT INTO `t_post` (`id`, `name`, `msg`, `category`, `reply_id`, `del_flg`, `post_date`) VALUES
(1, 'ryota', 'こんにちは', '映画', 0, 0, '2021-05-30 19:12:04'),
(2, '', '', '映画', 0, 1, '2021-05-30 19:14:19');

--
-- ダンプしたテーブルのインデックス
--

--
-- テーブルのインデックス `t_post`
--
ALTER TABLE `t_post`
  ADD PRIMARY KEY (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
