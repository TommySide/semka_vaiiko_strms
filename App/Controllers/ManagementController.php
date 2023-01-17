<?php

namespace App\Controllers;

use App\Core\AControllerBase;
use App\Core\Responses\Response;
use App\Models\Managestreamers;
use App\Models\Streamer;

class ManagementController extends AControllerBase
{

    public function authorize(string $action)
    {
        return $this->app->getAuth()->isLogged();
    }

    public function index(): Response
    {
        $manageList = Managestreamers::getAll("id_user = ?", [$this->app->getAuth()->getLoggedUserId()]);
        $arr = [];
        foreach ($manageList as $manStreamer) {
            $str = Streamer::getOne($manStreamer->getIdStreamer());
            array_push($arr, $str);
        }
        return $this->html($arr);
    }
}