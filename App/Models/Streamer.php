<?php

namespace App\Models;

use App\core\Model;

class Streamer extends Model
{
    protected $id_streamer, $name, $popis, $smallpopis, $www, $fb, $discord, $youtube, $instagram, $telegram, $twitter, $id_user;

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

    public static function getPkColumnName() : string
    {
        return 'id_streamer';
    }

    /**
     * @return mixed
     */
    public function getIdStreamer()
    {
        return $this->id_streamer;
    }

    /**
     * @param int $id_streamer
     */
    public function setIdStreamer($id_streamer): void
    {
        $this->id_streamer = $id_streamer;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name): void
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getPopis()
    {
        return $this->popis;
    }

    /**
     * @param mixed $popis
     */
    public function setPopis($popis): void
    {
        $this->popis = $popis;
    }

    /**
     * @return mixed
     */
    public function getSmallpopis()
    {
        return $this->smallpopis;
    }

    /**
     * @param mixed $smallpopis
     */
    public function setSmallpopis($smallpopis): void
    {
        $this->smallpopis = $smallpopis;
    }

    /**
     * @return mixed
     */
    public function getWww()
    {
        return $this->www;
    }

    /**
     * @param mixed $www
     */
    public function setWww($www): void
    {
        $this->www = $www;
    }

    /**
     * @return mixed
     */
    public function getFb()
    {
        return $this->fb;
    }

    /**
     * @param mixed $fb
     */
    public function setFb($fb): void
    {
        $this->fb = $fb;
    }

    /**
     * @return mixed
     */
    public function getDiscord()
    {
        return $this->discord;
    }

    /**
     * @param mixed $discord
     */
    public function setDiscord($discord): void
    {
        $this->discord = $discord;
    }

    /**
     * @return mixed
     */
    public function getYoutube()
    {
        return $this->youtube;
    }

    /**
     * @param mixed $youtube
     */
    public function setYoutube($youtube): void
    {
        $this->youtube = $youtube;
    }

    /**
     * @return mixed
     */
    public function getInstagram()
    {
        return $this->instagram;
    }

    /**
     * @param mixed $instagram
     */
    public function setInstagram($instagram): void
    {
        $this->instagram = $instagram;
    }

    /**
     * @return mixed
     */
    public function getTelegram()
    {
        return $this->telegram;
    }

    /**
     * @param mixed $telegram
     */
    public function setTelegram($telegram): void
    {
        $this->telegram = $telegram;
    }

    /**
     * @return mixed
     */
    public function getTwitter()
    {
        return $this->twitter;
    }

    /**
     * @param mixed $twitter
     */
    public function setTwitter($twitter): void
    {
        $this->twitter = $twitter;
    }


}