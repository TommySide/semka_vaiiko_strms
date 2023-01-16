<?php

namespace App\Controllers;

use App\Core\AControllerBase;
use App\Core\Responses\Response;

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
        return $this->html();
    }

    public function changepwd(): Response
    {
        return $this->html(NULL, viewName: "pwd_change.form");
    }

    public function trychange() {
        $data = $this->request()->getPost();
        $arr = $this->app->getAuth()->getLoggedUserContext();
        echo "$arr";
        print_r($arr);
    }
}