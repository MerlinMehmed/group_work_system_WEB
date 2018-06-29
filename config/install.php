<?php
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "group_work_system";

	$conn = new PDO("mysql:host=$servername", $username, $password);
		
	$sql = "CREATE DATABASE IF NOT EXISTS `group_work_system` COLLATE utf8mb4_unicode_ci";
	$stmt = $conn->prepare($sql);
	$stmt->execute();
		
	$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
	
/* Структура на таблица `document` */
	
	$sql = "CREATE TABLE `document` (
									  `id` int(11) NOT NULL,
									  `owner` varchar(20) NOT NULL,
									  `content_url` varchar(50) NOT NULL,
									  `last_update_user` varchar(20) DEFAULT NULL,
									  `last_update_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
									) ENGINE=InnoDB DEFAULT CHARSET=utf8";
	$stmt = $conn->prepare($sql);
	$stmt->execute();


/* Схема на данните от таблица `document`*/

	$sql = "INSERT INTO `document` (`id`, `owner`, `content_url`, `last_update_user`, `last_update_date`) VALUES
											(1,'fmi', 'fmi/document', 'merry', '2018-06-29 14:44:26'),
											(2,'merry', 'merry/referat', 'fmi', '2018-06-28 10:32:00'),
											(4,'merry', 'merry/file2', 'polly', '2018-06-29 14:47:28'),
											(5,'polly', 'polly/document1', NULL, '2018-06-25 19:08:20')";
	$stmt = $conn->prepare($sql);
	$stmt->execute();



 /* Структура на таблица `users` */
 
 	$sql = "CREATE TABLE `users` (
				  `username` varchar(20) NOT NULL,
				  `password` varchar(200) NOT NULL,
				  `email` varchar(30) NOT NULL
				) ENGINE=InnoDB DEFAULT CHARSET=utf8";
	$stmt = $conn->prepare($sql);
	$stmt->execute();



 /* Схема на данните от таблица `users` */

  	$sql = "INSERT INTO `users` (`username`, `password`, `email`) VALUES
					('fmi', 'fmipass', 'fmi@fmi.com'),
					('merry', 'merrymerry', 'merry@gmail.com'),
					('polly', 'pollypolly', 'polly@gmail.com')";
	$stmt = $conn->prepare($sql);
	$stmt->execute();
 

 /* Структура на таблица `user_document` */

  	$sql = "CREATE TABLE `user_document` (
				  `username` varchar(20) NOT NULL,
				  `id_document` int(11) NOT NULL
				) ENGINE=InnoDB DEFAULT CHARSET=utf8";
	$stmt = $conn->prepare($sql);
	$stmt->execute();

 /* Схема на данните от таблица `user_document` */
 
   	$sql = "INSERT INTO `user_document` (`username`, `id_document`) VALUES
				('fmi', 2),
				('fmi', 4),
				('merry', 5),
				('polly', 4)";
	$stmt = $conn->prepare($sql);
	$stmt->execute();


   	$sql = "ALTER TABLE `document` ADD PRIMARY KEY (`id`)";
    $stmt = $conn->prepare($sql);
	$stmt->execute();

	
   	$sql = "ALTER TABLE `users` ADD PRIMARY KEY (`username`)";
	$stmt = $conn->prepare($sql);
	$stmt->execute();

	
   	$sql = "ALTER TABLE `user_document`
							  ADD PRIMARY KEY (`username`,`id_document`),
							  ADD KEY `username` (`username`),
							  ADD KEY `id_document` (`id_document`)";
	$stmt = $conn->prepare($sql);
	$stmt->execute();
	
	
	
   	$sql = "ALTER TABLE `document` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6";
	$stmt = $conn->prepare($sql);
	$stmt->execute();

	
   	$sql = "ALTER TABLE `user_document`
				  ADD CONSTRAINT `user_document_ibfk_1` FOREIGN KEY (`id_document`) REFERENCES `document` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
				  ADD CONSTRAINT `user_document_ibfk_2` FOREIGN KEY (`username`) REFERENCES `users` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;
				COMMIT;";
    $stmt = $conn->prepare($sql);
	$stmt->execute();


?>