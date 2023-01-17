<?php

namespace App\Controllers;

use App\Core\AControllerBase;
use App\Core\Responses\Response;
use App\Models\Boughtproducts;
use App\Models\Managestreamers;
use App\Models\Points;
use App\Models\Product;
use App\Models\Streamer;
use App\Models\User;

/**
 * Class HomeController
 * Example class of a controller
 * @package App\Controllers
 */
class UserController extends AControllerBase
{
    /**
     * Authorize controller actions
     * @param $action
     * @return bool
     */


    public function authorize($action)
    {
        return $this->app->getAuth()->isLogged();
    }

    /**
     * Example of an action (authorization needed)
     * @return \App\Core\Responses\Response|\App\Core\Responses\ViewResponse
     */
    public function index(): Response
    {
        $user = User::getOne($this->app->getAuth()->getLoggedUserId());
        $st = Streamer::getAll("id_user = ?", [$user->getIdUser()]);
        if ($st != NULL)
            return $this->html($st[0]->getIdStreamer());
        return $this->html(0);
    }


    public function changepwd(): Response
    {
        $data = $this->request()->getPost();
        if (isset($data['submit'])) {
            if ($this->emptyFields($data)) {
                $msg = "Prazdne polia!";
                return $this->html($msg, viewName: "pwd_change.form");
            }
            if (!$this->pwdMatch($data['password'], $data['passwordRepeat'])) {
                $msg = "Hesla sa nezhoduju!";
                return $this->html($msg, viewName: "pwd_change.form");
            }
            $user = User::getOne($this->app->getAuth()->getLoggedUserId());
            if (password_verify($data['passwordCurrent'], $user->getPassword())) {
                $hashPwd = password_hash($data['password'], PASSWORD_DEFAULT);
                $user->setPassword($hashPwd);
                $user->save();
            } else {
                $msg = "Nespravne aktualne heslo!";
                return $this->html($msg, viewName: "pwd_change.form");
            }
            $msg = "Heslo zmenene!";
            return $this->html($msg, viewName: "pwd_change.form");
        }
        return $this->html(NULL, viewName: "pwd_change.form");
    }

    public function delete() {
        $streamer = Streamer::getAll("id_user = ?", [$this->app->getAuth()->getLoggedUserId()]);

        if ($streamer) {
            $products = Product::getAll("id_streamer = ?", [$streamer[0]->getIdStreamer()]);
            foreach ($products as $item) {
                $bough = Boughtproducts::getAll("id_streamer = ? OR id_user = ?", [$streamer[0]->getIdStreamer(), $this->app->getAuth()->getLoggedUserId()]);
                foreach ($bough as $one) {
                    $one->delete();
                }
                $item->delete();
            }
            $streamer[0]->delete();
            $manage = Managestreamers::getAll("id_user = ? OR id_streamer = ?", [$this->app->getAuth()->getLoggedUserId(), $streamer[0]->getIdStreamer()]);
            $points = Points::getAll("id_user = ? OR id_streamer = ?", [$this->app->getAuth()->getLoggedUserId(), $streamer[0]->getIdStreamer()]);
        } else {
            $manage = Managestreamers::getAll("id_user = ?", [$this->app->getAuth()->getLoggedUserId()]);
            $points = Points::getAll("id_user = ?", [$this->app->getAuth()->getLoggedUserId()]);
            $bough = Boughtproducts::getAll("id_user = ?", [$this->app->getAuth()->getLoggedUserId()]);

        }
        foreach ($manage as $man)
            $man ->delete();
        foreach ($points as $point)
            $point->delete();
        foreach ($bough as $b)
            $b->delete();

        $user = User::getOne($this->app->getAuth()->getLoggedUserId());
        $user->delete();
        $this->app->getAuth()->logout();
        return $this->redirect("?c=home");
    }

    private function emptyFields($array): bool
    {
        if (empty($array['passwordCurrent']) || empty($array['password']) || empty($array['passwordRepeat']))
            return true;
        return false;
    }

    private function pwdMatch($pwd, $pwdRep): bool
    {
        if ($pwd === $pwdRep)
            return true;
        return false;
    }

}