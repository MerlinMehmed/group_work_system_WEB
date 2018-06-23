<?php // file libs/User.php
namespace libs;

use libs\Db;

class User
{
    private $username;
    private $email;
    private $password;

    public function __construct(string $username, string $password = null)
    {
        $this->username = $username;
        if ($password)
        {
            $this->password = hash('sha256', $password);
        }
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function setUsername($username)
    {
        $this->username = $username;
    }

    public function load()
    {
        $stmt = [];
        if ($this->id)
        {
            $stmt = Db::getConn()->prepare("SELECT * FROM `users` WHERE id = ?");
            $result = $stmt->execute([$this->id]);
        }
        elseif ($this->email)
        {
            $stmt = Db::getConn()->prepare("SELECT * FROM `users` WHERE email = ?");
            $result = $stmt->execute([$this->email]);
        }
        else
        {
            throw new \Exception('Cannot load user');
        }

        $dbUser = $stmt->fetch();

        $this->id           = $dbUser['id'];
        $this->username         = $dbUser['name'];
        $this->email        = $dbUser['email'];
        $this->registeredOn = $dbUser['name'];

        return !!$dbUser;
    }

    public function insert()
    {
        $existingUser = new User('');
        $existingUser->setEmail($this->email);
        $existingUser->load();

        if ($existingUser->id)
        {
            // user exists
            return false;
        }

        $stmt = Db::getConn()->prepare("INSERT INTO `users` (name, email, password) VALUES (?, ?, ?) ");
        return $stmt->execute([$this->username, $this->email, $this->password]);
    }

    public static function fetchAll()
    {
        $stmt = Db::getConn()->prepare("SELECT * FROM `users` ORDER BY registered_on DESC");

        $stmt->execute();

        $users = [];

        while ($user = $stmt->fetch())
        {
            $userObject = new User($user['name']);
            $userObject->setId($user['id']);
            $userObject->setRegisteredOn($user['registered_on']);
            $users[] = $userObject;
        }

        return $users;
    }
}
?>