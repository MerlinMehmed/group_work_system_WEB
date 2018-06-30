group_work_system/config - конфигурационни файлове за базата от данни
   .htaccess - файл, указващ достъпа до папката
   config.ini - конфигурационен файл
   db.sql - скрипт 
   install.php - инсталационен файл

group_work_system/configClasses - конфигурационни файлове по модела от документацията за проекта и създателите 
   Config61890.php
   Config61931.php

group_work_system/controllers - файлове, отговарящи за функционалностите на сайта
   addRight.php - добавяне на права за достъп до документ на даден потребител
   createDocument.php - съдаване на нов документ
   deleteFile.php - изтриване на документ
   editDocument.php - редактиране на документ
   findDocument.php - намиране на документ
   login.php - вход в системата
   logout.php - изход от системата
   register.php - регистрация
   saveAsNew.php - запазване на променен документ в нов файл
   saveDocument.php - запазване на променен документ
   showFiles.php - показване на достъпните файлове
   showOwnFiles.php - показване на качените файлове
   SocketHandler.php - отговаря за работата на 1 сокет
   SocketServer.php - отговаря за сървъра, с който се свързват всички сокети
   updateFile.php - обновяване на данните за файл в базата
   uploadDocument.php - качване на документ
   viewDocument.php - преглед на документ

group_work_system/image - изображения, използвани в проекта
   group.png - лого на сайта

group_work_system/js - JavaScript файлове
   add.js - за добавяне на още текстови полета при даване и отнемане на права на потребители
   edit.js - за изтегляне на файл
   register.js - валидация на регистрацията

group_work_system/libs - файлове с използваните класове (всеки файл е именуван в съответствие с класа, който се намира в него)
   .htaccess - файл, указващ достъпа до файловете в папката
   Config.php
   Db.php
   Document.php
   DocumentInfo.php
   Init.php
   User.php

group_work_system/style - CSS файлове отговарящи за дизайна на проекта
   add.css
   create.css
   edit.css
   files.css
   homepage.css
   index.css
   nav.css
   ownFiles.css
   style.css
   
group_work_system/uploads - примерни файлове, качени от потребители (папката на всеки потребител е именувана с потребителското му име)
	/fmi
	   document.html
	/merry
	   file2.html
	   referat.html
	/polly
	   document1.html

group_work_system - страниците от проекта
   add.php - за качване на файл
   create.php - за създаване на файл
   edit.php - за редактиране на файл
   files.php - за показване на файлове, до които има достъп даден потребител
   homepage.html - начална страница с възможност за вход и регистрация
   index.php - начална страница за регистриран потребител
   login.php - страница за вход
   navigation.php - навигация между страниците 
   ownFiles.php - за показване на собствените файлове
   register.php - страница за регистрация
