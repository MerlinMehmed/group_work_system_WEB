<?php
namespace libs;

use libs\Db;

class DocumentInfo
{
    private $id;
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
    public function __construct($owner, $contentUrl)
    {
        $this->owner = $owner;
        $this->contentUrl = $contentUrl;
//        $this->lastUpdateUsername = $lastUpdateUsername;
//        $this->lastUpdateDate = $lastUpdateDate;
    }

    public function getId()
    {
        return $this->id;
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

    public function load()
    {
        $stmt = [];
        if (!!$this->contentUrl)
        {
            $filePath = $this->contentUrl;
            $stmt = (new Db())->getConn()->prepare("SELECT * FROM `document` WHERE content_url = ?");
            $result = $stmt->execute([$filePath]);
        }
        else
        {
            throw new \Exception('Cannot load file');
        }

        $dbDocument = $stmt->fetch();

        $this->id = $dbDocument['id'];
        $this->owner = $dbDocument['owner'];
        $this->contentUrl = $dbDocument['content_url'];
        $this->lastUpdateUsername = $dbDocument['last_update_user'];
        $this->lastUpdateDate = $dbDocument['last_update_date'];

        return !!$dbDocument;
    }

    public function insert()
    {
        $existingDocument = new DocumentInfo($this->owner, $this->contentUrl, $this->lastUpdateUsername, $this->lastUpdateDate);
        $existingDocument->setContentUrl($this->contentUrl);
        $existingDocument->load();

        if ($existingDocument->contentUrl)
        {
            // document exists
            return false;
        }

        $stmt = (new Db())->getConn()->prepare("INSERT INTO `document` (owner, content_url, last_update_user) VALUES (?, ?, ?) ");
        $this->lastUpdateUsername=$this->owner;
        return $stmt->execute([$this->owner, $this->contentUrl, $this->lastUpdateUsername]);
    }

    public function addRight($userToBeAdded)
    {
        $stmt = (new Db())->getConn()->prepare("INSERT INTO `user_document` (username, id_document) VALUES (?, ?)");
        return $stmt->execute([$userToBeAdded, $this->id]);
    }

    public function removeRight($userToBeDeleted)
    {
        if($this->isOwner()) {
            $stmt = (new Db())->getConn()->prepare("DELETE FROM `user_document` WHERE id_document = ? AND username = ?");
            return $stmt->execute([$this->id, $userToBeDeleted]);
        }
        return false;
    }

    public function hasRight($user)
    {
        $stmt = (new Db())->getConn()->prepare("SELECT count (*) FROM `user_document` WHERE id_document = ? AND username = ?");
        return $stmt->execute([$this->id, $user]);
    }

    public static function fetchAll()
    {
        $stmt = (new Db())->getConn()->prepare("SELECT * FROM `document` ORDER BY id DESC");

        $stmt->execute();

        $documents = [];

        while ($document = $stmt->fetch())
        {
            $documentObject = new Document($document['contentUrl']);
            $documentObject->setOwner($document['owner']);
            $documentObject->setLastUpdateUsername($document['last_update_username']);
            $documentObject->setLastUpdateDate($document['last_update_date']);
            $documents[] = $documentObject;
        }

        return $documents;
    }

    private function isOwner()
    {
        $stmt = (new Db())->getConn()->prepare("SELECT count (*) FROM 'document' WHERE owner = ? and content_url = ?");
        $stmt->execute($_SESSION['username'], $this->contentUrl);
        return $stmt->fetch();
    }
}