<!DOCTYPE html>
<html>
  <head>
	<link rel="shortcut icon" href="image/group.png" type="image/png"/>
    <title>Групова работа</title>
	<meta charset="utf-8">
	<link href="style/edit.css" rel="stylesheet" type="text/css">
	<script src="js/edit.js"></script>
  </head>
  <body>
    <?php include ("navigation.php"); ?>
	<div class="main">
		<table>
			<tr><td>Редактиране на файла:</td></tr>
			<tr>
				<td colspan="3">
					<textarea id="inputTextToSave" cols="120" rows="20"></textarea>
				</td>
			</tr>
			<tr>
				<td>Име на файла:     <input id="inputFileNameToSaveAs"></input>
				<input id="text"type="radio" name="type" value="txt"> .txt    
				<input type="radio" name="type" value="html"> .html</td>
				<td><button onclick="saveTextAsFile()">Свали</button></td>
			</tr>
			<tr>
				<td><button onclick="">Запази</button><td>
			</tr>
			<tr>
				<td><button onclick="">Запази като нов файл</button><td>
			</tr>	
		</table>
	</div>
  </body>
</html>