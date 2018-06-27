<?php
require_once('SocketHandler.php');

define('HOST_NAME',"localhost");
define('PORT',"8090");
$null = NULL;

$socketHandler = new SocketHandler();

$socketResource = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
socket_set_option($socketResource, SOL_SOCKET, SO_REUSEADDR, 1);
socket_bind($socketResource, 0, PORT);
socket_listen($socketResource);

$clientSocketArray = array($socketResource);
$clientsDocumentsId = array(0);
while (true) {
    $newSocketArray = $clientSocketArray;
    socket_select($newSocketArray, $null, $null, 0, 10);

    if (in_array($socketResource, $newSocketArray)) {
        $newSocket = socket_accept($socketResource);
        $clientSocketArray[] = $newSocket;
        $clientsDocumentsId[] = 0;

        $header = socket_read($newSocket, 1024);
        $socketHandler->doHandshake($header, $newSocket, HOST_NAME, PORT);

        socket_getpeername($newSocket, $client_ip_address);
        $connectionACK = $socketHandler->newConnectionACK($client_ip_address);

        $socketHandler->send($connectionACK);

        $newSocketIndex = array_search($socketResource, $newSocketArray);
        unset($newSocketArray[$newSocketIndex]);
    }

    foreach ($newSocketArray as $newSocketArrayResource) {
        while(socket_recv($newSocketArrayResource, $socketData, 1024, 0) >= 1){
            $socketMessage = $socketHandler->unseal($socketData);
            if(substr($socketMessage, 0, 4) == "file") {
                $clientsDocumentsId[count($clientsDocumentsId)-1] = substr($socketMessage, 5, strlen((string)$socketMessage));
                echo "message ".$socketMessage;
            } else {
                $messageObj = json_decode($socketMessage);
                var_dump($messageObj);
                $chat_box_message = $socketHandler->createChatBoxMessage($messageObj->id, $messageObj->chat_user, $messageObj->chat_message);
                $socketHandler->send($chat_box_message);
            }
            break 2;
        }

        $socketData = @socket_read($newSocketArrayResource, 1024, PHP_NORMAL_READ);
        if ($socketData === false) {
            socket_getpeername($newSocketArrayResource, $client_ip_address);
            $connectionACK = $socketHandler->connectionDisconnectACK($client_ip_address);
            $socketHandler->send($connectionACK);
            $newSocketIndex = array_search($newSocketArrayResource, $clientSocketArray);
            unset($clientSocketArray[$newSocketIndex]);
        }
    }
}
socket_close($socketResource);

//            if($clientsDocumentsId[$index] == 0) {
//                $clientsDocumentsId[$index] = $messageObj -> id;
//            }
//            $chat_box_message = $socketHandler->createChatBoxMessage($messageObj->chat_user, $messageObj->chat_message);
?>