<?php

namespace App\Controllers;

use App\Core\AControllerBase;
use App\Core\Responses\Response;
use App\Models\Product;
use App\Models\Streamer;
use App\Models\Points;

/** @var \App\Core\IAuthenticator $auth */


class StoreController extends AControllerBase
{

    public function index(): Response
    {
        $id = $this->request()->getValue('id');
        if ($id == null || !is_numeric($id)) {
            return $this->redirect("?c=home");
        }
        $products = Product::getAll("id_streamer = ?", [$id]);
        $streamer = Streamer::getOne($id);
        if ($streamer == null) {
            return $this->redirect("?c=home");
        }
        $points = NULL;
        if ($this->app->getAuth()->isLogged()) {
            $points = Points::getAll("id_streamer = ? AND id_user = ?", [$id, $this->app->getAuth()->getLoggedUserId()]);
        }

        return $this->html(
            [
                'products' => $products,
                'streamer' => $streamer,
                'points' => ($points == NULL) ? NULL : $points[0]
            ]);
    }
}