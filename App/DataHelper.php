<?php

namespace App;

class DataHelper
{
    public static function getImage($name)
    {
        return 'backgrounds/' . $name . '.jpg';
    }
}