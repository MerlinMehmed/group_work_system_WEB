<!DOCTYPE html>
<html>
  <head>
	<link rel="shortcut icon" href="image/group.png" type="image/png"/>
    <title>Групова работа</title>
	<meta charset="utf-8">
	<link href="style/style.css" rel="stylesheet" type="text/css">
	<script type="text/javascript" src="js/register.js"></script>
  </head>
  <body>
	<div class="header">
		<center>
			<span><img id="logo" src="image/group.png"></span>
			<span id="title">Teamwork time</span>
		</center>	
	</div>
	<div class="form_holder">
		<center >
			<h1>Регистрация</h1>
			<form id="register" onsubmit = "return validate()" method="post" action="controllers/register.php">
				<h4>Потребителско име:</h4> <input type="text" name="username" id="username">
				<div id="user" class="error">
                    <?php
                        if(isset($_GET['exists'])) {
                            echo 'Потребителското име е заето';
                        }
                    ?>
				</div>
				<h4>E-mail:</h4> <input type="email" name="email" id="email"><div id="mail" class="error"></div>
				<h4>Парола:</h4><input type="password" name="password" id="password"><div id="pass" class="error"></div>
				<h4>Повтори паролата:</h4><input type="password" name="secondpass" id="repeatedpass"><div id="second" class="error"></div>
				<button class="btn" type="submit">Регистрация</button>
			</form>
		</center>
	</div>
  </body>
</html>