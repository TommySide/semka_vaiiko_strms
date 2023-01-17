<?php

namespace App\Controllers;


use App\Core\AControllerBase;
use App\Core\Responses\JsonResponse;
use App\Core\Responses\Response;
use App\Models\Product;
use App\Models\Streamer;
use App\Models\User;

class StreamerController extends AControllerBase
{

    public function index(): Response
    {
        $streamers = Streamer::getAll();
        return $this->html(
            [
                'streamer' => $streamers,
                'message' => ""
            ]
        );
    }

    public function find(): Response {
        $search = $this->request()->getValue("search");
        if ($this->checkText($search)) {
            $return = [
                'streamer' => null,
                'message' => "Nepovolene znaky"
            ];
            return $this->html($return);
        }
        $search = "%".$search."%";
        $streamers = Streamer::getAll("name LIKE ?", [$search]);
        return $this->html(
            [
                'streamer' => $streamers,
                'message' => ($streamers) ? "Poradilo sa" : "Hladany vyraz sme nenasli"
            ], viewName: "index"
        );
    }


    private function checkText($data): bool
    {
        if (!preg_match('/^[a-zA-Z0-9 _]+$/', $data))
            return true;
        return false;
    }
}