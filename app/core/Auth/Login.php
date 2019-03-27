<?php
require_once(DB);

class Login
{

    private static $user = array();

    public static function auth($uid, $pwd)
    {
        $uidStr         = htmlspecialchars(strip_tags($uid));
        $pwdStr         = htmlspecialchars(strip_tags($pwd));
        $matchUsername  = preg_match("/^[a-zA-Z0-9]*$/", $uidStr);
        $matchEmail     = filter_var($uidStr, FILTER_VALIDATE_EMAIL);

        $checkUser  = '';
        $userPwd    = array();
        $checkPwd   = false;
        $row        = 'user_name';

        $exception  = null;
        $url        = "Location: ".ROOT."?url=login&error=";
        $result     = '';

        if (empty($uidStr) || empty($pwdStr)) {
            $exception = "emptyFields";
        }
        if ($matchUsername == false) {
            if ($matchEmail == null) {
                $exception = "invalidUid";
            } else {
                $row = "email_addr";
            }
        }
        if ($matchUsername == true || $matchEmail != null) {
            $checkUser = DB::select("SELECT $row FROM users WHERE $row = '$uid'");
        }
        if ($checkUser[0]["$row"] != $uid) {
            $exception = "invalidUsernameEmail";
        }


        if ($exception == null) {
            $verified = DB::select("SELECT verified FROM users WHERE $row = '$uid'");
            if ($verified[0]['verified']  != null) {
                $userPwd = DB::select("SELECT pwd FROM users WHERE $row = '$uid'");
                $checkPwd = password_verify($pwd, base64_decode($userPwd[0]["pwd"]));
                if ($checkPwd == false) {
                    $exception = "invalidPassword";
                }
            } else {
                $exception = 'notVerified';
            }
        }

        if ($checkPwd == true) {
            $user = DB::select("SELECT * FROM users WHERE $row = '$uid'");
            $_SESSION['logged_in'] = array(
                'username'      => $user[0]['user_name'],
                'first_name'    => $user[0]['first_name'],
                'last_name'     => $user[0]['last_name'],
                'email'         => $user[0]['email_addr'],
            );
            self::$user = $_SESSION['logged_in'];
        }


        if (!isset($exception)) {
            $result = true;
        } else {
            $result = header($url . $exception);
        }
        return $result;
    }
    public static function setSession()
    {
        return self::$user;
    }
}
