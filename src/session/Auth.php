<?php

namespace Session;

use Models\User;

class Auth {
    public static function init() {
        session_save_path(__DIR__ . '/../session/tmp/');
        session_start();
    }

    public static function check() {
        return isset($_SESSION['user']);
    }

    public static function login($email, $password) {
        $login = new \Models\User();
        $user = $login->findByEmail($email);
        if ($user) {
            if (password_verify($password, $user->password)) {
                $_SESSION['user'] = json_encode($user);
                return true;
            }
        }
        return false;
    }

    public static function logout() {
        unset($_SESSION['user']);
    }

    public static function user() {
        $user = new User();
        foreach (json_decode($_SESSION['user']) as $key => $value) {
            $user->$key = $value;
        }
        return $user;
    }
}