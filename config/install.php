<?php
	$servername = "localhost";
	$username = "root";
	$password = "";

	$conn = new PDO("mysql:host=$servername", $username, $password);
		
	$sql = "CREATE DATABASE IF NOT EXISTS `group_work_system` COLLATE utf8mb4_unicode_ci";
	$conn->prepare($sql);
	$conn->execute();
	
/* Структура на таблица `document` */
	
	$sql = "CREATE TABLE `document` (
									  `id` int(11) NOT NULL,
									  `owner` varchar(20) NOT NULL,
									  `content_url` varchar(50) NOT NULL,
									  `last_update_user` varchar(20) DEFAULT NULL,
									  `last_update_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
									) ENGINE=InnoDB DEFAULT CHARSET=utf8";
	$conn->prepare($sql);
	$conn->execute();


/* Схема на данните от таблица `document`*/


	$sql = "INSERT INTO `document` (`id`, `owner`, `content_url`, `last_update_user`, `last_update_date`) VALUES
											(1, 'polly', 'polly/po', NULL, '2018-05-17 16:44:33'),
											(3, 'polly', 'polly/olly', NULL, '2018-05-17 16:44:52'),
											(4, 'polly', 'polly/olly', NULL, '2018-05-17 16:45:22'),
											(5, 'merry', 'me', NULL, '2018-05-17 16:45:22')";
	$conn->prepare($sql);
	$conn->execute();



 /* Структура на таблица `users` */
 
 	$sql = "CREATE TABLE `users` (
				  `username` varchar(20) NOT NULL,
				  `password` varchar(30) NOT NULL,
				  `email` varchar(30) NOT NULL
				) ENGINE=InnoDB DEFAULT CHARSET=utf8";
	$conn->prepare($sql);
	$conn->execute();



 /* Схема на данните от таблица `users` */

  	$sql = "INSERT INTO `users` (`username`, `password`, `email`) VALUES
					('merry', 'merry', 'erry'),
					('polly', 'polly', 'olly')";
	$conn->prepare($sql);
	$conn->execute();
 

 /* Структура на таблица `user_document` */

  	$sql = "CREATE TABLE `user_document` (
				  `username` varchar(20) NOT NULL,
				  `id_document` int(11) NOT NULL
				) ENGINE=InnoDB DEFAULT CHARSET=utf8";
	$conn->prepare($sql);
	$conn->execute();

 /* Схема на данните от таблица `user_document` */
 
   	$sql = "INSERT INTO `user_document` (`username`, `id_document`) VALUES
				('merry', 3),
				('polly', 5)";
	$conn->prepare($sql);
	$conn->execute();


   	$sql = "ALTER TABLE `document` ADD PRIMARY KEY (`id`)";
	$conn->prepare($sql);
	$conn->execute();

	
   	$sql = "ALTER TABLE `users` ADD PRIMARY KEY (`username`)";
	$conn->prepare($sql);
	$conn->execute();

	
   	$sql = "ALTER TABLE `user_document`
							  ADD PRIMARY KEY (`username`,`id_document`),
							  ADD KEY `username` (`username`),
							  ADD KEY `id_document` (`id_document`)";
	$conn->prepare($sql);
	$conn->execute();
	
	
	
   	$sql = "ALTER TABLE `document` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6";
	$conn->prepare($sql);
	$conn->execute();

	
   	$sql = "ALTER TABLE `user_document`
				  ADD CONSTRAINT `user_document_ibfk_1` FOREIGN KEY (`id_document`) REFERENCES `document` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
				  ADD CONSTRAINT `user_document_ibfk_2` FOREIGN KEY (`username`) REFERENCES `users` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;
				COMMIT;";
	$conn->prepare($sql);
	$conn->execute();


?>