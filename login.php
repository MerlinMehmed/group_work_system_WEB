<!DOCTYPE html>
<html>
    <head>
        <link rel="shortcut icon" href="image/group.png" type="image/png"/>
        <title>Групова работа</title>
        <meta charset="utf-8">
        <link href="style/style.css" rel="stylesheet" type="text/css">
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
                <h1>Вписване</h1>
                <form id="login" method="post" action="controllers/login.php">

                    <h4>Потребителско име:</h4> <input type="text" name="username">
                    <div id="user" class="error">
                        <?php
                            if (isset($_GET['exists'])) {
                                echo "Не съществува такова потребителско име.";
                            }
                        ?>
                    </div>
                    <h4>Парола:</h4><input type="password" name="password">
                    <div id="user" class="error">
                        <?php
                        if (isset($_GET['wrong'])) {
                            echo "Грешна парола!";
                        }
                        ?>
                    </div>
                    <button class="btn" type="submit">Вход</button>
                    <button class="btn" onclick="location.href = 'register.php'" type="button">Регистрация</button>
                </form>
            </center>
        </div>
    </body>
</html>