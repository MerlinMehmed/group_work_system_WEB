<!DOCTYPE html>
<html>
  <head>
	<link rel="shortcut icon" href="image/group.png" type="image/png"/>
    <title>Групова работа</title>
	<meta charset="utf-8">
	<link href="style/add.css" rel="stylesheet" type="text/css">
	<script src="js/add.js"></script>
  </head>
  <body>
    <?php include ("navigation.php"); ?>

	<div class="main">
		<form action="controllers/uploadDocument.php" method="post" enctype="multipart/form-data">
		<b>Избери файл за качване: </b>
			<div><input type="file" name="fileToUpload" id="fileToUpload" value="Избор на файл"></div>
		<b>Име на файла: </b>
			<div><input type="text" name="fileName" id="fileName"></div>
		<b>Потребители с достъп до файла: </b>
			<div><input type="text" name="user" class="user"><span id="add" onclick="addInput()">+<span></div>
			<div id="inputs"></div>
			<input class="btn" type="submit" value="Качи файла" name="submit">
		</form>
	</div>
  </body>
</html>