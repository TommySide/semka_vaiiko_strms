<?php

namespace App\Controllers;

use App\Core\AControllerBase;
use App\Core\Responses\Response;
use App\Models\Product;
use App\Models\Streamer;


class StoreController extends AControllerBase
{

    public function index(): Response
    {
        $id = $this->request()->getValue('id');
        $products = Product::getAll("id_streamer", $id);
        $streamer = Streamer::getOne($id);
        $points =
        return $this->html([$products, $streamer]);
    }
}