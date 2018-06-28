<html>
<head>
    <style>
        body{width:600px;font-family:calibri;}
        .error {color:#FF0000;}
        .chat-connection-ack{color: #26af26;}
        .chat-message {border-bottom-left-radius: 4px;border-bottom-right-radius: 4px;
        }
        #btnSend {background: #26af26;border: #26af26 1px solid;	border-radius: 4px;color: #FFF;display: block;margin: 15px 0px;padding: 10px 50px;cursor: pointer;
        }
        #info-box {background: #fff8f8;border: 1px solid #ffdddd;border-radius: 4px;border-bottom-left-radius:0px;border-bottom-right-radius: 0px;min-height: 300px;padding: 10px;overflow: auto;
        }
        .info-box-html{color: #09F;margin: 10px 0px;font-size:0.8em;}
        .info-box-message{color: #09F;padding: 5px 10px; background-color: #fff;border: 1px solid #ffdddd;border-radius:4px;display:inline-block;}
        .chat-input{border: 1px solid #ffdddd;border-top: 0px;width: 100%;box-sizing: border-box;padding: 10px 8px;color: #191919;
        }
    </style>
    <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
    <script>

        function showInfoMessage(messageHTML) {
            // $('#inputTextToSave').append(messageHTML);
            var box = document.getElementById("info-box");
            box.innerHTML += messageHTML;
        }


        $(document).ready(function(){
            var websocket = new WebSocket("ws://localhost:8090/demo/SocketServer.php");
            websocket.onopen = function(event) {
                showInfoMessage("<div class='chat-connection-ack'>Connection is established!</div>");
                websocket.send("file=" + window.location.search.split('=')[1].toString());
            }

            websocket.onmessage = function(event) {
                var Data = JSON.parse(event.data);
                showInfoMessage("<div class='"+Data.message_type+"'>"+Data.message+"</div>");
                console.log(Data.message);
                document.getElementById("inputTextToSave").value = Data.message;
                // $('inputTextToSave').val(Data.message);
                // $('#inputTextToSave').val('');
            };

            websocket.onerror = function(event){
                showInfoMessage("<div class='error'>Съжаляваме, но възникна грешка.</div>");
            };
            websocket.onclose = function(event){
                showInfoMessage("<div class='chat-connection-ack'>Възникна проблем и връзката беше затворена. Моля, опитайте по-късно.</div>");
            };

            document.getElementById("document").addEventListener("change", function () {
                var messageJSON = {
                    id: window.location.search.split('=')[1],
                    chat_message: $('#inputTextToSave').val()
                };
                websocket.send(JSON.stringify(messageJSON));
            })
            // $('#frmChat').on("submit",function(event){
            //     event.preventDefault();
            //     $('#chat-user').attr("type","hidden");
            //     var messageJSON = {
            //         id: window.location.search.split('=')[1],
            //         chat_user: $('#chat-user').val(),
            //         chat_message: $('#inputTextToSave').val()
            //     };
            //     websocket.send(JSON.stringify(messageJSON));
            // });
        });




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
    <input type="text" name="chat-user" id="chat-user" placeholder="Name" class="chat-input" required />
    <!--    <input type="text" name="chat-message" id="chat-message" placeholder="Message"  class="chat-input chat-message" required />-->
    <input type="submit" id="btnSend" name="send-chat-message" value="Send" >
</div>



</form>
</body>
</html>