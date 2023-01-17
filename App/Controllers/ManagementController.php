<?php

namespace App\Controllers;

use App\Core\AControllerBase;
use App\Core\Responses\Response;
use App\Models\Managestreamers;
use App\Models\Streamer;
use App\Models\User;

class ManagementController extends AControllerBase
{

    public function authorize(string $action)
    {
        return $this->app->getAuth()->isLogged();
    }

    public function index(): Response
    {
        $data = [
            'streamers' => $this->getStreamers(),
            'managers' => $this->getManagers(),
            'hasStore' => $this->hasStore()
        ];
        return $this->html($data);
    }

    public function addadmin() {
        $data = $this->request()->getValue("name");
        if ($this->checkText($data)) {
            return $this->redirect("?c=management&error=chars");
        }
        $user = User::getAll("nickname = ? OR email = ? OR id_user = ?", [$data, $data, $data]);
        if ($user && $user[0]->getIdUser() != $this->app->getAuth()->getLoggedUserId() && !$this->isAdmin($user[0]->getIdUser())) {
            $user = $user[0];
            $manage = new Managestreamers();
            $manage->setIdStreamer($this->hasStore());
            $manage->setIdUser($user->getIdUser());
            $manage->save();
            return $this->redirect("?c=management&success=added");
        }
        return $this->redirect("?c=management&error=nouser");
    }

    public function deleteadmin() {
        $id = $this->request()->getValue("id");

        $manage = Managestreamers::getAll("id_user = ? AND id_streamer = ?", [$id, $this->hasStore()]);
        if ($manage) {
            $manage[0]->delete();
            return $this->redirect("?c=management&success=delete");
        }
        return $this->redirect("?c=management&error=nouser");
    }

    private function isAdmin($id): bool {
        $je = Managestreamers::getAll("id_user = ? AND id_streamer = ?", [$id, $this->hasStore()]);

        return ($je != NULL);
    }

    private function getStreamers():  array {
        $manageList = Managestreamers::getAll("id_user = ?", [$this->app->getAuth()->getLoggedUserId()]);
        $arr = [];
        foreach ($manageList as $manStreamer) {
            $str = Streamer::getOne($manStreamer->getIdStreamer());
            array_push($arr, $str);
        }
        return $arr;
    }

    private function getManagers(): array {
        $strmProfil = Streamer::getAll("id_user = ?", [$this->app->getAuth()->getLoggedUserId()]);
        if (!$strmProfil) {
            return [];
        }
        $arr = [];
        $mngs = Managestreamers::getAll("id_streamer = ?", [$strmProfil[0]->getIdStreamer()]);
        foreach ($mngs as $manager) {
            $user = User::getOne($manager->getIdUser());
            array_push($arr, $user);
        }
        return $arr;
    }

    private function hasStore(): int {
        $streamer = Streamer::getAll("id_user = ?", [$this->app->getAuth()->getLoggedUserId()]);
        return ($streamer) ? $streamer[0]->getIdStreamer() : 0;
    }

    private function checkText($data): bool
    {
        if (!preg_match('/^[a-zA-Z0-9 _]+$/', $data))
            return true;
        return false;
    }
}