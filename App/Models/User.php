<?php

namespace App\Models;

use App\Core\Model;

class User extends Model
{
    protected $id_user, $nickname, $password, $email, $hasStore;

    /**
     * @param $nickname
     * @param $password
     * @param $email
     * @param $hasStore
     */
    public function __construct(string $nickname = "", string $email = "", string $password = "")
    {
        $this->nickname = $nickname;
        $this->password = $password;
        $this->email = $email;
    }

    public static function getPkColumnName() : string
    {
        return 'id_user';
    }
    /**
     * @return mixed
     */
    public function getIdUser()
    {
        return $this->id_user;
    }

    /**
     * @param mixed $id_user
     */
    public function setIdUser($id_user): void
    {
        $this->id_user = $id_user;
    }

    /**
     * @return mixed
     */
    public function getNickname()
    {
        return $this->nickname;
    }

    /**
     * @param mixed $nickname
     */
    public function setNickname($nickname): void
    {
        $this->nickname = $nickname;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password): void
    {
        $this->password = $password;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email): void
    {
        $this->email = $email;
    }
}