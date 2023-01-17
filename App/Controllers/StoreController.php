<?php

namespace App\Controllers;

use App\Config\Configuration;
use App\Core\AControllerBase;
use App\Core\Model;
use App\Core\Responses\Response;
use App\Models\Boughtproducts;
use App\Models\Managestreamers;
use App\Models\Product;
use App\Models\Streamer;
use App\Models\Points;
use App\Models\User;

/** @var \App\Core\IAuthenticator $auth */


class StoreController extends AControllerBase
{
    public function index(): Response
    {
        $idStreamer = $this->request()->getValue('id');
        if ($idStreamer == null || !is_numeric($idStreamer)) {
            return $this->redirect("?c=home");
        }
        $streamer = Streamer::getOne($idStreamer);
        if ($streamer == null) {
            return $this->redirect("?c=home");
        }
        $products = Product::getAll("id_streamer = ?", [$idStreamer]);
        $points = NULL;
        if ($this->app->getAuth()->isLogged()) {
            $points = Points::getAll("id_streamer = ? AND id_user = ?", [$idStreamer, $this->app->getAuth()->getLoggedUserId()]);
            if (!$points) {
                $points[0] = new Points();
                $points[0]->setIdUser($this->app->getAuth()->getLoggedUserId());
                $points[0]->setIdStreamer($idStreamer);
                $points[0]->setPoints(0);
                $points[0]->save();
            }
        }

        return $this->html(
            [
                'products' => $products,
                'streamer' => $streamer,
                'points' => ($points) ? $points[0] : 0,
                'manage' => $this->isManagement($idStreamer),
                'owner' => $this->isOwner($idStreamer)
            ]);
    }

    public function isManagement($idStreamer): bool {
        if ($this->app->getAuth()->isLogged() &&
            Managestreamers::getAll("id_streamer = ? AND id_user = ?", [$idStreamer, $this->app->getAuth()->getLoggedUserId()]))
            return true;
        return false;
    }

    public function isOwner($idStreamer) {
        if ($this->app->getAuth()->isLogged() &&
            Streamer::getAll("id_streamer = ? AND id_user = ?", [$idStreamer, $this->app->getAuth()->getLoggedUserId()]))
            return true;
        return false;
    }

    public function create(): Response {
        $data = [
            'streamer' => new Streamer(),
            'message' => 'Novy streamer'];
        return (($this->app->getAuth()->isLogged()) ? $this->html($data, viewName: "create.form") : $this->redirect(Configuration::LOGIN_URL));
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
        $streamer->setTwitch(!$post['twitch'] ? "" : $post['twitch']);
        if ($streamer->getIdUser() == NULL)
            $streamer->setIdUser($this->app->getAuth()->getLoggedUserId());
        $streamer->save();

        return $this->redirect("?c=store&id=".$streamer->getIdStreamer()."&success=profilecreated");
    }

    public function edit(): Response {
        $id = $this->request()->getValue("id");
        $data = [
            'streamer' => Streamer::getOne($id),
            'message' => 'Uprava profilu'];
        return (($this->isManagement($id) ||
            $this->isOwner($id)) ? $this->html($data, viewName: "create.form") :
            $this->redirect("?c=store&id=".$id."&error=nomngt"));
    }

    public function add(): Response {
        $id = $this->request()->getValue("id");
        $data = [
            'product' => new Product(),
            'streamer' => $id,
            'message' => 'Pridanie produktu'
        ];
        return (($this->isManagement($id) ||
            $this->isOwner($id)) ? $this->html($data, viewName: "product.form") :
            $this->redirect("?c=store&id=".$id."&error=nomngt"));
    }

    public function editproduct(): Response {
        $id = $this->request()->getValue("id");
        $idS = $this->request()->getValue("idS");
        $data = [
            'product' => Product::getOne($id),
            'message' => 'Pridanie produktu',
            'streamer' => $idS
        ];
        return (($this->isManagement($idS) ||
            $this->isOwner($idS)) ? $this->html($data, viewName: "product.form") :
            $this->redirect("?c=store&id=".$idS."&error=nomngt"));
    }

    public function delete(): Response {
        $id = $this->request()->getValue("id");
        $idS = $this->request()->getValue("idS");
        if ($this->isOwner($idS) || $this->isManagement($idS)) {
            $product = Product::getOne($id);
            $bought = Boughtproducts::getAll("id_product = ?", [$id]);
            foreach ($bought as $item) {
                $item->delete();
            }
            $product->delete();
            return $this->redirect("?c=store&id=".$idS."&success=productdeleted");
        }
        return $this->redirect("?c=store&id=".$idS."&error=nomngt");
    }

    public function submitproduct() {
        $post = $this->request()->getPost();
        if (isset($post['id']))
            $product = Product::getOne($post['id']);
        else
            $product = new Product();
        array_pop($post);
        if ($this->invalidName($post) || empty($post['titul'])) {
            $data = [
                'product' => $product,
                'message' => "Nepovolene znaky!",
                'streamer' => $post['idStreamer']
            ];
            return $this->html($data, viewName: "product.form");
        }
        $product->setIdStreamer($post['idStreamer']);
        $product->setTitul($post['titul']);
        $product->setPopis($post['popis']);
        $product->setCena($post['cena']);
        $product->setPocet($post['kusy']);
        $product->setHidden(($post['hidden']) ? 1 : 0);
        $product->save();

        return $this->redirect("?c=store&id=".$product->getIdStreamer()."&success=productadded");
    }

    private function invalidName($data): bool
    {
        foreach ($data as $one)
            if ($one !== "" && !preg_match('/^[\-a-zA-Z0-9 &@,.!\'\pL?$]+$/ui', $one))
                return true;
        return false;
    }

    public function addpoints() {
        $data = $this->request()->getPost();
        if (empty($data['komu']) || empty($data['kolko'])) {
            return $this->redirect("?c=store&error=empty");
        }
        if ($this->invalidName([$data['komu']])) {
            return $this->redirect("?c=store&error=chars");
        }

        $user = User::getAll("nickname = ? OR email = ? OR id_user = ?", [$data["komu"], $data["komu"], $data["komu"]]);
        if ($user) {
            $user = $user[0]->getIdUser();
            $points = Points::getAll("id_user = ? AND id_streamer = ?", [$user, $data['id']]);
            $points = ($points) ? $points[0] : new Points();
            $points->setIdUser($user);
            $points->setIdStreamer($data['id']);
            $points->setPoints(($points->getPoints() + $data['kolko']));
            $points->save();
            return $this->redirect("?c=store&id=".$data['id']."&success=pointsadded");
        }
        return $this->redirect("?c=store&id=".$data['id']."&error=nouser");
    }

    public function buy(): Response {
        $idP = $this->request()->getValue("id");
        $idS = $this->request()->getValue("idS");
        if (!$this->app->getAuth()->isLogged()) {
            return $this->redirect("?c=store&id=".$idS."&error=nouser");
        }
        $produkt = Product::getOne($idP);
        $points = Points::getAll("id_user = ? AND id_streamer = ?", [$this->app->getAuth()->getLoggedUserId(), $idS]);

        if ($points) {
            if ($points[0]->getPoints() >= $produkt->getCena()) {
                // poslal by sa mail s instrukciami ako vyzdvihnut
                $points = $points[0];
                $points->setPoints(($points->getPoints() - $produkt->getCena()));
                $points->save();

                $produkt->setPocet(($produkt->getPocet() - 1));
                $produkt->save();

                $bg = new Boughtproducts();
                $bg->setIdUser($this->app->getAuth()->getLoggedUserId());
                $bg->setIdProduct($idP);
                $bg->setIdStreamer($idS);
                $bg->setDatum(date("Y-m-d h:m:s"));
                $bg->save();

                return $this->redirect("?c=store&id=".$idS."&success=productbought");
            }
            return $this->redirect("?c=store&id=".$idS."&error=notenoughpoints");
        }
        return $this->redirect("?c=store&id=".$idS."&error=nouser");
    }
}