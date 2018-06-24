<?php // file libs/User.php
namespace libs;

use libs\Db;

class User
{
    private $username;
    private $email;
    private $password;

    public function __construct($username, $password = null)
    {
        $this->username = $username;
        if (!!$password)
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
        if ($this->username)
        {
            $stmt = (new Db())->getConn()->prepare("SELECT * FROM `users` WHERE username = ?");
            $result = $stmt->execute([$this->username]);
        }
        elseif ($this->email)
        {
            $stmt = (new Db())->getConn()->prepare("SELECT * FROM `users` WHERE email = ?");
            $result = $stmt->execute([$this->email]);
        }
        else
        {
            throw new \Exception('Cannot load user');
        }

        $dbUser = $stmt->fetch();

        $this->username     = $dbUser['username'];
        $this->email        = $dbUser['email'];

        return !!$dbUser;
    }

    public function insert()
    {
        $existingUser = new User($this->username);
//        $existingUser->setEmail($this->email);
        $existingUser->load();

        if ($existingUser->username)
        {
            // user exists
            return false;
        }

        $stmt = (new Db())->getConn()->prepare("INSERT INTO `users` (username, email, password) VALUES (?, ?, ?) ");
        return $stmt->execute([$this->username, $this->email, $this->password]);
    }

    public static function fetchAll()
    {
        $stmt = (new Db())->getConn()->prepare("SELECT * FROM `users` ORDER BY registered_on DESC");

        $stmt->execute();

        $users = [];

        while ($user = $stmt->fetch())
        {
            $userObject = new User($user['name']);
            $userObject->setEmail($user['email']);
            $users[] = $userObject;
        }

        return $users;
    }
}
?>