<html>
<head>
    <style>

    </style>
    <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
    <script>
        function showInfoMessage(messageHTML) {
            var box = document.getElementById("info-box");
            box.innerHTML += messageHTML;
        }

        document.onreadystatechange = () => {
            if (document.readyState === 'complete') {
                var websocket = new WebSocket("ws://localhost:8090/demo/SocketServer.php");
                websocket.onopen = function (event) {
                    showInfoMessage("<div class='chat-connection-ack'>Connection is established!</div>");
                    websocket.send("file=" + window.location.search.split('=')[1].toString());
                }

                websocket.onmessage = function (event) {
                    var Data = JSON.parse(event.data);
                    showInfoMessage("<div class='" + Data.message_type + "'>" + Data.message + "</div>");
                    console.log(Data.message);
                    document.getElementById("inputTextToSave").value = Data.message;
                };

                websocket.onerror = function (event) {
                    showInfoMessage("<div class='error'>Съжаляваме, но възникна грешка.</div>");
                };
                websocket.onclose = function (event) {
                    showInfoMessage("<div class='chat-connection-ack'>Възникна проблем и връзката беше затворена. Моля, опитайте по-късно.</div>");
                };

                document.getElementById("document").addEventListener("change",  function () {
                    var messageJSON = {
                        id: window.location.search.split('=')[1],
                        chat_message: document.getElementById('inputTextToSave').value
                    };
                    websocket.send(JSON.stringify(messageJSON));
                })
            }
        }
    </script>
</head>
<body>
<?php
include ('controllers/editDocument.php');
?>
<form name="document" id="document">
<div class="main" name="frmChat" id="frmChat">
    <div id="info-box"></div>
    <table>
        <tr>
            <td>
                <textarea id="inputTextToSave" name="chat-message" cols="90" rows="20"><?php echo $document->getContent(); ?></textarea>
            </td>
            <td id="text" style="vertical-align:top"></td>
        </tr>
    </table>
</div>



</form>
</body>
</html>