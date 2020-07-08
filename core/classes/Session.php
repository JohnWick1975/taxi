<?php


namespace Core;


use App\App;
use App\Users\User;
use App\Users\Model;

class Session
{
    /**
     * @var array with user data.
     */
    private $user = [];

    public function __construct()
    {
        session_start();
        $this->loginFromCookie();
    }

    public function loginFromCookie(): bool
    {
        return $this->login($_SESSION['email'] ?? '', $_SESSION['password'] ?? '');
    }

    public function login(string $email, string $password): bool
    {
        $user_data = Model::getWhere(['email' => $email, 'password' => $password]);

        if ($user_data) {
            $user = $user_data[0];
            $_SESSION['email'] = $user->email;
            $_SESSION['password'] = $user->password;
            $this->user = $user;

            return true;
        }

        return false;
    }

    public function getUser()
    {
        return $this->user;
    }

    public function logout(string $redirect = null)
    {
        $_SESSION = [];

        setcookie(session_name(), null, time() - 1, '/');

        session_destroy();

        $this->user = [];

        if ($redirect) {
            header("Location: $redirect");
        }
    }
}