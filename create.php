<!DOCTYPE html>
<html>
  <head>
	<link rel="shortcut icon" href="image/group.png" type="image/png"/>
    <title>Групова работа</title>
	<meta charset="utf-8">
	<link href="style/create.css" rel="stylesheet" type="text/css">
	<script src="js/edit.js"></script>
  </head>
  <body>
    <?php include ("navigation.php"); ?>
    <?php
    require_once "libs/Init.php";
    Init::_init();
        if(isset($_SESSION['created'])) {
            echo "<div>Документът е записан.</div>";
            unset($_SESSION['created']);
        }

    ?>
	<div class="main">
        <form method="post" action="controllers/createDocument.php">
		<table>
			<tr><td>Създаване на текстов файл:</td></tr>
			<tr>
				<td colspan="3">
					<textarea id="inputTextToSave" name="content" cols="120" rows="20"></textarea>
				</td>
			</tr>
			<tr>
				<td>Име на файла:     <input name="fileName" id="inputFileNameToSaveAs"></input>
				<input id="text"type="radio" name="type" value="txt"> .txt    
				<input type="radio" name="type" value="html"> .html</td>
				<td><button onclick="saveTextAsFile()">Свали</button></td>
			</tr>
			<tr>
				<td><button type="submit">Запази</button><td>
			</tr>
		</table>
        </form>
	</div>
  </body>
</html>