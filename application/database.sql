SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

CREATE TABLE `resellers` (
  `id` int(11) NOT NULL,
  `username` varchar(50) COLLATE utf8_persian_ci NOT NULL,
  `password` varchar(60) COLLATE utf8_persian_ci NOT NULL,
  `charge` int(11) NOT NULL DEFAULT 0,
  `telegram` varchar(30) COLLATE utf8_persian_ci NOT NULL,
  `connectionLimit` int(11) NOT NULL DEFAULT 1,
  `adminid` int(11) NOT NULL DEFAULT 1,
  `isAdmin` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

CREATE TABLE `resellerservers` (
  `id` int(11) NOT NULL,
  `resellerID` int(11) NOT NULL,
  `serverID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

CREATE TABLE `servers` (
  `id` int(11) NOT NULL,
  `name` text COLLATE utf8_persian_ci NOT NULL,
  `adminDesc` text COLLATE utf8_persian_ci NOT NULL,
  `serverConfig` text COLLATE utf8_persian_ci NOT NULL,
  `serverIP` varchar(20) COLLATE utf8_persian_ci NOT NULL,
  `serverHash` varchar(100) COLLATE utf8_persian_ci NOT NULL,
  `serverProto` varchar(50) COLLATE utf8_persian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `randomKey` varchar(50) COLLATE utf8_persian_ci NOT NULL,
  `fullName` varchar(250) COLLATE utf8_persian_ci NOT NULL,
  `resellerid` int(11) NOT NULL,
  `expireDate` datetime NOT NULL DEFAULT current_timestamp(),
  `createDate` datetime NOT NULL DEFAULT current_timestamp(),
  `lastUpdate` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `allowServerList` text COLLATE utf8_persian_ci NOT NULL DEFAULT '[]'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

CREATE TABLE `userserver` (
  `id` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `serverID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

ALTER TABLE `resellers`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `resellerservers`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `servers`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `userserver`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `resellers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

ALTER TABLE `resellerservers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

ALTER TABLE `servers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

ALTER TABLE `userserver`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;
