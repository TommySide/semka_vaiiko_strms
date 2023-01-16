<?php

namespace App\Controllers;

use App\Config\Configuration;
use App\Core\AControllerBase;
use App\Core\Responses\Response;
use App\Models\User;

/**
 * Class AuthController
 * Controller for authentication actions
 * @package App\Controllers
 */
class AuthController extends AControllerBase
{
    /**
     *
     * @return \App\Core\Responses\RedirectResponse|\App\Core\Responses\Response
     */
    public function index(): Response
    {
        return $this->redirect(Configuration::LOGIN_URL);
    }

    /**
     * Login a user
     * @return \App\Core\Responses\RedirectResponse|\App\Core\Responses\ViewResponse
     */
    public function login(): Response
    {
        $formData = $this->app->getRequest()->getPost();
        $logged = null;
        if (isset($formData['submit'])) {
            $logged = $this->app->getAuth()->login($formData['name'], $formData['password']);
            if ($logged) {
                return $this->redirect('?c=user');
            }
        }

        $data = ($logged === false ? ['message' => 'Zlý login alebo heslo!'] : []);
        return $this->html($data);
    }

    public function register(): Response
    {
        $formData = $this->app->getRequest()->getPost();

        if (isset($formData['submit'])) {

            $result = $this->checkInput($formData);

            $hashPwd = password_hash($formData['password'], PASSWORD_DEFAULT);

            $user = new User($formData['nickname'], $formData['email'], $hashPwd, 0);
            try {
                $user->save();
            } catch (\Exception $e) {
                $data = ['message' => 'Error: '.$e];
                return $this->html($data);
            }
            $data = ['message' => 'Uspesne registrovany!'];
            return $this->html($data);
        }
        return $this->html();
    }

    /**
     * Logout a user
     * @return \App\Core\Responses\ViewResponse
     */
    public function logout(): Response
    {
        $this->app->getAuth()->logout();
        return $this->redirect("?c=home");
    }

    private function checkInput($array)  {
        if ($this->emptyFields($array)) {
            $data = [
                'message' => 'Prázdne polia!',
            ];
            return $data;
        }

        if ($this->invalidNickname($array['nickname'])) {
            $data = [
                'message' => 'Nepovolené znaky!',
                'email' => $array['email']
            ];
            return $data;
        }
        if ($this->invalidEmail($array['email'])) {
            $data = [
                'message' => 'Zlý tvar emailu!',
                'nickname' => $array['nickname']
            ];
            return $data;
        }
        if (!$this->pwdMatch($array['password'], $array['passwordRepeat'])) {
            $data = [
                'message' => 'Hesla sa nezhodujú!',
                'nickname' => $array['nickname'],
                'email' => $array['email']
            ];
            return $data;
        }
        if (!$this->nicknameTaken($array['nickname'], $array['email'])) {
            $data = ['message' => 'Meno alebo email už sú obsadené!'];
            return $data;
        }
        return null;
    }

    private function emptyFields($array): bool
    {
        if (empty($array['nickname']) || empty($array['email']) || empty($array['password']) || empty($array['passwordRepeat'])) {
            return true;
        }
        return false;
    }

    private function invalidNickname($nickname): bool
    {
        if (!preg_match("/^[a-zA-Z0-9]*$/", $nickname)) {
            return true;
        }
        return false;
    }

    private function invalidEmail($email): bool
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return true;
        }
        return false;
    }

    private function pwdMatch($pwd, $pwdRep): bool
    {
        if ($pwd === $pwdRep) {
            return true;
        }
        return false;
    }

    private function nicknameTaken($nickname, $email): bool
    {
        $user = User::getAll('nickname = ? OR email = ?', [$nickname, $email]);
        if ($user == NULL) {
            return false;
        }
        return true;
    }
}