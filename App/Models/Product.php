<?php

namespace App\Models;

use App\core\Model;

class Product extends Model
{
    protected $id, $titul, $popis, $cena, $pocet, $id_streamer, $hidden;

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
    public function getTitul()
    {
        return $this->titul;
    }

    /**
     * @param mixed $titul
     */
    public function setTitul($titul): void
    {
        $this->titul = $titul;
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
    public function getCena()
    {
        return $this->cena;
    }

    /**
     * @param mixed $cena
     */
    public function setCena($cena): void
    {
        $this->cena = $cena;
    }

    /**
     * @return mixed
     */
    public function getPocet()
    {
        return $this->pocet;
    }

    /**
     * @param mixed $pocet
     */
    public function setPocet($pocet): void
    {
        $this->pocet = $pocet;
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

    /**
     * @return mixed
     */
    public function getHidden()
    {
        return $this->hidden;
    }

    /**
     * @param mixed $hidden
     */
    public function setHidden($hidden): void
    {
        $this->hidden = $hidden;
    }


}