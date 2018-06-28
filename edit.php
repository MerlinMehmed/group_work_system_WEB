<!DOCTYPE html>
<html>
  <head>
	<link rel="shortcut icon" href="image/group.png" type="image/png"/>
    <title>Групова работа</title>
	<meta charset="utf-8">
	<link href="style/edit.css" rel="stylesheet" type="text/css">
	<link href="style/nav.css" rel="stylesheet" type="text/css">
	<script  src="js/edit.js"></script>
      <script src="js/webSocket.js"></script>
  </head>
  <body>
    <?php include ("navigation.php"); ?>
    <?php
        include ('controllers/editDocument.php');
    ?>
    <div id = "info-box"></div>
	<div class="main">
		<table>
		<tr><td>Редактиране на файла:</td><td>Визуализация:</td></tr>
		<tr><td><button class="edit" onclick="formatText(document.getElementById('inputTextToSave'),'<b>','</b>')"><b>B</b></button>
		<button class="edit" onclick="formatText(document.getElementById('inputTextToSave'),'<i>','</i>')"><i>I</i></button>
		<button class="edit" onclick="formatText(document.getElementById('inputTextToSave'),'<u>','</u>')"><u>U</u></button>
		<button class="edit" onclick="formatText(document.getElementById('inputTextToSave'),'<h1>','</h1>')">h1</button>
		<button class="edit" onclick="formatText(document.getElementById('inputTextToSave'),'<h2>','</h2>')">h2</button>
		<button class="edit" onclick="formatText(document.getElementById('inputTextToSave'),'<h3>','</h3>')">h3</button>
		<button class="edit" onclick="formatText(document.getElementById('inputTextToSave'),'<p>','</p>')">p</button>
		<button style="width:45px" class="edit" onclick="formatText(document.getElementById('inputTextToSave'),'<code>','</code>')">Code</button>
		<button style="width:55px" class="edit" onclick="formatText(document.getElementById('inputTextToSave'),'<q>','</q>')">Quote</button>
		</td><td><button onclick="return showText();" style="width:65px" class="edit">Преглед</button></td></tr>
		<form method="post">	
			<tr>
				<td>
					<textarea name="content" id="inputTextToSave" cols="90" rows="20"><?php echo $document->getContent(); ?></textarea>
				</td>
				<td id="text" style="vertical-align:top"></td>
			</tr>

			<tr>
				<td><b>Име на файла:</b>     <input name="fileName" id="inputFileNameToSaveAs" value="<?php $pieces = explode("/", $fileName);
																											echo $pieces[1]; ?>"></input> </td>
			</tr>
			<tr><td colspan="4"><hr><td></tr>
			<tr>
				<td><b>Тип на файла:</b><input id="text"type="radio" name="type" value="txt"> .txt    
				<input type="radio" name="type" value="html"> .html</td>				
				<td id="download"><button onclick="saveTextAsFile()">Свали</button></td>
				
			</tr>
			<tr><td colspan="4"><hr><td></tr>
			<tr>
				<td><b>Добави права за достъп:</b>
				<div><input type="text" name="user1[]" class="user"><span id="add" onclick="addInput1()">+<span></div>
				<div id="inputs1"></div></td>			
			</tr>
			<tr>
				<td><b>Премахни права за достъп:</b>
				<div><input type="text" name="user2[]" class="user"><span id="add" onclick="addInput2()">+<span></div>
				<div id="inputs2"></div></td>
			</tr>
			<tr>
				<td><button type="submit" formaction="controllers/saveDocument.php">Запази</button></td>
				<td><button type="submit" formaction="controllers/saveAsNew.php">Запази като нов файл</button><td>
			</tr>
		</table>
	</div>
  </body>
</html>