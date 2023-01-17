<?php

namespace App\Models;

use \App\Core\Model;

class Points extends Model
{
    protected $id, $points, $id_user, $id_streamer;

    public static function getPkColumnName() : string
    {
        return 'id';
    }

    static public function getDbColumns() : array
    {
        return [ 'id' ,'points', 'id_user', 'id_streamer' ];
    }

    static public function setTableName()
    {
        return "points";
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getPoints(): int
    {
        return $this->points;
    }

    /**
     * @param mixed $points
     */
    public function setPoints($points): void
    {
        $this->points = $points;
    }

    /**
     * @return mixed
     */
    public function getIdUser()
    {
        return $this->id_user;
    }

    /**
     * @param int $id_user
     */
    public function setIdUser(int $id_user): void
    {
        $this->id_user = $id_user;
    }

    /**
     * @return mixed
     */
    public function getIdStreamer()
    {
        return $this->id_streamer;
    }

    /**
     * @param mixed $id_streamer
     */
    public function setIdStreamer($id_streamer): void
    {
        $this->id_streamer = $id_streamer;
    }


}