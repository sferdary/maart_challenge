<?php
require_once(DB);

class Validate
{
    public static function verify($vkey)
    {
        $checkVkey = preg_match("/^[a-zA-Z0-9]*$/", $vkey);
        $result = null;
        if ($checkVkey != false) {
            $checkVerification = DB::select("SELECT vkey, verified FROM users WHERE vkey = '$vkey'");
            if (isset($checkVerification[0]['vkey'])) {
                if ($checkVerification[0]['verified'] == null) {
                    DB::update("UPDATE users SET verified = 1 where vkey = '$vkey'");
                    $result = 'login&account=verified';
                } else {
                    $result = 'verify&account=alreadyVerified';
                }
            } else {
                $result = 'verify&account=notFound';
            }
        } else {
            $result = 'verify&error=invalidKey';
        }
        return header("Location: ".ROOT."?url=" . $result);
    }
}
