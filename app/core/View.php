<?php

class View {

//VIEW CONTROLL
    public static function get($viewName)
    {
        if (file_exists("./resources/views/pages/$viewName.php")) {
            require_once("./resources/views/pages/$viewName.php");
        }
    }
}