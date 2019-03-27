<?php

class Credentials
{
    //DATABASE CREDENTIALS
    protected static $DBhost        = '';
    protected static $DBusername    = '';
    protected static $DBpassword    = '';
    protected static $database      = '';
    protected static $DBcharset     = '';

   //MAIL CREDENTIALS
    protected static $email         = '';
    protected static $mailpwd       = '';
    protected static $mailhost      = '';
    protected static $smtpAuth      = true;
    protected static $encryption    = 'tls';
    protected static $port          = '587';
    protected static $debug         = 1;                        //0 = no_output / 1 = error_reporting + msg / 2 = msg

    //RECAPTCHA CREDENTIALS
    protected static $publicKey     = '';
    protected static $privateKey    = '';
}
