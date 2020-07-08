<?php

namespace App;

class App
{
    public static $db;
    public static $session;

    public function __construct(string $file_name)
    {
        self::$db = new \Core\FileDB($file_name);
        self::$db->load();

        self::$session = new \Core\Session();
    }

    public function __destruct()
    {
        self::$db->save();
    }
}
