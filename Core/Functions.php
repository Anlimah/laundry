<?php

namespace Core;

class Functions
{
    public static function dd($data)
    {
        echo "<pre>";
        var_dump($data);
        echo "</pre>";
        die();
    }
}
