<?php
require_once(DB);

class ResetPassword
{
    public static function expired($selector)
    {
        $currentDate = date("U");
        $query = DB::select(
            'SELECT * FROM pwdReset WHERE selector = :selector AND expires >= :currentDate',
            [
                ":selector"     => $selector,
                ":currentDate"  => $currentDate
            ]
        );
        return (($currentDate - $query[0]['expires']) >= 1800) ? true : false;
    }


    public static function verify($selector, $token)
    {
        return (ctype_xdigit($selector) === true && ctype_xdigit($token) === true) ? true : false;
    }



    public static function validate($selector, $token, $pwd, $pwdRepeat)
    {
        $exception = null;
        $result = null;
        $currentDate = date("U");

        $query = DB::select(
            'SELECT * FROM pwdReset WHERE selector = :selector AND expires >= :currentDate',
            [
                ":selector"     => $selector,
                ":currentDate"  => $currentDate
            ]
        );
        $tokenBin = hex2bin($token);
        $checkToken = password_verify($tokenBin, $query[0]["token"]);

        if ($checkToken === false) {
            $exception = 'invalidToken';
        } else if ($checkToken === true) {
            $checkEmail = DB::select('SELECT email_addr FROM users WHERE email_addr = :email_addr', [":email_addr" => $query[0]['email']]);
            if ($checkEmail[0]['email_addr'] !== $query[0]['email']) {
                $exception = 'internalError';
            } else if ($pwd !== $pwdRepeat) {
                $exception = 'noPasswordMatch';
            } else {
                DB::update("UPDATE users SET pwd = :pwd", [":pwd" => base64_encode(password_hash($pwd, PASSWORD_DEFAULT))]);
            }
        }


        if (!isset($exception)) {
            $result = 'login&changePassword=success';
        } else {
            $result = "reset-password&error=$exception&validate=$selector&token=$token";
        }

        return header("Location: ".ROOT."?url=$result");
    }
}
