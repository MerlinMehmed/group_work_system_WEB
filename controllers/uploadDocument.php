<?php
require_once "../libs/Init.php";
Init::_init(true);

use libs\DocumentInfo;

//var_dump(implode(", ", $users));
define('MB', 1048576);
$username = $_SESSION['username'];

$target_dir = "../uploads/users/".$username."/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$fileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

if(!file_exists($target_dir)) {
    mkdir($target_dir, 0777, true);
}

// Check if file already exists
if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}
// Check file size
if ($_FILES["fileToUpload"]["size"] > 7 * MB) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}
// Allow certain file formats
if($fileType != "jpg" && $fileType != "png" && $fileType != "jpeg"
    && $fileType != "gif" && $fileType != "html" && $fileType!="txt") {
    echo "Sorry, only Text document, HTML, JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        // Write url and owner to db
        $contentUrl = $username."/".$_POST["fileName"];
        $documentInfo = new DocumentInfo($username, $contentUrl, $username, date('d-m-Y H:i:s'));
        $documentInfo->insert();

        $users = $_POST['user'];
        foreach ($users as $userToBeAdded) {
            echo "Rights to " . $userToBeAdded . " are added.";
            $documentInfo->addRight($userToBeAdded);
        }

        echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}
?>