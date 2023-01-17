<?php

namespace App\Controllers;

use App\Config\Configuration;
use App\Core\AControllerBase;
use App\Core\Responses\Response;
use App\Models\Managestreamers;
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
        $streamer = Streamer::getOne($id);
        if ($streamer == null) {
            return $this->redirect("?c=home");
        }
        $products = Product::getAll("id_streamer = ?", [$id]);
        $points = NULL;
        if ($this->app->getAuth()->isLogged()) {
            $points = Points::getAll("id_streamer = ? AND id_user = ?", [$id, $this->app->getAuth()->getLoggedUserId()]);
            if (!$points) {
                $points[0] = new Points();
                $points[0]->setIdUser($this->app->getAuth()->getLoggedUserId());
                $points[0]->setIdStreamer($id);
                $points[0]->setPoints(0);
                $points[0]->save();
            }
        }

        return $this->html(
            [
                'products' => $products,
                'streamer' => $streamer,
                'points' => $points[0],
                'manage' => $this->isManagement($id),
                'owner' => $this->isOwner($id)
            ]);
    }

    public function isManagement($id): bool {
        if ($this->app->getAuth()->isLogged() &&
            Managestreamers::getAll("id_streamer = ? AND id_user = ?", [$id, $this->app->getAuth()->getLoggedUserId()]))
            return true;
        return false;
    }

    public function isOwner($id) {
        if ($this->app->getAuth()->isLogged() &&
            Streamer::getAll("id_streamer = ? AND id_user = ?", [$id, $this->app->getAuth()->getLoggedUserId()]))
            return true;
        return false;
    }

    public function create(): Response {
        $data = [
            'streamer' => new Streamer(),
            'message' => 'Novy streamer'];
        return ($this->app->getAuth()->isLogged()) ? $this->html($data, viewName: "create.form") : $this->redirect(Configuration::LOGIN_URL);
    }

    public function submit() {
        $post = $this->request()->getPost();
        if (isset($post['id']))
            $streamer = Streamer::getOne($post['id']);
        else
            $streamer = new Streamer();

        $firstThreeElements = array_slice($post, 0, 3);
        if ($this->invalidName($firstThreeElements) || empty($post['name'])) {
            $data = ['streamer' => $streamer, 'message' => "Nepovolene znaky!"];
            return $this->html($data, viewName: "create.form");
        }
        $streamer->setName($post['name']);
        $streamer->setPopis($post['popis']);
        $streamer->setSmallpopis($post['smallpopis']);

        $post = filter_var_array($post, FILTER_VALIDATE_URL);

        $streamer->setWww(!$post['www'] ? "" : $post['www']);
        $streamer->setFb(!$post['fb'] ? "" : $post['fb']);
        $streamer->setDiscord(!$post['discord'] ? "" : $post['discord']);
        $streamer->setYoutube(!$post['youtube'] ? "" : $post['youtube']);
        $streamer->setInstagram(!$post['instagram'] ? "" : $post['instagram']);
        $streamer->setTelegram(!$post['telegram'] ? "" : $post['telegram']);
        $streamer->setTwitter(!$post['twitter'] ? "" : $post['twitter']);
        if ($streamer->getIdUser() == NULL)
            $streamer->setIdUser($this->app->getAuth()->getLoggedUserId());
        $streamer->save();

        return $this->redirect("?c=store&id=".$streamer->getIdStreamer());
    }

    public function edit(): Response {
        $id = $this->request()->getValue("id");
        $data = [
            'streamer' => Streamer::getOne($id),
            'message' => 'Uprava profilu'];
        return ($this->app->getAuth()->isLogged()) ? $this->html($data, viewName: "create.form") : $this->redirect(Configuration::LOGIN_URL);
    }

    private function invalidName($data): bool
    {
        foreach ($data as $one)
            if (!preg_match('/^[a-zA-Z0-9 _]+$/', $one))
                return true;
        return false;
    }
}