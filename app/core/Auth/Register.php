<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);


require_once(DB);
require_once(MAIL);

class Register
{
    private static $authenticated = false;
    protected static $create = array();

    public static function auth($username, $firstName, $lastName, $email, $pwd, $pwdRepeat)
    {
        $exception = null;
        $url = "Location: ".ROOT."?url=register&error=";

        $matchUsername = preg_match("/^[a-zA-Z0-9]*$/", $username);
        $matchFirstName = preg_match("/^[a-zA-Z0-9]*$/", $firstName);
        $matchLastName = preg_match("/^[a-zA-Z0-9]*$/", $lastName);
        $matchEmail = filter_var($email, FILTER_VALIDATE_EMAIL);

        if (empty($username) || empty($firstName) || empty($lastName) || empty($email) || empty($pwd) || empty($pwdRepeat)) {
            $exception = "emptyFields&username=" . $username . "&first_name=" . $firstName . "&last_name=" . $lastName . "&email_addr=" . $email;
        } elseif ($pwd !== $pwdRepeat) {
            $exception = "passwordCheck&username=" . $username . "&first_name=" . $firstName . "&last_name=" . $lastName . "&email_addr=" . $email;
        } elseif ($matchUsername == false) {
            $exception = "invalidUsername&first_name=" . $firstName . "&last_name=" . $lastName . "&email_addr=" . $email;
        } elseif ($matchEmail == null) {
            $exception = "invalidEmail&username=" . $username . "&first_name=" . $firstName . "&last_name=" . $lastName;
        } elseif ($matchFirstName == false) {
            $exception = "invalidFirstname&username=" . $username . "&last_name=" . $lastName . "&email_addr=" . $email;
        } elseif ($matchLastName == false) {
            $exception = "invalidLastname&username=" . $username . "&first_name=" . $firstName . "&email_addr=" . $email;
        } elseif ($matchEmail == null && $matchUsername == false) {
            $exception = "invalidEmailUsername&first_name=" . $firstName . "&last_name=" . $lastName;
        } elseif ($matchEmail == null && $matchFirstName == false) {
            $exception = "invalidEmailFirstname&username=" . $username . "&last_name=" . $lastName;
        } elseif ($matchEmail == null && $matchLastName == false) {
            $exception = "invalidEmailLastname&username=" . $username . "&first_name=" . $firstName;
        } elseif ($matchUsername == false && $matchFirstName == false) {
            $exception = "invalidUsernameFirstname&email_addr=" . $email . "&last_name=" . $lastName;
        } elseif ($matchUsername == false && $matchLastName == false) {
            $exception = "invalidUsernameLastname&email_addr=" . $email . "&first_name=" . $firstName;
        } elseif ($matchFirstName == false && $matchLastName == false) {
            $exception = "invalidFirstnameLastname&email_addr=" . $email .  "&username=" . $username;
        } elseif ($matchEmail == null && $matchUsername == false && $matchFirstName == false) {
            $exception = "invalidEmailUsernameFirstname&last_name=" . $lastName;
        } elseif ($matchEmail == null && $matchUsername == false && $matchFirstName == false && $matchLastName == false) {
            $exception = "invalidEmailUsernameFirstnameLastname";
        } else {
            $checkUsername = DB::select("SELECT user_name FROM users WHERE user_name = '$username'");
            $checkEmail = DB::select("SELECT email_addr FROM users WHERE email_addr = '$email'");
            if ($checkUsername[0]["user_name"] == $username) {
                $exception = "userNameExist";
            } else if ($checkEmail[0]["email_addr"] == $email) {
                $exception = "emailExist";
            } else if ($checkUsername[0]["user_name"] == $username && $checkEmail[0]["email_addr"] == $email) {
                $exception = "userNameExist&emailExist";
            } else {
                $exception = null;
            }
        }

        if (!isset($exception)) {
            self::$create = array(
                ":user_name"    => $username,
                ':first_name'   => $firstName,
                ':last_name'    => $lastName,
                ':email_addr'   => $email,
                ':pwd'          =>  base64_encode(password_hash($pwd, PASSWORD_DEFAULT)),
                ':vkey'         => md5(time() . $username),
                ':verified'     => null,
                ':created_at'   => date('Y-m-d h:i:s.u ', time()),
                'temp_pwd'      => $pwd
            );
            return self::$authenticated = true;
        } else {
            self::$authenticated = false;
            return header($url . $exception);
        }
        return self::$authenticated;
    }

    public static function storeUser()
    {
        if (self::$authenticated == null || self::$authenticated == false) {
            exit;
        } else if (self::$authenticated == true) {
            DB::insert('INSERT INTO users VALUES (uid, :user_name, :first_name, :last_name, :email_addr, :pwd, :vkey, :verified, :created_at)', self::$create);
            return true;
        }
    }

    public static function mail()
    {
        if (self::$authenticated == null || self::$authenticated == false) {
            exit;
        } else if (self::$authenticated == true) {

            $name = self::$create[':first_name'] . ' ' . self::$create[':last_name'];
            $email = self::$create[':email_addr'];
            $vkey = self::$create[':vkey'];
            $link = "<a href='http://".$_SERVER['SERVER_NAME'].":88/?url=verify&validate=$vkey'>here</a>";

            $subject    = 'Verify your account';
            $recipient  = "Dear $name,<br><br>";
            $phrase     = "Click $link to verify your account <br>";
            $phrase    .= "Your temporary password is: ".self::$create['temp_pwd']."<br><br>";
            $conclusion = 'Kind regards, <br>Samuel Ferdary';
            $message    = $recipient . $phrase . $conclusion;
            
            if (Mail::send($email, $subject, $message) == false) {
                return false;
            }else{
                return true;
            }
        }
    }
}