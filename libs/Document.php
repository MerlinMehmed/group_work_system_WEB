<?php
namespace libs;
use libs\DocumentInfo;

class Document
{
    private $documentInfo;
    private $content;

    /**
     * Document constructor.
     * @param $documentInfo
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
        $file = fopen($this->documentInfo->contentUrl, 'r');
        while(!feof($file)) {
            $this->content . fgets();
        }
    }

}

?>