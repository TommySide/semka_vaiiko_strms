<?php

namespace App\Models;

use App\Core\Model;


class Boughtproducts extends Model
{
    protected $id, $id_product, $id_user, $datum, $id_streamer;

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

    public static function getPkColumnName() : string
    {
        return 'id';
    }

    static public function getDbColumns(): array
    {
        return [ 'id' ,'id_product', 'id_user', 'datum', 'id_streamer' ];
    }

    static public function setTableName()
    {
        return "boughtproducts";
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
    public function getIdProduct()
    {
        return $this->id_product;
    }

    /**
     * @param mixed $id_product
     */
    public function setIdProduct($id_product): void
    {
        $this->id_product = $id_product;
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
    public function getDatum()
    {
        return $this->datum;
    }

    /**
     * @param mixed $datum
     */
    public function setDatum($datum): void
    {
        $this->datum = $datum;
    }

}