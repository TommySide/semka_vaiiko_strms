<?php

namespace App\Controllers;

use App\Core\AControllerBase;
use App\Core\Responses\Response;
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
    private User $user;

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
        $this->user = User::getOne($this->app->getAuth()->getLoggedUserId());
        $st = Streamer::getAll("id_user = ?", [$this->user->getIdUser()]);
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

            if (password_verify($data['passwordCurrent'], $this->user->getPassword())) {
                $hashPwd = password_hash($data['password'], PASSWORD_DEFAULT);
                $this->user->setPassword($hashPwd);
                $this->user->save();
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
        if ($streamer)
            $streamer[0]->delete();
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