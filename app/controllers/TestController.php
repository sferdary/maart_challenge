<?php
require_once(DB);


class Test {

    public static function show() {
        $result = DB::select(
            "SELECT * 
                FROM users 
                WHERE user_name = :user_name 
                AND email_addr = :email_addr 
            ",
            [
                ":user_name" => "test",
                ":email_addr" => "s.ferdary@gmail.com",
            ]
        );
        return $result;
    }

    public static function store() {
        $result = DB::store("");
        return $result;
    }

    public static function delete() {
        $result = DB::delete("");
    }
}