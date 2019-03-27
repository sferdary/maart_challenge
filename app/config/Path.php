<?php

use PHPMailer\PHPMailer\PHPMailer;


//ROOT PATH
define('ROOT', dirname('./') . DIRECTORY_SEPARATOR);

//APP PATH
define('APP',           ROOT        . 'app');
define('CONTROLLER',    APP         . DIRECTORY_SEPARATOR       . 'controllers'         . DIRECTORY_SEPARATOR);

//ASSETS PATH
define('ASSETS',        ROOT        . 'assets');
define('CSS',           ASSETS      . DIRECTORY_SEPARATOR       . 'css'                 . DIRECTORY_SEPARATOR);
define('IMG',           ASSETS      . DIRECTORY_SEPARATOR       . 'img'                 . DIRECTORY_SEPARATOR);
define('JS',            ASSETS      . DIRECTORY_SEPARATOR       . 'js'                  . DIRECTORY_SEPARATOR);

//CONFIG PATH
define('CONFIG',        APP         . DIRECTORY_SEPARATOR       . 'config');
define('CREDENTIALS',   CONFIG      . DIRECTORY_SEPARATOR       . 'Credentials.php');

//CORE PATH
define('CORE',          APP         . DIRECTORY_SEPARATOR       . 'core');
define('AUTH',          CORE        . DIRECTORY_SEPARATOR       . 'Auth');
define('FORGOTPWD',     AUTH        . DIRECTORY_SEPARATOR       . 'ForgotPassword.php');
define('LOGIN',         AUTH        . DIRECTORY_SEPARATOR       . 'Login.php');
define('REGISTER',      AUTH        . DIRECTORY_SEPARATOR       . 'Register.php');
define('RESETPWD',      AUTH        . DIRECTORY_SEPARATOR       . 'ResetPassword.php');
define('VALIDATE',      AUTH        . DIRECTORY_SEPARATOR       . 'Validate.php');
define('DB',            CORE        . DIRECTORY_SEPARATOR       . 'DB.php');
define('MAIL',          CORE        . DIRECTORY_SEPARATOR       . 'Mail.php');
define('ROUTE',         CORE        . DIRECTORY_SEPARATOR       . 'Route.php');
define('VIEW',          CORE        . DIRECTORY_SEPARATOR       . 'View.php');

//RESOURCES PATH
define('RESOURCES',     ROOT        . 'resources');
define('SASS',          RESOURCES   . DIRECTORY_SEPARATOR       . 'sass'                . DIRECTORY_SEPARATOR);
define('VIEWS',         RESOURCES   . DIRECTORY_SEPARATOR       . 'views'               . DIRECTORY_SEPARATOR);

//ROUTES PATH
define('ROUTES',        ROOT        . 'routes');
define('ERROR',         ROUTES      . DIRECTORY_SEPARATOR       . 'error'               . DIRECTORY_SEPARATOR);
define('WEB',           ROUTES      . DIRECTORY_SEPARATOR       . 'web.php');

//VENDOR PATH
define('VENDOR',        ROOT        . 'vendor');
define('AUTOLOAD',      VENDOR      . DIRECTORY_SEPARATOR       . 'autoload.php');
define('PHPMailer',     VENDOR      . DIRECTORY_SEPARATOR       . 'phpmailer'           . DIRECTORY_SEPARATOR       . 'phpmailer'       . DIRECTORY_SEPARATOR);

//VIEW PATH
define('INCLUDES',      VIEWS       . DIRECTORY_SEPARATOR       . 'includes'            . DIRECTORY_SEPARATOR);
define('LAYOUT',        VIEWS       . DIRECTORY_SEPARATOR       . 'layouts'             . DIRECTORY_SEPARATOR);
define('HEADER',        VIEWS       . DIRECTORY_SEPARATOR       . 'layouts'             . DIRECTORY_SEPARATOR       . 'header.php');
define('FOOTER',        VIEWS       . DIRECTORY_SEPARATOR       . 'layouts'             . DIRECTORY_SEPARATOR       . 'footer.php');
define('PAGES',         VIEWS       . DIRECTORY_SEPARATOR       . 'pages'               . DIRECTORY_SEPARATOR);
define('LOGOUT',        VIEW        . DIRECTORY_SEPARATOR       . 'Auth'                . DIRECTORY_SEPARATOR       . 'logout.php');

//CUSTOM ROUTES
define('UPLOADS',       IMG         . DIRECTORY_SEPARATOR       . 'realEstate'          . DIRECTORY_SEPARATOR);
define('REALESTATE',    CONTROLLER  . DIRECTORY_SEPARATOR       . 'RealEstateController.php');
define('ESSENTIALS',    PAGES       . DIRECTORY_SEPARATOR       . 'Admin'               .DIRECTORY_SEPARATOR        . 'essentials'     .DIRECTORY_SEPARATOR);
define('url',           $_GET['url']);
define ('php',          '.php');


//INCLUDE NEW PATH
$modules =
    [
        //FRAMEWORK ROUTES
            ROOT, APP,  ASSETS, RESOURCES, ROUTES, VENDOR,

        //APP
            CONTROLLER, 
            CORE, DB, MAIL, ROUTE, VIEW, AUTH, FORGOTPWD, LOGIN, REGISTER, RESETPWD, VALIDATE,
            CONFIG, CREDENTIALS, 

        //ASSETS
            CSS, IMG, JS,

        //RESOURCES
            VIEWS, INCLUDES, PAGES, SASS, 
            LAYOUT, LOGOUT, HEADER, FOOTER,

        //ROUTES
            ERROR,

        //VENDOR
           AUTOLOAD, PHPMailer,

        //CUSTOM ROUTES
            ESSENTIALS, UPLOADS, REALESTATE,
    ];

set_include_path(get_include_path() . PATH_SEPARATOR . implode(PATH_SEPARATOR, $modules));
