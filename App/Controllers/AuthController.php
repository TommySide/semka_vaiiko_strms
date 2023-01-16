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
            if (empty($formData['nickname']) || empty($formData['email']) || empty($formData['password']) || empty($formData['passwordRepeat'])) {
                $data = ['message' => 'Prazdne polia!'];
                return $this->html($data);
            }
            if (!$this->invalidNickname($formData['nickname'])) {
                $data = [
                    'message' => 'Nepovolené znaky!',
                    'email' => $formData['email']
                ];
                return $this->html($data);
            }
            if (!$this->invalidEmail($formData['email'])) {
                $data = [
                    'message' => 'Zlý tvar emailu!',
                    'nickname' => $formData['nickname']
                ];
                return $this->html($data);
            }
            if (!$this->pwdMatch($formData['password'], $formData['passwordRepeat'])) {
                $data = [
                    'message' => 'Hesla sa nezhodujú!',
                    'nickname' => $formData['nickname'],
                    'email' => $formData['email']
                ];
                return $this->html($data);
            }
            if (!$this->nicknameTaken($formData['nickname'], $formData['email'])) {
                $data = ['message' => 'Meno alebo email už sú obsadené!'];
                return $this->html($data);
            }

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

    private function invalidNickname($nickname) {
        if (!preg_match("/^[a-zA-Z0-9]*$/", $nickname)) {
            return false;
        }
        return true;
    }

    private function invalidEmail($email) {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return false;
        }
        return true;
    }

    private function pwdMatch($pwd, $pwdRep) {
        if ($pwd !== $pwdRep) {
            return false;
        }
        return true;
    }

    private function nicknameTaken($nickname, $email) {
        $user = User::getAll('nickname = ? OR email = ?', [$nickname, $email]);
        if ($user == NULL) {
            return false;
        }
        return true;
    }
}