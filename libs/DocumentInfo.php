<?php
namespace libs;

class DocumentInfo
{
    private $owner;
    private $contentUrl;
    private $lastUpdateUsername;
    private $lastUpdateDate;

    /**
     * DocumentInfo constructor.
     * @param $owner
     * @param $contentUrl
     * @param $lastUpdateUsername
     * @param $lastUpdateDate
     */
    public function __construct($owner, $contentUrl, $lastUpdateUsername, $lastUpdateDate)
    {
        $this->owner = $owner;
        $this->contentUrl = $contentUrl;
        $this->lastUpdateUsername = $lastUpdateUsername;
        $this->lastUpdateDate = $lastUpdateDate;
    }


    /**
     * @return mixed
     */
    public function getOwner()
    {
        return $this->owner;
    }

    /**
     * @param $owner document owner
     */
    public function setOwner($owner)
    {
        $this->owner = $owner;
    }

    /**
     * @return mixed
     */
    public function getContentUrl()
    {
        return $this->contentUrl;
    }

    /**
     * @param mixed $contentUrl
     */
    public function setContentUrl($contentUrl)
    {
        $this->contentUrl = $contentUrl;
    }

    /**
     * @return mixed
     */
    public function getLastUpdateUsername()
    {
        return $this->lastUpdateUsername;
    }

    /**
     * @param mixed $lastUpdateUsername
     */
    public function setLastUpdateUsername($lastUpdateUsername)
    {
        $this->lastUpdateUsername = $lastUpdateUsername;
    }

    /**
     * @return mixed
     */
    public function getLastUpdateDate()
    {
        return $this->lastUpdateDate;
    }

    /**
     * @param mixed $lastUpdateDate
     */
    public function setLastUpdateDate($lastUpdateDate)
    {
        $this->lastUpdateDate = $lastUpdateDate;
    }




}