<?php
namespace libs;

use libs\Db;
use libs\DocumentInfo;

class Document
{
    private $documentInfo;
    private $content;

    /**
     * Document constructor.
     * @param $documentInfo
     * @param $content
     */
    public function __construct($documentInfo, $content)
    {
        $this->documentInfo = $documentInfo;
        $this->content = $content;
    }


    /**
     * @return mixed
     */
    public function getDocumentInfo()
    {
        return $this->documentInfo;
    }

    /**
     * @param mixed $documentInfo
     */
    public function setDocumentInfo($documentInfo)
    {
        $this->documentInfo = $documentInfo;
    }

    /**
     * @return mixed
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param mixed $content
     */
    public function setContent($content)
    {
        $this->content = $content;
    }

    /**
     * Load content from file
     */
    public function loadContent()
    {
        $file = fopen("uploads/users/" . $this->documentInfo->getContentUrl().".html", 'r');
        if ($file) {
            while (!feof($file)) {
                $this->content = $this->content . fgets($file);
            }
//            echo $this->content;
        } else {
            return false;
        }
        return true;
    }

    public function updateDocument()
    {
        $user = $_SESSION['username'];
        if($this->documentInfo->hasRight($user)) {
            $this->writeFile();

            $stmt = (new Db())->getConn()->prepare("UPDATE `document` SET last_update_user = ? AND last_update_date = ? WHERE id = ?");
            return $stmt->execute([$user, date("Y-m-d h:i:sa"), $this->documentInfo->getId()]);
        }
        return false;
    }

    public function writeFile()
    {
        $path = "../uploads/".$_SESSION['username'];
        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }
        $path = "../uploads/".$this->documentInfo->getContentUrl().".html";
        $file = fopen($path, 'w');
        fwrite($file, $this->content);
        fclose($file);
    }
}

?>