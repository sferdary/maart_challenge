<?php
require_once(DB);
require_once(MAIL);

class ForgotPassword
{

    public static function request($email)
    {
        $user = '';
        $matchEmail = filter_var($email, FILTER_VALIDATE_EMAIL);
        $exception = null;
        $error = '&error=';
        $result = null;
        $selector = bin2hex(random_bytes(8));
        $token = random_bytes(32);
        $expires = date("U") + 1800;

        if ($matchEmail == null) {
            $exception = 'noEmail';
        } else {
            $checkEmail = DB::select('SELECT email_addr FROM users WHERE email_addr = :email_addr', [":email_addr" => $email]);
            if ($checkEmail[0]['email_addr'] !== $email) {
                $exception = 'invalidEmail';
            } else {
                DB::delete('DELETE FROM pwdReset WHERE email = :email', [':email' => $email]);
                DB::insert(
                    'INSERT INTO pwdReset VALUES (id, :email, :selector, :token, :expires)',
                    [
                        ":email"    => $email,
                        ":selector" => $selector,
                        ":token"    => password_hash($token, PASSWORD_DEFAULT),
                        ":expires"  => $expires
                    ]
                );

                $user = DB::select('SELECT first_name, last_name FROM users WHERE email_addr = :email_addr', [":email_addr" => $email]);

                $name = $user[0]['first_name'] . ' ' . $user['last_name'];

                $subject = 'Reset your password';
                $recipient = "Dear $name,<br><br>";
                $url = "http://" . $_SERVER['SERVER_NAME'] . ":88/?url=reset-password&validate=$selector&token=" . bin2hex($token);
                $link = "<a href='$url'>here</a>";
                $phrase = "Click $link to reset your password <br><br>";
                $conclusion = 'Kind regards, <br>Samuel Ferdary';
                $message = $recipient . $phrase . $conclusion;
                if (Mail::send($email, $subject, $message) == true) {
                    $result = "Location: ../?url=forgot-password&success=true";
                } else {
                    $exception = 'somethingWentWrong';
                }
            }
        }
        if (isset($exception)) {
            $result = 'Location: '.ROOT.'?url=forgot-password' . $error . $exception;
        }

        return header($result);
    }
}

